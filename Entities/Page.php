<?php

namespace Modules\Page\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Tag\Contracts\TaggableInterface;
use Modules\Tag\Traits\TaggableTrait;

class Page extends Model implements TaggableInterface
{
    use  TaggableTrait, NamespacedEntity;
    protected $primaryKey="ID";
    const CREATED_AT = 'IDATE';
    const UPDATED_AT = 'UDATE';
    protected $table = 'pages';


    protected $fillable = [
        'IS_HOME',
        'TEMPLATE',
        // Translatable fields

        'TITLE',
        'SLUG',
        'STATUS',
        'BODY',
        'META_TITLE',
        'META_DESCRIPTION',
        'OG_TITLE',
        'OG_DESCRIPTION',
        'OG_IMAGE',
        'OG_TYPE',
    ];
    protected $casts = [
        'IS_HOME' => 'boolean',
    ];
    protected static $entityNamespace = 'asgardcms/page';

    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.page.config.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}
