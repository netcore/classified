<?php

namespace Modules\Classified\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\SyncTranslations;
use Modules\Classified\Translations\FieldTranslation;

class Field extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_classified__fields';

    use Translatable, SyncTranslations;

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'options',
        'input',
        'is_active',
    ];
    /**
     * @var string
     */
    public $translationModel = FieldTranslation::class;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(FieldAttribute::class);
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class,
            'advertisement_parameter_attribute')->withPivot('value')->with('attributes');
    }

    /**
     * @return string
     */
    public function getCategoryNameAttribute()
    {
        switch ($this->category) {
            case 'cars':
                $category = 'Auto';
                break;
            case 'moto':
                $category = 'Moto';
                break;
            case 'trucks':
                $category = 'Kravas';
                break;
        }

        return $category;
    }

    /**
     * @return mixed
     */
    public function getSvgIconAttribute()
    {
        return array_last(explode('/', $this->icon));
    }

    /**
     * @param $option
     * @return false|float|string
     */
    public function getOption($option)
    {
        if ($option == 'max' && json_decode($this->options)->{$option} == 'current year') {
            return date('Y');
        }
        if ($option == 'avg') {
            if (json_decode($this->options)->max == 'current year') {
                return date('Y');
            } else {
                return round(json_decode($this->options)->max / 2);
            }
        }

        return json_decode($this->options)->{$option};
    }

    /**
     * @return string
     */
    public function getAttributesInJsonAttribute()
    {
        $attributes = $this->attributes()->active()->get();
        $attributes = $attributes->map(function ($attribute) {
            return [
                'text'  => $attribute->name,
                'value' => $attribute->value ?: $attribute->id
            ];
        });

        return json_encode($attributes);
    }

    /**
     * @return mixed
     */
    public function getSelectIconAttribute()
    {
        return str_replace('filter-', '', $this->svg_icon);
    }
}
