<?php

namespace MariusLab\Console\Commands;

use Illuminate\Console\Command;
use MariusLab\Owner;

class AddOwner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:owner {unique_id} {api_key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new task owner to the database';

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
     * @return void
     */
    public function handle()
    {
        $third_party_id = $this->argument('unique_id');
        $api_key = $this->argument('api_key');

        if (strlen($api_key) > 190) {
            $this->error('API key too long.');
        }

        $owner = Owner::where('api_key', $api_key)
            ->first();
        if ($owner !== null) {
            $this->error('Provided api key already exists.');
            return;
        }

        $owner = new Owner;
        $owner->third_party_id = $third_party_id;
        $owner->api_key = $api_key;
        $owner->save();
        $this->info('Owner added.');
    }
}
