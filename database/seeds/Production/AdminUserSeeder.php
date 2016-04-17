<?php


class AdminUserSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->dispatch(new \PN\Users\Jobs\RegisterUser('Admin', 'Administrator', 'admin@parkitectnexus.com', 'parkitect123', true));
    }
}