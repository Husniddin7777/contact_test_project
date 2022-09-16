<?php

namespace Database\Seeders;

use App\Models\ContactEmail;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EmailsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 40; $i++) {
            $emails = new ContactEmail();
            $emails->email = Factory::create()->email;
            $emails->contact_id = Factory::create()->numberBetween(1,20);
            $emails->save();
        }
    }
}
