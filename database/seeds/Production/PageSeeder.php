<?php


class PageSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = [
            'buildoffs',
            'client',
            'privacy'
        ];

        foreach ($ids as $id) {
            $page = new \PN\Pages\Page();
            $page->id = $id;
            $page->title = $id;
            $page->slug = $id;
            $page->content = $id;

            \PageRepo::add($page);
        }
    }
}