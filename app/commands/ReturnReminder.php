<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \DB;
use \Eloquent;
use \Mail;
use \Carbon;

class ReturnReminder extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'libapp:return-reminder';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Mails sent to students whose return is due within 2 days.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * When a command should run
	 *
	 * @param Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        foreach(Book::whereBetween('return_date',array(Carbon::now(),Carbon::now()->addDays(2)))->groupBy('issue')->get() as $us) {
            $id=$us->issue;
            $user=User::find($id);
            $books = array();
            foreach($user->books as $book) {
                if($book->return_date < Carbon::now()->addDays(2) && $book->return_date != null) {
                    $books[] = $book->return_date < Carbon::now()->addDays(2) && $book->return_date != null;
                }
            }
        Mail::send('emails.returnReminder', array('user' => $user, 'books' => $books) ,function($message) use($user)
        {
            $message->from('a.dash@iitg.ernet.in', 'Aneesh Dash');
            $message->to($user->webmail, $user->name)->subject('Book return reminder');
        });
        }
        Log::info('done');
        return $this->info('Success');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
//			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
//			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
