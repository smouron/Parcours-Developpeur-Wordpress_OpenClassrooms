<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (\Nawawi\DocketCache\Exporter\Registry::$prototypes['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
    ],
    null,
    [
        'stdClass' => [
            'term_id' => [
                '1',
            ],
            'name' => [
                'Uncategorized',
            ],
            'slug' => [
                'uncategorized',
            ],
            'term_group' => [
                '0',
            ],
            'term_taxonomy_id' => [
                '1',
            ],
            'taxonomy' => [
                'category',
            ],
            'description' => [
                '',
            ],
            'parent' => [
                '0',
            ],
            'count' => [
                '1',
            ],
        ],
    ],
    [
        'timestamp' => 1641202276,
        'site_id' => 1,
        'group' => 'terms',
        'key' => 'get_terms:55e00a2479938f82355c3418aae351a9:0.67180500 1640940038',
        'type' => 'array',
        'timeout' => 1641288676,
        'data' => [
            $o[0],
        ],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/