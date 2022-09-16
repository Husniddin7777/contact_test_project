<?php

namespace Database\Seeders;

use App\Models\ContactPhone;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PhonesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 40; $i++) {
            $phones = new ContactPhone();
            $phones->phone = Factory::create()->phoneNumber;
            $phones->contact_id = Factory::create()->numberBetween(1,20);
            $phones->save();
        }
    }
}
