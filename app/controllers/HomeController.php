<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function func_edit()
    {
        $table = Input::get('table');
        if(Auth::admin()->guest()) {
            return 'Abhi tum bachhe ho!!! :)';
        }
        elseif( $table == "user" )
        {
            $type=Input::get('type');
            $id=Input::get('id');
            $name=Input::get('name');
            $webmail=Input::get('webmail');
            $roll=intval(Input::get('roll'));
            $cat=Input::get('cat');
            $user=User::find(intval($id));
            if(User::where('webmail', $webmail)->whereNotIn('id',$id)->exists() || User::where('roll', $roll)->whereNotIn('id',$id)->exists()) {
                return 'Similar user credentials exist for another user';
            }
            else {
                $user->name = $name;
                $user->webmail = $webmail;
                $user->roll = $roll;
                $user->type = $cat;
                $user->save();
                return 'success';
            }
        }
        elseif( $table == "book")
        {

            $id = Input::get('id');
            $title = Input::get('title');
            $authors = Input::get('authors');
            $edition = Input::get('edition');
            $code = Input::get('code');
            $isbn = Input::get('isbn');
            $publication = Input::get('publication');
            $category = Input::get('category');
            $publication_id = DB::table('publications')->where('name',$publication)->pluck('id');
            $cat_id = DB::table('book_category')->where('name',$category)->pluck('id');
            $book=Book::find(intval($id));
            $book->title = $title;
            $book->authors = $authors;
            $book->edition = $edition;
            $book->code = $code;
            $book->isbn = $isbn;
            $book->publication_id = $publication_id;
            $book->category_id = $cat_id;
            $book->save();
            return 'books success';
        }
        elseif( $table == "lost" )
        {
            $id = Input::get('id');
            $title = Input::get('title');
            $authors = Input::get('authors');
            $code = Input::get('code');
            $isbn = Input::get('isbn');
            $edition = Input::get('edition');
            $publication = Input::get('publication');
            $status = Input::get('status');
            $book=LostBook::find(intval($id));
            $book_id = DB::table('books')->where('code',$code)->pluck('id');
            $book->book_id = $book_id;
            $book->title = $title;
            $book->authors = $authors;
            $book->edition = $edition;
            $book->code = $code;
            $book->ISBN = $isbn;
            $book->edition = $edition;
            $book->publication = $publication;
            $book->status = $status;
            $book->save();
            return "lostbook success";
        }
        elseif( $table == "new" )
        {
            $id = Input::get('id');
            $title = Input::get('title');
            $author = Input::get('author');
            $edition = Input::get('edition');
            $publication = Input::get('publication');
            $votes = Input::get('votes');
            DB::table('new_add_options')->where('id',$id)->update(array('title'=>$title,'author'=>$author,'edition'=>$edition,'publication'=>$publication,'votes'=>$votes));
            return 'cat success';
        }
        elseif( $table == "cat" )
        {
            $id = Input::get('id');
            $name = Input::get('name');
            $book=Category::find(intval($id));
            $book->name = $name;
            $book->save();
            return 'cat success';
        }
        elseif( $table == "rule" )
        {
            $id = Input::get('id');
            $priority = Input::get('priority');
            $rule = Input::get('rule');
            $book=Rules::find(intval($id));
            $book->priority = $priority;
            $book->rule = $rule;
            $book->save();
            return 'rules success';
        }
        elseif( $table == "env" )
        {
            $id = Input::get('id');
            $name = Input::get('name');
            $value = Input::get('value');
            $description = Input::get('description');
            $var=Env::find(intval($id));
            $var->variable = $name;
            $var->value = $value;
            $var->description = $description;
            $var->save();
            return 'var success';
        }
        elseif( $table == "admin" )
        {
            $id = Input::get('id');
            $name = Input::get('name');
            $email = Input::get('email');
            $admin=Admin::find(intval($id));
            $admin->username = $name;
            $admin->email = $email;
            $admin->save();
            return 'admin success';
        }
        elseif( $table == "pub" )
        {
            $id = Input::get('id');
            $name = Input::get('name');
            $book=Publication::find(intval($id));
            $book->name = $name;
            $book->save();
            return 'pub success';
        }
        return("no user,books");
    }

    public function func_add()
    {
        $table = Input::get('table');
        if(Auth::admin()->guest()) {
            return 'Abhi tum bachhe ho!!! :)';
        }
        elseif( $table == 'user') {
            $type = Input::get('type');
            $name = Input::get('name');
            $webmail = Input::get('webmail');
            $roll = intval(Input::get('roll'));
            $cat = Input::get('cat');
            if (User::where('roll', $roll)->exists() || User::where('webmail', $webmail)->exists()) {
                return 'Similar user details exists';
            } else {
                $user = new User;
                $user->name = $name;
                $user->webmail = $webmail;
                $user->roll = $roll;
                $user->type = $cat;
                $user->save();
                return 'success';
            }
        }
        elseif( $table == 'book')
        {

            $title=Input::get('title');
            $authors=Input::get('authors');
            $edition=Input::get('edition');
            $code=Input::get('code');
            $isbn=Input::get('isbn');
            $publication=Input::get('publication');
            $category= Input::get('category');
            $book=new Book;
            $book->title=$title;
            $book->authors =$authors;
            $book->edition=$edition;
            $book->code=$code;
            $book->ISBN=$isbn;
            $pub_id = DB::table('publications')->where('name',$publication)->pluck('id');
            $cat_id = DB::table('book_category')->where('name',$category)->pluck('id');
            $book->publication_id=$pub_id;
            $book->category_id=$cat_id;
            $book->save();
            return 'success';
        }
        elseif( $table == "lost" )
        {

            $title = Input::get('title');
            $authors = Input::get('authors');
            $code = Input::get('code');
            $isbn = Input::get('isbn');
            $edition = Input::get('edition');
            $publication = Input::get('publication');
            $status = Input::get('status');
            $roll = Input::get('roll');
            $user_id = DB::table('users')->where('roll',$roll)->pluck('id');
            $book_id = DB::table('books')->where('code',$code)->pluck('id');
            $book=new LostBook;
            $book->book_id = $book_id;
            $book->title = $title;
            $book->authors = $authors;
            $book->edition = $edition;
            $book->code = $code;
            $book->ISBN = $isbn;
            $book->edition = $edition;
            $book->publication = $publication;
            $book->status = $status;
            $book->user_id = $user_id;
            $book->save();
            return "lostbook success";
        }
        elseif( $table == "cat" ){


            $name = Input::get('name');
            $book=new Category;
            $book->name = $name;
            $book->save();
            return 'cat success';
        }
        elseif( $table == "rule" ){


            $priority = Input::get('priority');
            $rule = Input::get('rule');
            $book=new Rules;
            $book->priority = $priority;
            $book->rule = $rule;
            $book->save();
            return 'rule success';
        }
        elseif( $table == "env" ){

            $name = Input::get('name');
            $value = Input::get('value');
            $description = Input::get('description');
            $var=new Env;
            $var->variable = $name;
            $var->value = $value;
            $var->description = $description;
            $var->save();
            return 'var success';
        }
        elseif( $table == "pub" ){


            $name = Input::get('name');
            $book=new Publication;
            $book->name = $name;
            $book->save();
            return 'pub success';
        }
        elseif( $table == "admin" ){


            $username = Input::get('name');
            $email = Input::get('email');
            $admin=new Admin;
            $admin->username = $username;
            $admin->email= $email;
            $admin->save();
            return 'admin success';
        }
    }

    public function func_del()
    {
        $type = Input::get('type');

        if(Auth::admin()->guest()) {
            return 'Abhi tum bachhe ho!!! :)';
        }
        elseif( $type == "user" ){

            $id = Input::get('id');
            $user=User::find(intval($id));
            $cnt = $user->no_books_issued;
            if($cnt != 0){
                return 'Users has books issued in his name.';
            }
            elseif(LostBook::where('user_id',$id)->count() != 0){
                return 'Remove the user_id from the lost_book table';
            }
            else{
                Feedback::where('user_id',$id)->delete();
                BookRating::where('user_id',$id)->delete();
                Transaction::where('user_id',$id)->delete();
                NewDetails::where('user_id',$id)->delete();
                DB::table('students_visiting')->where('user_id',$id)->delete();
                User::destroy(intval($id));
                return 'User successfully deleted from database';
            }
        }
        elseif( $type == "book" ){

            $id = Input::get('id');

            if(LostBook::where('book_id',$id)->count() != 0){
                return 'There book id is being is used in lost_book table';
            }
            else{
                BookRating::where('book_id',$id)->delete();
                Transaction::where('book_id',$id)->delete();
                Book::destroy(intval($id));
                return 'book Successfully deleted from database';
            }
        }
        elseif( $type == "lost" ){

            $id = Input::get('id');
            LostBook::destroy(intval($id));
            return 'lost success';
        }
        elseif( $type == "new" ){

            $id = Input::get('id');
            NewAdd::destroy(intval($id));
            return 'cat success';
        }
        elseif( $type == "cat" ){

            $id = Input::get('id');
            if( Book::where('category_id',$id)->count() != 0){
                return 'There is some book in the books table using this category id';
            }
            else{
                Category::destroy(intval($id));
                return 'cat success';
            }
        }
        elseif( $type == "pub" ){

            $id = Input::get('id');
            if( Book::where('publication_id',$id)->count() != 0){
                return 'There is some book in the books table using this publication id';
            }
            else{
                Publication::destroy(intval($id));
                return 'pub success';
            }

        }
        elseif( $type == "rule" ){

            $id = Input::get('id');
            Rules::destroy(intval($id));
            return 'rule success';
        }
        elseif( $type == "env" ){

            $id = Input::get('id');
            Env::destroy(intval($id));
            return 'var success';
        }
        elseif( $type == "admin" ){

            $id = Input::get('id');
            $check = Input::get('passwd');
            $admin=Admin::find(intval($id));
            $hashedPassword = $admin->password;
            if (Hash::check($check, $hashedPassword))
            {
                // Admin::destroy(intval($id));
                return 'admin success';
            }
        }

        // $book=Book::where('id','1')->first();
        // $publication=$book->publication()->name;
    }

    public function book_detail()
    {
        $id=Input::get('id');
        return View::make('functions.book_detail')->with('book', Book::find(intval($id)));
    }

    public function pay_fine()
    {
        $id=intval(Input::get('user'));
        $amt=intval(Input::get('amt'));
        $user=User::find($id);
        $user->fine -= $amt;
        if($user->save()) {
            return 'Fine Paid';
        }
        else {
            return 'Error Occured.\n Try Again';
        }
    }

    public function show_book() {
        $code=intval(Input::get('code'));
        $book=Book::where('code',$code)->first();
        return View::make('functions.show_book')->with('book', $book);
    }

    public function issue_book() {
        $code=Input::get('code');
        $book=Book::where('code',$code)->first();
        if($book->issue == null) {
            $book->issue = intval(Input::get('user'));
            $book->issue_no = 1;
            if ($book->save()) {
                return 'Book Successfully Issued';
            } else {
                return 'Error occured while issuing. Please try again.';
            }
        }
        else {
            return 'This book is already issued to an user';
        }
    }

    public function new_del()
    {

        $id=Input::get('id');
        DB::table('nao_details')->where('nao_id',$id)->delete();

        NewAdd::destroy(intval($id));

    }
    public function update_lostbook()
    {
        $id=Input::get('id');
        $title=Input::get('title');
        $authors=Input::get('authors');
        $publication=Input::get('publication');
        $edition=Input::get('edition');
        $isbn=Input::get('isbn');
        $code=Input::get('code');
        DB::table('lost_book')->where('id',$id)->update(array('title' => $title,'authors' => $authors,'publication' => $publication,'edition' => $edition,'code' => $code,'ISBN' =>$isbn,'status' => 'ACCEPTED'));

    }

    public function lost_book() {
        $code=Input::get('code');
//        return $code;
        $book=Book::where('id',$code)->first();
//        return $book->lostbook->title;
        return View::make('functions.lost_book')->with('book',$book);
    }

    public function ret_book() {
        $user_id=intval(Input::get('user'));
        $book_id=intval(Input::get('book'));
        if(User::where('id', $user_id)->exists() && Book::where('id', $book_id)->exists()) {
            $book=Book::find($book_id);
            if($book->issue == $user_id) {
                $book->issue_date=null;
                $book->return_date=null;
                $book->issue=null;
                $book->save();
                return 'Book successfully returned.';
            }
            else {
                return 'The book is not issued to this user.';
            }
        }
        else {
            return 'Invalid Input. Please refresh the page';
        }
    }

    public function reissue_book() {
        $user_id=intval(Input::get('user'));
        $book_id=intval(Input::get('book'));
        if(User::where('id', $user_id)->exists() && Book::where('id', $book_id)->exists()) {
            $book=Book::find($book_id);
            if($book->issue == $user_id) {
                if($book->issue_no < 1)
                $book->issue_date=Carbon::now();
                $book->return_date=Carbon::now()->addDays(30);
                $book->issue=$user_id;
                $book->issue_no += 1;
                $book->save();
                return 'Book successfully reissued.';
            }
            else {
                return 'The book is not issued to this user.';
            }
        }
        else {
            return 'Invalid Input. Please refresh the page';
        }
    }

    public function ret_lost() {
        $book_id=intval(Input::get('code'));
        $book=Book::find($book_id);
        $book->title=Input::get('title');
        $book->authors=Input::get('authors');
        $book->publication_id=intval(Input::get('publication'));
        $book->ISBN=intval(Input::get('isbn'));
        $book->lost=0;
        $book->issue=null;
        $book->return_date=null;
        $book->issue_Date=null;
        $book->save();
        LostBook::where('book_id', $book_id)->first()->delete();
        return 'Book details updated';
    }

    public function newadd() {
        $id=intval(Input::get('id'));
        $book=Book::find($id);
        return View::make('functions.newadd')->with('book', $book);
    }

    public function updates() {
        $subject = Input::get('subject');
        $message = Input::get('message');
        $post =new Updates;
        $post->subject = $subject;
        $post->message = $message;
        $post->save();
        return 'update successful';
    }
}
