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
                $st = stream_set_blocking($fp, 1);
                $trash = fgets($fp, 128); // Trash to hold the banner
                fwrite($fp, "user $webmail\r\n"); // POP3 USER CMD
                stream_set_timeout($fp, 2);
                $user = fgets($fp);
                $u = 'hi';
                if (trim($user) == '+OK') {
                    fwrite($fp, "pass $password\r\n");
                    stream_set_timeout($fp, 2);
                    $pass = fgets($fp, 128);
                    if (trim($pass) == '+OK Logged in.') {
                        $u = 'Successfully Logged In';
                        $user=User::where('webmail', $webmail)->first();
                        $key=str_random(6);
                        $user->api_key=Crypt::encrypt($key);
                        $user->save();
                        return $user->toArray();
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


}
