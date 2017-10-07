<?php

namespace Modules\Page\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Page\Repositories\PageRepository;

class PageDatabaseSeeder extends Seeder
{
    /**
     * @var PageRepository
     */
    private $page;

    public function __construct(PageRepository $page)
    {
        $this->page = $page;
    }

    public function run()
    {
        Model::unguard();

        $data = [
            'TEMPLATE' => 'home',
            'IS_HOME' => 1,
            'en' => [
                'TITLE' => 'Home page',
                'SLUG' => 'home',
                'BODY' => '<p><strong>You made it!</strong></p>

',
                'META_TITLE' => 'Home page',
            ],
        ];
        $this->page->create($data);
    }
}
