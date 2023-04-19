<?php if ( !\defined('ABSPATH') ) { return false; }
return [
    'timestamp' => 1641231644,
    'site_id' => 1,
    'group' => 'options',
    'key' => 'cron',
    'type' => 'array',
    'timeout' => 1642441244,
    'data' => [
        1641231938 => [
            'docketcache_gc' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'docketcache_gc_schedule',
                    'args' => [],
                    'interval' => 300,
                ],
            ],
        ],
        1641233329 => [
            'wp_privacy_delete_old_export_files' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'hourly',
                    'args' => [],
                    'interval' => 3600,
                ],
            ],
        ],
        1641235238 => [
            'docketcache_watchproc' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'hourly',
                    'args' => [],
                    'interval' => 3600,
                ],
            ],
        ],
        1641257960 => [
            'wp_https_detection' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'twicedaily',
                    'args' => [],
                    'interval' => 43200,
                ],
            ],
        ],
        1641265729 => [
            'wp_version_check' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'twicedaily',
                    'args' => [],
                    'interval' => 43200,
                ],
            ],
            'wp_update_plugins' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'twicedaily',
                    'args' => [],
                    'interval' => 43200,
                ],
            ],
            'wp_update_themes' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'twicedaily',
                    'args' => [],
                    'interval' => 43200,
                ],
            ],
        ],
        1641308929 => [
            'recovery_mode_clean_expired_keys' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'daily',
                    'args' => [],
                    'interval' => 86400,
                ],
            ],
        ],
        1641308940 => [
            'wp_scheduled_delete' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'daily',
                    'args' => [],
                    'interval' => 86400,
                ],
            ],
            'delete_expired_transients' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'daily',
                    'args' => [],
                    'interval' => 86400,
                ],
            ],
        ],
        [
            'wp_scheduled_auto_draft_delete' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'daily',
                    'args' => [],
                    'interval' => 86400,
                ],
            ],
        ],
        1641568129 => [
            'wp_site_health_scheduled_check' => [
                '40cd750bba9870f18aada2478b24840a' => [
                    'schedule' => 'weekly',
                    'args' => [],
                    'interval' => 604800,
                ],
            ],
        ],
        'version' => 2,
    ],
];
/*@DOCKET_CACHE_EOF*/