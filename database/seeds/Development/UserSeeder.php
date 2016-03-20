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
        for ($i = 0; $i < 500; $i++) {
            try {
                $user = factory(\PN\Users\User::class)->create();

                $faker = \Faker\Factory::create();

                $user->setAvatar(file_get_contents($faker->image));

                $user->save();
            } catch (Exception $e) {
                // skip exceptions caused by uniques
            }
        }
    }
}
