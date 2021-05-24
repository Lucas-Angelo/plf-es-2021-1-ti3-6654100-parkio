<?php
namespace App\Console\Commands;

use App\Services\VehicleService;
use Illuminate\Console\Command;

class TelegramCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:alert';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alert delayed vehicles on telegram';
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
        $as = new VehicleService();
        $as->findDelayed();
    }
}