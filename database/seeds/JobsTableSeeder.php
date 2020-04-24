<?php

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobsTableSeeder extends Seeder
{
    public function run()
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 0; $i < 500; $i++) {
            Job::create([
                'processor_id' => ( $i%2 == 0 )? mt_rand(1000,9999):null,
                'submitter_id' => mt_rand(1000,9999),
                'command' => substr(str_shuffle($permitted_chars), 0, 16)
            ]);
        }
    }
}
