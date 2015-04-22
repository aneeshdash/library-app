<?php

class AdminController extends BaseController {

    public function login()
    {
        return View::make('admin.login');
    }

    public function postlogin()
    {
        $admin=array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        if(Auth::admin()->attempt($admin, Input::get('remember')==='yes')) {
            return Redirect::intended('test');
        }
        if(Admin::where('username',Input::get('username'))->count()) {
            $error='Incorrect Password';
        }
        else {
            $error="Incorrect Username";
        }
        return Redirect::route('adminlogin')->with('error', $error)->withInput();
    }

    public function logout()
    {
        Auth::admin()->logout();
        return Redirect::route('adminhome');
    }


    public function test()
    {
//        Mail::send('emails.testmail', array('name' => 'Kunaal Jain') ,function($message)
//        {
//            $message->from('a.dash@iitg.ernet.in', 'Aneesh Dash');
//            $message->to('aneeshdash@gmail.com', 'Aneesh Dash')->subject('Hello!');
//        });
//        Log::info('hi');
//        $book=Book::where('return_date','<',Carbon::now()->addDays(10))->first();
        $book=Book::whereBetween('return_date',array(Carbon::now(),Carbon::now()->addDays(2)))->groupBy('issue')->first();
//        $book->return_date=Carbon::now()->addDays(5);
//        $book->save();
        foreach(Book::whereBetween('return_date',array(Carbon::now(),Carbon::now()->addDays(2)))->groupBy('issue')->get() as $us) {
            Log::alert($us->issue);
        }
        return View::make('admin.home')->with('book', $book);
    }

    public function update()
    {
        return View::make('admin.updates');
    }

    public function lost()
    {
        return View::make('admin.lostBook');
    }

    public function userprofile()
    {
        return View::make('admin.profileinp');
    }

    public function postuserprofile()
    {
        $roll=Input::get('roll');
        $user=User::where('roll', intval($roll))->first();
        if($user !== null) {
            return View::make('admin.profile')->with('user', $user);
        }
        else {
            return Redirect::route('adminuser')->with('error', 'User doesnot exist');
        }
    }

    public function tabusers()
    {
        return View::make('admin.tables.users');
    }

    public function tabbooks()
    {
        return View::make('admin.tables.books');
    }

    public function tablost()
    {
        return View::make('admin.tables.lost1');
    }
    public function tabadmin()
    {
        return View::make('admin.tables.admins');
    }
    public function tabnewadd()
    {
        return View::make('admin.tables.new_add');
    }
    public function tabcat()
    {
        return View::make('admin.tables.cat');
    }
    public function tabrules()
    {
        return View::make('admin.tables.rules');
    }
    public function tabenv()
    {
        return View::make('admin.tables.env');
    }
    public function tabpub()
    {
        return View::make('admin.tables.pub');
    }
    public function master()
    {
        return View::make('admin.master');
    }
    public function newadd()
    {
        return View::make('admin.newadd');
    }
    public function land()
    {
        return View::make('admin.landing');
    }
    public function profile()
    {
        return View::make('admin.profile');
    }
    public function adminprof()
    {
        return View::make('admin.adminprof');
    }
    public function changepassword() {
        $id = Input::get('id');
        $old = Input::get('old');
        $new = Input::get('new');
        $admin=Admin::find(intval($id));
        $hashedPassword = $admin->password;
        if (Hash::check($old, $hashedPassword))
        {
            $newpassword = Hash::make($new);
            $admin->password = $newpassword;
            $admin->save();

            return 'Password Successfully Updated';
        }

        return 'admin password incorrect';
    }
}
