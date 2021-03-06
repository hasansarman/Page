<?php

namespace Modules\Page\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Page\Events\PageIsCreating;
use Modules\Page\Events\PageIsUpdating;
use Modules\Page\Events\PageWasCreated;
use Modules\Page\Events\PageWasDeleted;
use Modules\Page\Events\PageWasUpdated;
use Modules\Page\Repositories\PageRepository;

class EloquentPageRepository extends EloquentBaseRepository implements PageRepository
{

    /**
     * Find the page set as homepage
     * @return object
     */
    public function findHomepage()
    {
        return $this->model->where('IS_HOME', 1)->first();
    }

    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {
        if (array_get($data, 'IS_HOME') === '1') {
            $this->removeOtherHomepage();
        }

        event($event = new PageIsCreating($data));
        $page = $this->model->create($data);

        event(new PageWasCreated($page->ID, $data));

        $page->setTags(array_get($data, 'tags', []));

        return $page;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {
        if (array_get($data, 'IS_HOME') === '1') {
            $this->removeOtherHomepage($model->id);
        }

        event($event = new PageIsUpdating($model, $data));
        $model->update($event->getAttributes());

        event(new PageWasUpdated($model->ID, $data));

        $model->setTags(array_get($data, 'tags', []));

        return $model;
    }

    public function destroy($page)
    {
        $page->untag();

        event(new PageWasDeleted($page));

        return $page->delete();
    }

    /**
     * @param $slug
     * @param $locale
     * @return object
     */
    public function findBySlugInLocale($slug, $locale)
    {

        return $this->model->where('SLUG', $slug)->where('LOCALE', $locale)->first();
    }

    /**
     * Set the current page set as homepage to 0
     * @param null $pageId
     */
    private function removeOtherHomepage($pageId = null)
    {
        $homepage = $this->findHomepage();
        if ($homepage === null) {
            return;
        }
        if ($pageId === $homepage->ID) {
            return;
        }

        $homepage->IS_HOME = 0;
        $homepage->save();
    }
}
