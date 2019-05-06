<?php

return $pluginFactorySettings = [
    'services' => [
        PluginFactory\Core\Admin::class => [
            'pages' => [
                [
                    'title' => 'Example Plugin',
                    'menu_title' => 'Example Plugin',
                    'capability' => 'manage_options',
                    'menu_slug' => 'example_plugin',
                    'callback' => function() {
                        require_once(plugin_dir_path(dirname(__FILE__)) . 'templates/index.php');
                    },
                    'icon_url' => 'dashicons-store',
                    'position' => 110,
                ],
            ],
            'settings' => [
                'menu_slug' => 'example_plugin',
                // 'settings_link_title' => 'Visit Settings',
                // 'settings_link' => 'options-general.php'
            ]
        ],
        PluginFactory\Core\EnqueueScripts::class => [
            // 'action' => 'admin_enqueue_scripts',
            'scripts' => [
                'handle' => 'example_plugin_scripts',
                'src' => [
                    'assets/scripts/m_script.js'
                ],
            ],
            'styles' => [
                'handle' => 'example_plugin_styles',
                'src' => [
                    'assets/styles/m_style.css',
                ]
            ]
        ],
        ExamplePlugin\CPT\Book::class => []
    ],
];