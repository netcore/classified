<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Classified\Models\Field;

class FieldsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $fields = [
            [
                'input'        => 'title',
                'type'         => 'text',
                'translations' => [
                    'en' => [
                        'name' => 'Title'
                    ]
                ]
            ],
            [
                'input'        => 'description',
                'type'         => 'textarea',
                'translations' => [
                    'en' => [
                        'name' => 'Desription'
                    ]
                ]
            ],
            [
                'input'        => 'price',
                'type'         => 'numeric',
                'translations' => [
                    'en' => [
                        'name' => 'Price'
                    ]
                ]
            ],
        ];

        foreach ($fields as $field) {
            $entry = Field::firstOrCreate(array_except($field, 'translations'));
            if (!$entry->translations->count()) {
                $entry->storeTranslations($field['translations']);
            }
        }
    }
}
