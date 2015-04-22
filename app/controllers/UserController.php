<?php

class UserController extends BaseController {

    public function home()
    {
        return Redirect::route('user_bsearch');
    }
    public function accounts()
    {
        return View::make('user.accounts');
    }
    public function wish_list()
    {
        return View::make('user.wish_list');
    }
    public function queued_books()
    {
        return View::make('user.queued_books');
    }
    public function contacts()
    {
        return View::make('user.contacts');
    }
    public function lost_book()
    {
        return View::make('user.lost_book');
    }
    public function donate_book()
    {
        return View::make('user.donate_book');
    }
    public function login()
    {
        return View::make('user.login');
    }
    public function lock_screen()
    {
        return View::make('user.lock_screen');
    }
    public function advanced_search()
    {
        return View::make('user.advanced_search');
    }
    public function postlogin()
    {
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
                        Auth::user()->login(User::where('webmail', $webmail)->first(),Input::get('remember')==='yes');
                        return Redirect::route('user_bsearch');
                    } else {
                        $error = 'Wrong Details';
                    }
                } else {
                    $error = 'There was some error. Please Try Again';
                }
                fwrite($fp, "quit\r\n");
                stream_set_timeout($fp, 2);
                fclose($fp);
            }
            else
            {
                $error='cannot connect';
            }
        }
        else {
            $error='Webmail ID doesnot exist. Please contact library admin.';
        }
        return Redirect::route('login')->withInput()->with('error',$error);
    }
    public function logout()
    {
        Auth::user()->logout();
        return Redirect::route('user_bsearch');
    }
    public function available()
    {
        $data = array();
        $data['id'] = Input::get('id');
        $data['action'] = Input::get('action');
        if ($data['action'] == "navail") {
            $result = Book::where('id',(int)$data['id'])->first();
            if (sizeof($result)!=0) {
                $result->available = 1;
                $result->save();
            }
        }
        else {
            $result = Book::where('id',(int)$data['id'])->first();
            if (sizeof($result) !=0) {
                foreach (Mutualtransfer::where('book_id','=',$data['id'])->first() as $mtf) {
                    $mtf->delete();
                }
                $result->available = 0;
                $result->save();
            }

        }
        $data['message'] = 'Success!';
        echo json_encode($data);
    }

    public function add_donate_book()
    {
        if(Input::get('pub') != 'other')
        {
            $pub = DB::table('publications')->where('id',Input::get('pub'))->first();
            $pub_name = $pub->name;
        }
        else
        {
            $pub_name = Input::get('new_pub');
        }
        DB::table('donate_book')->insert(
            ['donor_id' => Input::get('userid'),'book_title' => Input::get('book_title'), 'publication' => $pub_name,
                'isbn' => Input::get('isbn'), 'edition' => Input::get('edition'), 'authors' => Input::get('authors')]
        );
    }
    public function add_lost_book()
    {
        $bk = DB::table('books')->where('id', Input::get('book_title'))->first();
        $title = $bk->title;
        $code = $bk->code;
        if(Input::get('pub') != 'other')
        {
            $pub = DB::table('publications')->where('id',Input::get('pub'))->first();
            $pub_name = $pub->name;
        }
        else
        {
            $pub_name = Input::get('new_pub');
        }
        $book = new LostBook;
        $book->title = $title;
        $book->authors = Input::get('authors');
        $book->publication = $pub_name;
        $book->edition = Input::get('edition');
        $book->ISBN = Input::get('isbn');
        $book->book_id = Input::get('book_title');
        $book->status = 'REQUESTED';
        $book->user_id = Input::get('userid');
        $book->created_at = time();
        $book->updated_at = time();
        $book->code = $code;
        $book->save();
    }

    public function update_form()
    {
        $book = DB::table('books')->where('id',Input::get('val'))->first();
        $authors = array();
        $authors['auths'] = $book->authors;
        $authors['edition'] = $book->edition;
        $authors['isbn'] = $book->ISBN;
        $authors['pub'] = $book->publication_id;

        echo json_encode($authors);
    }

    public function del_log()
    {
        DB::table('lost_book')->where('id', Input::get('val'))->delete();
        $dummy =array();
        echo json_encode($dummy);
    }
    public function del_donate_log()
    {
        DB::table('donate_book')->where('id', Input::get('val'))->delete();
        $dummy =array();
        echo json_encode($dummy);
    }
    public function printLog($log_id)
    {
        $log = DB::table('lost_book')->where('id',Crypt::decrypt($log_id))->first();
        $user = DB::table('users')->where('id',$log->user_id)->first();
        $authors = str_replace(";"," ",$log->authors);
//        $html = View::make('user.invoice',['book' => Crypt::decrypt($value)]);
        $html = View::make('user.invoice',['name' => $user->name,'roll' => $user->roll, 'authors' => $authors, 'publication' => $log->publication, 'ISBN' => $log->ISBN, 'book' => $log->title]);
        $pdf = App::make('dompdf');
        $pdf->loadHTML($html);
        return $pdf->stream('invoice.pdf');
    }

    public function printLog_donate($log_id)
    {
        $log = DB::table('donate_book')->where('id',Crypt::decrypt($log_id))->first();
        $user = DB::table('users')->where('id',$log->donor_id)->first();
        $authors = str_replace(";"," ",$log->authors);
//        $html = View::make('user.invoice',['book' => Crypt::decrypt($value)]);
        $html = View::make('user.invoice2',['name' => $user->name,'roll' => $user->roll, 'authors' => $authors, 'publication' => $log->publication, 'ISBN' => $log->ISBN, 'book' => $log->book_title]);
        $pdf = App::make('dompdf');
        $pdf->loadHTML($html);
        return $pdf->stream('invoice2.pdf');
    }

    public function add_wish()
    {
        $book = DB::table('books')->where('id',Input::get('book_id'))->first();
        $book_name = $book->title;
        DB::table('wishlist')->insert(
            ['book_id' => Input::get('book_id'),'book_name' => $book_name, 'user_id' => Auth::user()->get()->id]
        );
        $dummy = array();
        echo json_encode($dummy);
    }

    public function del_wish()
    {
        DB::table('wishlist')->where('id', Input::get('val'))->delete();
        $dummy =array();
        echo json_encode($dummy);
    }

    public function newadd()
    {
        $limit_days = 1;
        $limit_seconds = 7*24*60*60;

        $new_books = DB::table('books')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('created_at','desc')
            ->get();

        $new_books=Book::where('created_at','>',Carbon::now()->subDays(30))->orderBy('id','desc')->get();

        return View::make('user.new_arrivals')->with('new_books',$new_books);
    }

    //------------------------basic search starts here---------------------------//
    public function bsearch()
    {
        return View::make('user.bsearch');
    }
    public function basicsearch()
    {
        if (Input::get('keyword') == "") {
            return View::make('layouts.bsearch');
        }
        // $roles = DB::table('roles')->lists('title');
        $connector = Input::get('connectors');
        $field = Input::get('basedon');
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
            elseif ($connector == "and") {
                $keyword = explode( ' ', Input::get('keyword'));
                $query = DB::table('books');
                for ($i=0; $i < sizeof($keyword); $i++) {
                    $query->where($field,'LIKE','%'.$keyword[$i].'%');
                }
                // $results = $query->get();
                $results = $query;
            }
            else {
                $keyword = Input::get('keyword');
                // $results = Test::where($field,'LIKE','%'.$keyword.'%')->get();
                $results = Book::where($field,'LIKE','%'.$keyword.'%');
            }
        }
        else {
            if ($connector == "or") {
                $keyword = explode( ' ', Input::get('keyword'));
                $query = DB::table('books');
                for ($i=0; $i < sizeof($keyword); $i++) {
                    $query->orwhere('title','LIKE','%'.$keyword[$i].'%')
                        ->orwhere('author','LIKE','%'.$keyword[$i].'%');
                }
                // $results = $query->get();
                $results = $query;
            }
            elseif ($connector == "and") {
                $keyword = explode( ' ', Input::get('keyword'));
                $query = DB::table('books');
                for ($i=0; $i < sizeof($keyword); $i++) {
                    $query->where('title','LIKE','%'.$keyword[$i].'%')
                        ->orwhere('author','LIKE','%'.$keyword[$i].'%');
                }
                // $results = $query->get();
                $results = $query;
            }
            else {
                $keyword = Input::get('keyword');
                // $results = Test::where($field,'LIKE','%'.$keyword.'%')->get();
                $results = Book::where('title','LIKE','%'.$keyword.'%')
                    ->orwhere('author','LIKE','%'.$keyword.'%');
            }
        }
        $sortby = Input::get('sortby') ;
        $order = Input::get('order');
        // $results = $results->orderBy($sortby,$order)->get();
        $copy = $results ;
        $results = $results->orderBy($sortby,$order)->get();
        $uniqueresults = $copy->orderBy($sortby,$order)->groupBy('title')->get();


        //    echo "received: ".$sortby."<br>";
        // usort($results, function($a, $b) {
        //    return strcmp($a->$sortby, $b->$sortby);
        // });


// commented code
        // for ($i=0; $i < sizeof($results); $i++) {
        //         echo $results[$i]->id." ".$results[$i]->authors." ".$results[$i]->title;
        //         echo "<br>";
        // }

        // echo "<br><br><br>";
        // for ($i=0; $i < sizeof($uniqueresults); $i++) {
        //     echo $uniqueresults[$i]->authors." ".$uniqueresults[$i]->title;
        //     echo "<br>"."Ids of same books: "."<br>";
        //     for ($j=0; $j < sizeof($results); $j++) {
        //         if ($results[$j]->title == $uniqueresults[$i]->title) {
        //             echo $results[$j]->id."<br>";
        //         }
        //     }
        //     echo "<br>"."<br>";
        // }
// end of comment code

        return View::make('user.bsearchresult')->with('uniqueresults',$uniqueresults)
            ->with('results',$results);
    }
//------------------------advance search starts here---------------------------//

    public function showaform()
    {
        return View::make('user.asearch');
    }
    public function advancesearch()
    {
        if (Input::get('keyword1') == "") {
            return View::make('user.asearch');
        }
        $sortby = Input::get('sortby') ;
        $order = Input::get('order') ;
//-----------------first row code------------------------//

        //parameters
        $connector1 = Input::get('connectors1');
        $field1 = Input::get('basedon1');
        $query = DB::table('books');

        if ($connector1 == "or") {
            $keyword1 = explode( ' ', Input::get('keyword1'));
            for ($i=0; $i < sizeof($keyword1); $i++) {
                $query->orwhere($field1,'LIKE','%'.$keyword1[$i].'%');
            }
        }
        elseif ($connector1 == "and") {
            $keyword1 = explode( ' ', Input::get('keyword1'));
            for ($i=0; $i < sizeof($keyword1); $i++) {
                $query->where($field1,'LIKE','%'.$keyword1[$i].'%');
            }
        }
        else {
            $keyword1 = Input::get('keyword1');
            $query->where($field1,'LIKE','%'.$keyword1.'%');
        }
        $results1 = $query->orderBy($sortby,'asc')->get();

//----------------second row code-------------------//

        //parameters
        $connector2 = Input::get('connectors2');
        $field2 = Input::get('basedon2');
        $radio2 = Input::get('radio2');
        $query = DB::table('books');

        if ($connector2 == "or") {
            $keyword2 = explode( ' ', Input::get('keyword2'));
            for ($i=0; $i < sizeof($keyword2); $i++) {
                $query->orwhere($field2,'LIKE','%'.$keyword2[$i].'%');
            }
            if (Input::get('keyword2') == "") {
                $keyword2 = "";
            }
        }
        elseif ($connector2 == "and") {
            $keyword2 = explode( ' ', Input::get('keyword2'));
            for ($i=0; $i < sizeof($keyword2); $i++) {
                $query->where($field2,'LIKE','%'.$keyword2[$i].'%');
            }
            if (Input::get('keyword2') == "") {
                $keyword2 = "";
            }
        }
        else {
            $keyword2 = Input::get('keyword2');
            $query->where($field2,'LIKE','%'.$keyword2.'%');
        }
        $results2 = $query->orderBy($sortby,'asc')->get();

//------------------third row code---------------------//

        //parameters
        $connector3 = Input::get('connectors3');
        $field3 = Input::get('basedon3');
        $radio3 = Input::get('radio3');
        $query = DB::table('books');

        if ($connector3 == "or") {
            $keyword3 = explode( ' ', Input::get('keyword3'));
            for ($i=0; $i < sizeof($keyword3); $i++) {
                $query->orwhere($field3,'LIKE','%'.$keyword3[$i].'%');
            }
            if (Input::get('keyword3') == "") {
                $keyword3 = "";
            }
        }
        elseif ($connector3 == "and") {
            $keyword3 = explode( ' ', Input::get('keyword3'));
            for ($i=0; $i < sizeof($keyword3); $i++) {
                $query->where($field3,'LIKE','%'.$keyword3[$i].'%');
            }
            if (Input::get('keyword3') == "") {
                $keyword3 = "";
            }
        }
        else {
            $keyword3 = Input::get('keyword3');
            $query->where($field3,'LIKE','%'.$keyword3.'%');
        }
        $results3 = $query->orderBy($sortby,'asc')->get();
//------------------end of rows-----------------//

        if ($radio2 == "or" && $radio3 == "or") {
            if ($keyword2 != "" && $keyword3 != "") {
                //--------------union query--------------//
                $tempresult1 = array_merge($results1,$results3);
                $tempresult = array_merge($tempresult1,$results2);
                $finalresult = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                //--------------union query--------------//
                $tempresult = array_merge($results1,$results3);
                $finalresult = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                //--------------union query--------------//
                $tempresult = array_merge($results1,$results2);
                $finalresult = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "or" && $radio3 == "and") {
            if ($keyword2 != "" && $keyword3 != "") {
                //--------------union query--------------//
                $tempresult = array_merge($results1,$results2);
                $tempresult1 = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
                // -----------intersect query----------//
                $finalresult = array_map('unserialize', array_intersect(array_map('serialize', $results3), array_map('serialize', $tempresult1)) );
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                // -----------intersect query----------//
                $finalresult = array_map('unserialize', array_intersect(array_map('serialize', $results3), array_map('serialize', $results1)) );
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                //--------------union query--------------//
                $tempresult = array_merge($results1,$results2);
                $finalresult = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "or" && $radio3 == "not") {
            if ($keyword2 != "" && $keyword3 != "") {
                //--------------union query--------------//
                $tempresult = array_merge($results1,$results2);
                $tempresult1 = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
                // -----------difference query----------//
                $finalresult = array_udiff($tempresult1, $results3,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                // -----------difference query----------//
                $finalresult = array_udiff($results1, $results3,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                //--------------union query--------------//
                $tempresult = array_merge($results1,$results2);
                $finalresult = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "and" && $radio3 == "or") {
            if ($keyword2 != "" && $keyword3 != "") {
                //--------------intersection query--------------//
                $tempresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results2)) );
                // -----------union query----------//
                $tempresult1 = array_merge( $tempresult, $results3 );
                $tempresult2 = array_map("unserialize", array_unique(array_map("serialize", $tempresult1)));
                $finalresult = $tempresult2;
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                // -----------union query----------//
                $tempresult = array_merge( $results1, $results3 );
                $tempresult1 = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
                $finalresult = $tempresult1;
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                //--------------intersection query--------------//
                $finalresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results2)) );
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "and" && $radio3 == "and") {
            if ($keyword2 != "" && $keyword3 != "") {
                //--------------intersection query--------------//
                $tempresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results2)) );
                // -----------intersection query----------//
                $tempresult1 = array_map('unserialize', array_intersect(array_map('serialize', $results3), array_map('serialize', $tempresult)) );
                $finalresult = $tempresult1;
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                //--------------intersection query--------------//
                $tempresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results3)) );
                $finalresult = $tempresult;
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                //--------------intersection query--------------//
                $tempresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results2)) );
                $finalresult = $tempresult;
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "and" && $radio3 == "not") {
            if ($keyword2 != "" && $keyword3 != "") {
                //--------------intersection query--------------//
                $tempresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results2)) );
                // -----------difference query----------//
                $finalresult = array_udiff($tempresult, $results3,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                // -----------difference query----------//
                $finalresult = array_udiff($results1, $results3,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                //--------------intersection query--------------//
                $finalresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results2)) );
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "not" && $radio3 == "or") {
            if ($keyword2 != "" && $keyword3 != "") {
                // -----------difference query----------//
                $tempresult = array_udiff($results1, $results2,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
                // -----------union query----------//
                $tempresult1 = array_merge( $tempresult, $results3 );
                $tempresult2 = array_map("unserialize", array_unique(array_map("serialize", $tempresult1)));
                $finalresult = $tempresult2;
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                // -----------union query----------//
                $tempresult = array_merge( $results1, $results3 );
                $tempresult1 = array_map("unserialize", array_unique(array_map("serialize", $tempresult)));
                $finalresult = $tempresult1;
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                $finalresult = array_udiff($results1, $results2,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            else {
                $finalresult = $results1;
            }
        }
        elseif ($radio2 == "not" && $radio3 == "and") {
            if ($keyword2 != "" && $keyword3 != "") {
                // -----------difference query----------//
                $tempresult1 = array_udiff($results1, $results2,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
                //--------------intersection query--------------//
                $finalresult = array_map('unserialize', array_intersect(array_map('serialize', $tempresult1), array_map('serialize', $results3)) );
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                //--------------intersection query--------------//
                $finalresult = array_map('unserialize', array_intersect(array_map('serialize', $results1), array_map('serialize', $results3)) );
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                // -----------difference query----------//
                $finalresult = array_udiff($results1, $results2,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            else {
                $finalresult = $results1;
            }
        }
        else {
            if ($keyword2 != "" && $keyword3 != "") {
                // -----------difference query----------//
                $tempresult1 = array_udiff($results1, $results2,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
                $finalresult = array_udiff($tempresult1, $results3,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            elseif ($keyword2 == "" && $keyword3 != "") {
                // -----------difference query----------//
                $finalresult = array_udiff($results1, $results3,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            elseif ($keyword2 != "" && $keyword3 == "") {
                // -----------difference query----------//
                $finalresult = array_udiff($results1, $results2,
                    function ($obj_a, $obj_b) {
                        return $obj_a->id - $obj_b->id;
                    }
                );
            }
            else {
                $finalresult = $results1;
            }
        }
        $copy = $finalresult;
        usort($copy, function($a, $b){
            return ($a->title) - ($b->title);
        });
        //logic to seperate same entries
        if (sizeof($copy) > 0) {
            $uniqueresults = array();
            for ($i=0; $i < sizeof($copy); $i++) {
                if ($i == 0) {
                    array_push($uniqueresults,$copy[$i]);
                }
                else {
                    $oldsize = sizeof($uniqueresults);
                    if ($uniqueresults[$oldsize - 1]->title != $copy[$i]->title) {
                        array_push($uniqueresults,$copy[$i]);
                    }
                }
            }
            $finalresult = $uniqueresults;
        }
        if ($sortby == "title") {
            if ($order == "asc") {
                usort($finalresult, function($a, $b)
                {
                    return ($a->title) - ($b->title);
                });
            }
            usort($finalresult, function($a, $b)
            {
                return ($b->title) - ($a->title);
            });
        }
        if ($sortby == "authors") {
            if ($order == "asc") {
                usort($finalresult, function($a, $b)
                {
                    return ($a->authors) - ($b->authors);
                });
            }
            usort($finalresult, function($a, $b)
            {
                return ($b->authors) - ($a->authors);
            });
        }
        // echo sizeof($finalresult);

//comments closed
        // echo "<br>";
        // for ($i=0; $i < sizeof($finalresult); $i++) {
        //     if (array_key_exists($i, $finalresult)) {
        //         echo $finalresult[$i]->authors." ".$finalresult[$i]->title;
        //         echo "<br>"."Ids of same books: "."<br>";
        //         for ($j=0; $j < sizeof($copy); $j++) {
        //             if ($copy[$j]->title == $finalresult[$i]->title) {
        //                 echo $copy[$j]->id."<br>";
        //             }
        //         }
        //         echo "<br>"."<br>";
        //         echo "<br>";
        //     }
        // }
//end of comments


        return View::make('user.asearchresult')->with('finalresult',$finalresult)
            ->with('copy',$copy);
    }

//--------------new books suggest------------//
    public function submitsuggestion()
    {
        // return a response
        $title = Input::get('title');
        $author = Input::get('author');
        $publication = Input::get('publication');
        $edition = Input::get('edition');
        $user_id = Auth::user()->get()->id;
        // $user_id = 1;
        DB::table('new_add_options')->insert(array('title' => $title, 'votes' => 0 , 'author' => $author,'publication' => $publication,'edition' => $edition,'user_id' => $user_id));
        return View::make('user.additions');
    }
    public function new_additions()
    {
        return View::make('user.additions');
    }
    public function upvote()
    {
        $data = array();
        $data['id'] = Input::get('id');
        $data['user_id'] = (int)Input::get('user_id');
        $data['action'] = Input::get('action');
        if ($data['action'] == 'up') {
            DB::table('nao_details')->insert(array('user_id' => Input::get('user_id'),'nao_id' => Input::get('id')));
            DB::table('new_add_options')->where('id',intval(Input::get('id')))->increment('votes');
        }
        else {
            $affectedRows = DB::table('nao_details')->where('user_id',intval(Input::get('user_id')))
                ->where('nao_id',intval(Input::get('id')))
                ->delete();
            // $data['error'] = sizeof($affectedRows);
            if (sizeof($affectedRows) != 0) {
                DB::table('new_add_options')->where('id',intval(Input::get('id')))->decrement('votes');
            }
        }
        $data['message'] = 'Success!';
        echo json_encode($data);
    }

    public function index(){
        return View::make('books.index')
            ->with('title','Mutual Books Transfer')
            ->with('books',Book::all()) ;
    }
    public function get_view($id){
        return View::make('books.view')
            ->with('title','Books Transfer Page')
            ->with('book', Book::find($id));
    }
    public function transfer()
    {
        $data = array();
        $id=Input::get('id');
        $user=Auth::user()->get();
        $book=Book::find($id);
        $book->available=0;
        $mutualtransfer = new Mutualtransfer;
        $mutualtransfer->book_id=$id;
        $mutualtransfer->requester_id=$user->id;
        $mutualtransfer->owner_id=$book->issue;
        $mutualtransfer->status=0;
        $mutualtransfer->pin=Crypt::encrypt(str_random(5));
        $data['pin'] = Crypt::decrypt($mutualtransfer->pin);
        $mutualtransfer->save();
        $book->save();
        echo json_encode($data);
    }

    public function cancel()
    {
        $id=Input::get('id');
        $mtf=Mutualtransfer::find($id);
        $mtf->delete();
        return View::make('user.queued_books');

    }
    public function transferfinish()
    {
        $id=Input::get('id');
        $pin=Input::get('pin');
        $mtf=Mutualtransfer::find($id);

        if($pin==Crypt::decrypt($mtf->pin))
        {
            $mtf->status=1;
            $mtf->save();
            $book=Book::find($mtf->book_id);
            $req=User::find($mtf->requester_id);
            $own=User::find($mtf->owner_id);

            $book->issue=$mtf->requester_id;
            $book->available=0;
            $req->no_books_issued=$req->no_books_issued+1;
            $own->no_books_issued=$own->no_books_issued-1;
            $book->save();
            $req->save();
            $own->save();

            $trans = new Transaction;
            $trans->book_id=$book->id;
            $trans->user_id=$req->id;
            $trans->transaction_type=3;
            $trans->save();
        }
        return View::make('user.queued_books');
    }

    public function new_arrivals()
    {
        $limit_days = 9;
        $limit_seconds = $limit_days*24*60*60;

        $new_books = DB::table('books')
            ->where('created_at', '>=', Carbon::now()->subDays($limit_days))
            ->orderBy('created_at','desc')
            ->get();

        return View::make('user.new_arrivals')->with('new_books',$new_books)->with('limit_days',$limit_days);
    }
    public function feedback()
    {
        return View::make('user.feedback');
    }

    public function postfeedback()
    {
        $res=Input::get('text');
        //$id=Auth::user()->get()->id;
        $id=1;
        DB::table('feedback')->insert(
            array(
                'feedback'   => $res,
                'user_id' =>   $id  )
        );

        return Redirect::action('UserController@home');//->with("modal_message_error", "You must be logged in to view this page.");
    }

    

}
