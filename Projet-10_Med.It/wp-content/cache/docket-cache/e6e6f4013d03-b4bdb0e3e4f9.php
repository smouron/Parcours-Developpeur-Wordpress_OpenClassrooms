<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (\Nawawi\DocketCache\Exporter\Registry::$prototypes['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
    ],
    null,
    [
        'stdClass' => [
            'last_checked' => [
                1641223092,
            ],
            'checked' => [
                [
                    'twentytwentyone' => '1.4',
                ],
            ],
            'response' => [
                [],
            ],
            'no_update' => [
                [
                    'twentytwentyone' => [
                        'theme' => 'twentytwentyone',
                        'new_version' => '1.4',
                        'url' => 'https://wordpress.org/themes/twentytwentyone/',
                        'package' => 'https://downloads.wordpress.org/theme/twentytwentyone.1.4.zip',
                        'requires' => '5.3',
                        'requires_php' => '5.6',
                    ],
                ],
            ],
            'translations' => [
                [],
            ],
        ],
    ],
    [
        'timestamp' => 1641223092,
        'site_id' => 1,
        'group' => 'site-transient',
        'key' => 'update_themes',
        'type' => 'object',
        'timeout' => 1643642292,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/