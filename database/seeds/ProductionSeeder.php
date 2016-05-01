<?php


class ProductionSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(StatSeeder::class);
        $this->call(PageSeeder::class);
    }
}