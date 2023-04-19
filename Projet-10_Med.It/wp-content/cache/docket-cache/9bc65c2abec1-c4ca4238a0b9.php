<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (\Nawawi\DocketCache\Exporter\Registry::$prototypes['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
    ],
    null,
    [
        'stdClass' => [
            'ID' => [
                '1',
            ],
            'user_login' => [
                'themecloud',
            ],
            'user_pass' => [
                '$P$BRmzU5zH8gaZz8Ylo80lXuBEXif9ee/',
            ],
            'user_nicename' => [
                'themecloud',
            ],
            'user_email' => [
                'website@themecloud.io',
            ],
            'user_url' => [
                '',
            ],
            'user_registered' => [
                '2021-01-14 15:08:48',
            ],
            'user_activation_key' => [
                '1630491544:$P$BUgyRSVg12ZeQQZuUeSH2zupsFPk3G0',
            ],
            'user_status' => [
                '0',
            ],
            'display_name' => [
                'themecloud',
            ],
        ],
    ],
    [
        'timestamp' => 1640940038,
        'site_id' => 1,
        'group' => 'users',
        'key' => '1',
        'type' => 'object',
        'timeout' => 0,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/