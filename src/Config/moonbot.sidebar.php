<?php 
/**
 * User: Crypta Electrica <crypta@crypta.tech>
 * Date: 05/08/2020
 */

return [
    'moonbot' => [
        'name' => 'MoonBot',
        'permission' => 'moonbot.edit',
        'route_segment' => 'moonbot',
        'icon' => 'fas fa-moon',
        'entries'       => [
            'edit' => [
                'name' => 'Configure',
                'icon' => 'fas fa-cogs',
                'route_segment' => 'moonbot',
                'route' => 'moonbot.configure',
                'permission' => 'moonbot.edit'
            ],
            'about' => [
                'name' => 'About',
                'icon' => 'fas fa-info',
                'route_segment' => 'moonbot',
                'route' => 'moonbot.about',
                'permission' => 'moonbot.edit'
            ],
        ]
    ]
];
