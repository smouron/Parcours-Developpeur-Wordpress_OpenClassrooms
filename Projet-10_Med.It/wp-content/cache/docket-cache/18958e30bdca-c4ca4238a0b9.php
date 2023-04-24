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
            'post_author' => [
                '1',
            ],
            'post_date' => [
                '2021-01-14 15:08:48',
            ],
            'post_date_gmt' => [
                '2021-01-14 15:08:48',
            ],
            'post_content' => [
                '<!-- wp:paragraph -->'."\n"
                    .'<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>'."\n"
                    .'<!-- /wp:paragraph -->',
            ],
            'post_title' => [
                'Hello world!',
            ],
            'post_excerpt' => [
                '',
            ],
            'post_status' => [
                'publish',
            ],
            'comment_status' => [
                'open',
            ],
            'ping_status' => [
                'open',
            ],
            'post_password' => [
                '',
            ],
            'post_name' => [
                'hello-world',
            ],
            'to_ping' => [
                '',
            ],
            'pinged' => [
                '',
            ],
            'post_modified' => [
                '2021-01-14 15:08:48',
            ],
            'post_modified_gmt' => [
                '2021-01-14 15:08:48',
            ],
            'post_content_filtered' => [
                '',
            ],
            'post_parent' => [
                '0',
            ],
            'guid' => [
                'https://twentyfifteen.themecloud.website/?p=1',
            ],
            'menu_order' => [
                '0',
            ],
            'post_type' => [
                'post',
            ],
            'post_mime_type' => [
                '',
            ],
            'comment_count' => [
                '1',
            ],
        ],
    ],
    [
        'timestamp' => 1640940038,
        'site_id' => 1,
        'group' => 'posts',
        'key' => '1',
        'type' => 'object',
        'timeout' => 1642149638,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/