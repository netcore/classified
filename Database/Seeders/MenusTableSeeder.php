<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Menu;
use Modules\Admin\Models\MenuItem;

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

        foreach ($menus as $name => $items) {
            $menu = Menu::firstOrCreate([
                'name' => $name
            ]);


            foreach ($items as $item) {
                $item['menu_id'] = $menu->id;
                $parentItem = MenuItem::firstOrCreate(array_except($item, 'children'));

                foreach($item['children'] as $child) {
                    $child['parent_id'] = $parentItem->id;
                    $child['menu_id'] = $menu->id;

                    MenuItem::firstOrCreate($child);
                }
            }
        }
    }
}
