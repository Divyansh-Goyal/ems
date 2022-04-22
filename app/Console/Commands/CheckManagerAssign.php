<?php

namespace App\Console\Commands;

use App\managerTeam;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CheckManagerAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkmanagerassign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if (Auth::user()->role === 'Employee') {
            $manager = managerTeam::ManagerName();
            if (empty($manager)) {
                echo "Hello";
            }
        }
        echo "Hello \n";
    }
}