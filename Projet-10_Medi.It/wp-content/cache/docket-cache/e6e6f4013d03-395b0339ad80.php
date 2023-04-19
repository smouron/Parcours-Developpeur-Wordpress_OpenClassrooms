<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (($p = &\Nawawi\DocketCache\Exporter\Registry::$prototypes)['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
        clone $p['stdClass'],
        clone $p['stdClass'],
    ],
    null,
    [
        'stdClass' => [
            'last_checked' => [
                1641223092,
            ],
            'response' => [
                [],
            ],
            'translations' => [
                [],
            ],
            'no_update' => [
                [
                    'docket-cache/docket-cache.php' => $o[1],
                    'nginx-helper/nginx-helper.php' => $o[2],
                ],
            ],
            'checked' => [
                [
                    'astra_worker/astra_worker.php' => '2.5',
                    'docket-cache/docket-cache.php' => '21.08.03',
                    'nginx-helper/nginx-helper.php' => '2.2.2',
                ],
            ],
            'id' => [
                1 => 'w.org/plugins/docket-cache',
                'w.org/plugins/nginx-helper',
            ],
            'slug' => [
                1 => 'docket-cache',
                'nginx-helper',
            ],
            'plugin' => [
                1 => 'docket-cache/docket-cache.php',
                'nginx-helper/nginx-helper.php',
            ],
            'new_version' => [
                1 => '21.08.03',
                '2.2.2',
            ],
            'url' => [
                1 => 'https://wordpress.org/plugins/docket-cache/',
                'https://wordpress.org/plugins/nginx-helper/',
            ],
            'package' => [
                1 => 'https://downloads.wordpress.org/plugin/docket-cache.21.08.03.zip',
                'https://downloads.wordpress.org/plugin/nginx-helper.2.2.2.zip',
            ],
            'icons' => [
                1 => [
                    '2x' => 'https://ps.w.org/docket-cache/assets/icon-256x256.png?rev=2425893',
                    '1x' => 'https://ps.w.org/docket-cache/assets/icon-128x128.png?rev=2425893',
                ],
                [
                    '2x' => 'https://ps.w.org/nginx-helper/assets/icon-256x256.png?rev=2360932',
                    '1x' => 'https://ps.w.org/nginx-helper/assets/icon.svg?rev=2360932',
                    'svg' => 'https://ps.w.org/nginx-helper/assets/icon.svg?rev=2360932',
                ],
            ],
            'banners' => [
                1 => [
                    '2x' => 'https://ps.w.org/docket-cache/assets/banner-1544x500.png?rev=2430749',
                    '1x' => 'https://ps.w.org/docket-cache/assets/banner-772x250.png?rev=2430749',
                ],
                [
                    '2x' => 'https://ps.w.org/nginx-helper/assets/banner-1544x500.png?rev=2360932',
                    '1x' => 'https://ps.w.org/nginx-helper/assets/banner-772x250.png?rev=2360926',
                ],
            ],
            'banners_rtl' => [
                1 => [],
                [
                    '2x' => 'https://ps.w.org/nginx-helper/assets/banner-1544x500-rtl.png?rev=2360932',
                    '1x' => 'https://ps.w.org/nginx-helper/assets/banner-772x250-rtl.png?rev=2360932',
                ],
            ],
            'requires' => [
                1 => '5.4',
                '3.0',
            ],
        ],
    ],
    [
        'timestamp' => 1641223093,
        'site_id' => 1,
        'group' => 'site-transient',
        'key' => 'update_plugins',
        'type' => 'object',
        'timeout' => 1643642293,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/