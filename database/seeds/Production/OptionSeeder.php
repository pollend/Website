<?php


class OptionSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = [
            'required_assets'
        ];

        foreach ($ids as $id) {
            $page = new \PN\Foundation\Option();
            $page->id = $id;

            \OptionRepo::add($page);
        }
    }
}