<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class linenotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
      $uri = 'https://notify-api.line.me/api/notify';
      $client = new Client();
      $client->post($uri, [
          'headers' => [
              'Content-Type'  => 'application/x-www-form-urlencoded',
              'Authorization' => 'Bearer 4ptoQpmb3ff5xK0lY7U9YASchL1VdZXBaRIqdHQ5Xya',
          ],
          'form_params' => [
              'message' => 'Hello, World!'
          ]
      ]);
    }
}
