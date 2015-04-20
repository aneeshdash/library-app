<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class bookQueue extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'libapp:bookQueue';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send mails for queues once book is returned.';

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
		return $scheduler->daily()->hours(15);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		foreach(Book::where('queue1','>',0)->get() as $book) {
            $tran=Transaction::where('book_id',$book->id)->where('transaction_type','RETURNED')->first();
            if($tran->created_at < Carbon::now()->subDay()) {
                $book->queue1=null;
                if($book->queue2 != null) {
                    $book->queue1 = $book->queue2;
                    $book->queue2=null;
                    $user=User::find($book->queue1);
                    Mail::send('emails.bookQueue', array('user' => $user, 'book' => $book) ,function($message) use($user)
                    {
                        $message->from('a.dash@iitg.ernet.in', 'Aneesh Dash');
                        $message->to($user->webmail, $user->name)->subject('Book Queue');
                    });
                    if($book->queue3 != null) {
                        $book->queue2 = $book->queue3;
                        $book->queue3=null;
                        if($book->queue4 != null) {
                            $book->queue3 = $book->queue4;
                            $book->queue4=null;
                            if($book->queue5 != null) {
                                $book->queue4 = $book->queue5;
                                $book->queue5=null;
                            }
                        }
                    }
                }
            }
            else {
                $user=User::find($book->queue1);
                Mail::send('emails.bookQueue', array('user' => $user, 'book' => $book) ,function($message) use($user)
                {
                    $message->from('a.dash@iitg.ernet.in', 'Aneesh Dash');
                    $message->to($user->webmail, $user->name)->subject('Book Queue');
                });
            }
        }
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
