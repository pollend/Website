<?php

class UserSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            try {
                factory(\PN\Users\User::class)->create();
            } catch (Exception $e) {
                // skip exceptions caused by uniques
            }
        }
    }
}
