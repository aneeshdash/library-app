<?php

use Illuminate\Routing\Controller;
use Dingo\Api\Routing\ControllerTrait;

class APIController extends Controller {
    use ControllerTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login() {
        $webmail = Input::get('webmail');
        $password = Input::get('password');
        $server='ssl://202.141.80.'.Input::get('server');
        if(User::where('webmail',$webmail)->count())
        {

            $fp = fsockopen($server, 995, $err, $errstr, 10);
            if ($fp) {
                $user=User::where('webmail', $webmail)->first();
                if($user->api_key !== null) {
                    return $this->response->error('User already logged in',500);
                }
                $st = stream_set_blocking($fp, 1);
                $trash = fgets($fp, 128); // Trash to hold the banner
                fwrite($fp, "user $webmail\r\n"); // POP3 USER CMD
                stream_set_timeout($fp, 2);
                $u = fgets($fp);
                if (trim($u) == '+OK') {
                    fwrite($fp, "pass $password\r\n");
                    stream_set_timeout($fp, 2);
                    $pass = fgets($fp, 128);
                    if (trim($pass) == '+OK Logged in.') {
                        $user->api_key=Crypt::encrypt(uniqid($webmail));
                        $user->save();
                        $user=$user->toArray();
                        $user['status_code']=69;
                        return $user;
                    } else {
                        return $this->response->errorUnauthorized('Wrong Credentials');
                    }
                } else {
                    return $this->response->error('There was an error', 500);
                }
                fwrite($fp, "quit\r\n");
                stream_set_timeout($fp, 2);
                fclose($fp);
            }
            else
            {
                return $this->response->error('Cannot connect', 500);
            }
        }
        else {
            return $this->response->error('Webmail doesnot exist. Contact site admin', 500);;
        }
    }

    public function logout()
    {
        $key=Input::get('api_key');
        $user=User::where('api_key',$key)->first();
        if($user===null) {
            return $this->response->error('User not logged in', 500);
        }
        else {
            $user->api_key = null;
            $user -> save();
            $res['status_code'] = 69;
            $res['message'] = 'Logged Out';
            return $res;
        }
    }

    public function searchapi()
    {
        if (Input::get('keyword') == "") {
            return $this->response->error('No keyword given', 500);
        }
        // $roles = DB::table('roles')->lists('title');
        $connector = "or";
        $field = "any";
        if ($field != "any") {
            if ($connector == "or") {
                $keyword = explode( ' ', Input::get('keyword'));
                $query = DB::table('books');
                for ($i=0; $i < sizeof($keyword); $i++) {
                    $query->orwhere($field,'LIKE','%'.$keyword[$i].'%');
                }
                // $results = $query->get();
                $results = $query;
            }
        }
        else {
            if ($connector == "or") {
                $keyword = explode( ' ', Input::get('keyword'));
                $query = DB::table('books');
                for ($i=0; $i < sizeof($keyword); $i++) {
                    $query->orwhere('title','LIKE','%'.$keyword[$i].'%')
                        ->orwhere('authors','LIKE','%'.$keyword[$i].'%');
                }
                // $results = $query->get();
                $results = $query;
            }
        }
        $sortby = "title" ;
        $order = "asc";
        // $results = $results->orderBy($sortby,$order)->get();
        $copy = $results ;
        $results = $results->orderBy($sortby,$order)->get();
        $uniqueresults = $copy->orderBy($sortby,$order)->groupBy('title')->get();

        $send = json_encode($uniqueresults);
        return $send;
    }

}
