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
        'timestamp' => 1640940038,
        'site_id' => 1,
        'group' => 'terms',
        'key' => '1',
        'type' => 'object',
        'timeout' => 1642149638,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/