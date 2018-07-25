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
     * @return mixed
     */
    public function handle()
    {
        $third_party_id = $this->argument('unique_id');
        $api_key = crypt($this->argument('api_key'), env("API_SALT", "dummysalt"));

        $owner = Owner::where('third_party_id', $third_party_id)
            ->first();
        if ($owner !== null) {
            $this->error('Task owner with provided id already exists.');
            return;
        }

        $owner = Owner::where('api_key', $api_key)
            ->first();
        if ($owner !== null) {
            $this->error('Task owner with provided api key already exists.');
            return;
        }

        $owner = new Owner;
        $owner->third_party_id = $third_party_id;
        $owner->api_key = $api_key;
        $owner->save();
        $this->info('Owner added.');
    }
}
