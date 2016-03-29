<?php

class UserSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = 500;
        for ($i = 0; $i < $users; $i++) {
            try {
                $user = factory(\PN\Users\User::class)->create();

                $user->setAvatar(file_get_contents($this->getRandomFile(base_path('database/seeds/files/avatars'))));

                $user->save();

                echo "Created user $i/$users\n";
            } catch (Exception $e) {
                // skip exceptions caused by uniques
            }
        }
    }
}
