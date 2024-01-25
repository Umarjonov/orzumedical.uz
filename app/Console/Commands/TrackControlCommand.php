<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TrackControlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:control:cronSend';
    protected $description = 'Run cronSend method from TrackController';
    protected $commands = [
        \App\Console\Commands\TrackControlCommand::class,
    ];
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $trackController = new \App\Http\Controllers\Api\TrackController;
            $trackController->cronSend();
        } catch (\Exception $e) {
            \Log::error('Error executing cronSend: ' . $e->getMessage());
        }
    }
}
