<?php

return $pluginFactorySettings = [
    'services' => [
        PluginFactory\Core\Admin::class => [
            'pages' => [
                [
                    'title' => 'Redis Manager',
                    'menu_title' => 'Redis Manager',
                    'capability' => 'manage_options',
                    'menu_slug' => 'redis_manager',
                    'callback' => function() {},
                    'icon_url' => 'dashicons-store',
                    'position' => 110,
                ]
            ],
            'settings' => [
                'menu_slug' => 'redis_manager',
                // 'settings_link_title' => 'Visit Settings',
                // 'settings_link' => 'options-general.php'
            ]
        ],
        PluginFactory\Core\EnqueueScripts::class => [
            // 'action' => 'admin_enqueue_scripts',
            'scripts' => [
                'handle' => 'redis_manager_scripts',
                'src' => [
                    'assets/scripts/m_script.js'
                ],
            ],
            'styles' => [
                'handle' => 'redis_manager_styles',
                'src' => [
                    'assets/styles/m_style.css',
                ]
            ]
        ],
        MyPlugin\CPT\Book::class => []
    ],
];