<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('people')->delete();

        \DB::table('people')->insert(array(
            0 => array(
                'id' => 1,
                'tenant_id' => 1,
                'term_id' => null,
                'title' => 'mr',
                'suffix' => 'gh',
                'first_name' => 'omkar',
                'middle_name' => 'verm',
                'last_name' => 'd',
                'type' => 'Customer',
                'company' => 'dfgd',
                'website_uri' => 'wwwwww.com',
                'deleted_at' => null,
                'created_at' => '2020-03-27 11:45:55',
                'updated_at' => '2020-03-27 11:45:55',
            ),
            1 => array(
                'id' => 2,
                'tenant_id' => 2,
                'term_id' => null,
                'title' => 'mr',
                'suffix' => 'gh',
                'first_name' => 'omkar',
                'middle_name' => 'verm',
                'last_name' => 'd',
                'type' => 'Customer',
                'company' => 'dfgd',
                'website_uri' => 'wwwwww.com',
                'deleted_at' => null,
                'created_at' => '2020-03-28 03:45:28',
                'updated_at' => '2020-03-28 03:45:28',
            ),
        ));

    }
}
