<?php

namespace Tests\Assets\Controllers;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use PN\Assets\Jobs\CreateAsset;
use PN\Assets\Jobs\Tags\AttachTagToAsset;
use PN\Assets\Repositories\TagRepositoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\Assets\Jobs\Tags\AttachTagToAssetTest;
use Tests\FactoryTrait;

class AssetManageControllerTest extends \TestCase
{
    use FactoryTrait;

    public function test_file_upload()
    {
        $this->login();

        $this->visit(route('assets.manage.selectfile'))
            ->followRedirects()
            ->attach(base_path('tests/files/park.txt'), 'resource')
            ->press('Upload')
            ->seeInSession('resource');
    }

    public function test_create_screen_basic()
    {
        $this->login();

        $this->withSession(['resource' => \ResourceUtil::make(base_path('tests/files/park.txt'))])
            ->visit(route('assets.manage.create'))
            ->type('Asset test', 'name')
            ->type('Lorem ipsum much', 'description')
            ->press('Create');
    }

    public function test_create_screen_tags()
    {
        $this->login();

        $tags = \TagRepo::findSecondary('park');

        $this->withSession(['resource' => \ResourceUtil::make(base_path('tests/files/park.txt'))])
            ->visit(route('assets.manage.create'))
            ->type('Asset test', 'name')
            ->type('Lorem ipsum much', 'description')
            ->check('tags['.$tags->first()->id.']')
            ->press('Create')
            ->followRedirects()
            ->see($tags->first()->name);
    }
}
