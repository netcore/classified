<?php

namespace Modules\Classified\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\SyncTranslations;
use Modules\Classified\Translations\FieldAttributeTranslation;

class FieldAttribute extends Model
{
    use Translatable, SyncTranslations;

    /**
     * @var array
     */
    protected $fillable = [
        'value',
        'is_active',
        'parameter_id',
    ];
    /**
     * @var string
     */
    public $translationModel = FieldAttributeTranslation::class;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'name'
    ];

    /**
     * @var array
     */
    protected $with = ['translations'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

}
