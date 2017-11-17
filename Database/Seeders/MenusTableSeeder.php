<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Menu;
use Netcore\Translator\Helpers\TransHelper;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $menus = [
            'leftAdminMenu' => [
                [
                    'name'       => 'Classifieds',
                    'icon'       => 'fa-bars',
                    'type'       => 'url',
                    'value'      => '#',
                    'module'     => 'Classified',
                    'is_active'  => 1,
                    'parameters' => json_encode([]),
                    'children'   => [
//                        [
//                            'name'            => 'Fields',
//                            'type'            => 'route',
//                            'value'           => 'admin::classified.fields.index',
//                            'active_resolver' => 'admin::classified.fields.*',
//                            'module'          => 'Classified',
//                            'is_active'       => 1,
//                            'parameters'      => json_encode([])
//                        ],
                        [
                            'name'            => 'Parameters/Attributes',
                            'type'            => 'route',
                            'value'           => 'admin::classified.parameters.index',
                            'active_resolver' => 'admin::classified.parameters.*',
                            'module'          => 'Classified',
                            'is_active'       => 1,
                            'parameters'      => json_encode([])
                        ],
                    ]
                ],
            ]
        ];

        foreach ($menus as $key => $items) {
            $menu = Menu::firstOrCreate([
                'key' => $key
            ]);

            $translations = [];
            foreach (TransHelper::getAllLanguages() as $language) {
                $translations[$language->iso_code] = [
                    'name' => ucwords(preg_replace(array('/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'), ' $0', $key))
                ];
            }
            $menu->updateTranslations($translations);

            foreach ($items as $item) {
                $row = $menu->items()->firstOrCreate(array_except($item, ['name', 'value', 'parameters', 'children']));

                $translations = [];
                foreach (TransHelper::getAllLanguages() as $language) {
                    $translations[$language->iso_code] = [
                        'name'       => $item['name'],
                        'value'      => $item['value'],
                        'parameters' => $item['parameters']
                    ];
                }
                $row->updateTranslations($translations);

                foreach ($item['children'] as $child) {
                    $child['menu_id'] = $menu->id;

                    $c = $row->children()->firstOrCreate(array_except($child, ['name', 'value', 'parameters']));
                    $translations = [];
                    foreach (TransHelper::getAllLanguages() as $language) {
                        $translations[$language->iso_code] = [
                            'name'       => $child['name'],
                            'value'      => $child['value'],
                            'parameters' => $child['parameters']
                        ];
                    }
                    $c->updateTranslations($translations);
                }
            }
        }
    }
}
