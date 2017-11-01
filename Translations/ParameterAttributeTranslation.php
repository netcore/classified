<?php

namespace Modules\Classified\Translations;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class ParameterAttributeTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_classified__parameter_attribute_translations';

    use SoftDeletes;

    protected $fillable = [
        'name',
        'locale' // This is mandatory
    ];

    public $timestamps = false;

}
