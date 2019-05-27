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
            'links' => [
                [
                    'link_title' => 'Visit Settings',
                    'link' => 'admin.php',
                    'link_menu_slug' => 'example_plugin'
                ],
                [
                    'link_title' => 'My link',
                    'link' => 'options-general.php',
                    'link_menu_slug' => 'example_plugin'
                ]
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