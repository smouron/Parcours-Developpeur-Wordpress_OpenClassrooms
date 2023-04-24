<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (\Nawawi\DocketCache\Exporter\Registry::$prototypes['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
    ],
    null,
    [
        'stdClass' => [
            'year' => [
                '2021',
            ],
            'month' => [
                '1',
            ],
            'posts' => [
                '1',
            ],
        ],
    ],
    [
        'timestamp' => 1640940038,
        'site_id' => 1,
        'group' => 'posts',
        'key' => 'wp_get_archives:53058f6b83972cfc3253e30ef06fcaa9:0.91681500 1640940038',
        'type' => 'array',
        'timeout' => 1642149638,
        'data' => [
            $o[0],
        ],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/