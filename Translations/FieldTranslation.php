<?php
namespace Modules\Classified\Translations;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class FieldTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_classified__field_translations';

    use SoftDeletes;

    protected $fillable = [
        'name',
        'locale' // This is mandatory
    ];

    public $timestamps = false;
}
