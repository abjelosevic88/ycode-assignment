<?php

use Illuminate\Database\Seeder;

class WebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // FIXME :: This could potentially lead to create 2 websites with equal url but for this number it would be quite random
        factory(App\Website::class, 10)->create();
    }
}
