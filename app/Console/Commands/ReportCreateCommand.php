<?php

namespace App\Console\Commands;

use App\Report;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReportCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a status report for the active Discord shards.';

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
        Report::create($this->reportData());

        $this->info('Report have been saved to the database!');
    }

    /**
     * Get the report data.
     *
     * @return array
     */
    protected function reportData()
    {
        $report = DB::table('shards')
                 ->where('updated_at', '>', Carbon::now()->subMinutes(10))
                 ->get();

        return [
            'guilds'   => $report->sum('guilds'),
            'channels' => $report->sum('channels'),
            'users'    => $report->sum('users'),
        ];
    }
}
