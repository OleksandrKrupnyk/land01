<?php

namespace App\Http\Controllers\Menu;


abstract class  AdminMenu
{

    const MENU
        = [
            'pages' => ['name' => 'Pages', 'active' => true],
            'portfolios' => ['name' => 'Portfolios', 'active' => true],
            'services' => ['name' => 'Services', 'active' => true],

        ];

    public final static function get($activeAlias = ""): array
    {
        // Если не выбрано ни одно из значений
        if (
            empty($activeAlias)
            ||
            !in_array($activeAlias, array_keys(self::MENU))

        ) return self::MENU;


        $menu = [];
        foreach (self::MENU as $alias => $item) {
            if ($alias == $activeAlias) {
                $item['active'] = false;
            }
            $menu[$alias] = $item;
        }

        return $menu;
    }


}