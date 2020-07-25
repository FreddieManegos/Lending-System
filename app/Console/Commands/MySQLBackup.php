<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\Databases\MySql;

class MySQLBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a MySql backup';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $username = \Config::get('database.connections.mysql.username');
//        $password = \Config::get('database.connections.mysql.password');
//        $dbname = \Config::get('database.connections.mysql.database');
//        $filename = $dbname.'_' . \Carbon\Carbon::now()->toDateString() . '.sql';
//        if(exec('mysqldump -u'.$username.' -p'.$password.' '.$dbname. ' > ' . $filename));
//        {
//            $this->info('Your backup is being saved to the root directory ' . $filename);
//        }
        MySql::create()
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->setHost(env('DB_HOST'))
            ->setPort(env('DB_PORT'))
            ->dumpToFile(base_path('storage\\app\\public\\mysql\\'.\Carbon\Carbon::now()->format('Y-m-d_i_s').'.sql'));
    }
};
