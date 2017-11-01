<?php

namespace Modules\Classified\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\SyncTranslations;
use Modules\Classified\Translations\ParameterAttributeTranslation;

class ParameterAttribute extends Model
{
    use Translatable, SyncTranslations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_classified__parameter_attributes';

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
    public $translationModel = ParameterAttributeTranslation::class;

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
