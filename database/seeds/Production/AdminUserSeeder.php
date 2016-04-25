<?php


use PN\Users\Jobs\RegisterUser;

class AdminUserSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $this->dispatch(new RegisterUser('Admin', 'Administrator', 'admin@parkitectnexus.com', 'parkitect123', true));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}