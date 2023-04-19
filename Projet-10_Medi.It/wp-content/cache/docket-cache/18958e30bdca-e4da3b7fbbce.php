<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (\Nawawi\DocketCache\Exporter\Registry::$prototypes['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
    ],
    null,
    [
        'stdClass' => [
            'ID' => [
                5,
            ],
            'post_author' => [
                '1',
            ],
            'post_date' => [
                '2021-08-20 13:00:16',
            ],
            'post_date_gmt' => [
                '2021-08-20 13:00:16',
            ],
            'post_content' => [
                '',
            ],
            'post_title' => [
                'cropped-wordpress-logo-simplified-rgb-1-300x300',
            ],
            'post_excerpt' => [
                '',
            ],
            'post_status' => [
                'inherit',
            ],
            'comment_status' => [
                'open',
            ],
            'ping_status' => [
                'closed',
            ],
            'post_password' => [
                '',
            ],
            'post_name' => [
                'cropped-wordpress-logo-simplified-rgb-1-300x300',
            ],
            'to_ping' => [
                '',
            ],
            'pinged' => [
                '',
            ],
            'post_modified' => [
                '2021-08-20 13:00:16',
            ],
            'post_modified_gmt' => [
                '2021-08-20 13:00:16',
            ],
            'post_content_filtered' => [
                '',
            ],
            'post_parent' => [
                0,
            ],
            'guid' => [
                'https://twentyfifteen.themecloud.website/wp-content/uploads/2021/08/cropped-wordpress-logo-simplified-rgb-1-300x300-1.png',
            ],
            'menu_order' => [
                0,
            ],
            'post_type' => [
                'attachment',
            ],
            'post_mime_type' => [
                'image/png',
            ],
            'comment_count' => [
                '0',
            ],
            'filter' => [
                'raw',
            ],
        ],
    ],
    [
        'timestamp' => 1640940038,
        'site_id' => 1,
        'group' => 'posts',
        'key' => 5,
        'type' => 'object',
        'timeout' => 1642149638,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/