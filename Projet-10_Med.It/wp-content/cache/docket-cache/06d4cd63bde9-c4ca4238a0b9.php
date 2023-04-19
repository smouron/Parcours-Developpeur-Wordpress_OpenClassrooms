<?php if ( !\defined('ABSPATH') ) { return false; }
return \Nawawi\DocketCache\Exporter\Hydrator::hydrate(
    $o = [
        clone (\Nawawi\DocketCache\Exporter\Registry::$prototypes['stdClass'] ?? \Nawawi\DocketCache\Exporter\Registry::p('stdClass')),
    ],
    null,
    [
        'stdClass' => [
            'comment_ID' => [
                '1',
            ],
            'comment_post_ID' => [
                '1',
            ],
            'comment_author' => [
                'A WordPress Commenter',
            ],
            'comment_author_email' => [
                'wapuu@wordpress.example',
            ],
            'comment_author_url' => [
                'https://wordpress.org/',
            ],
            'comment_author_IP' => [
                '',
            ],
            'comment_date' => [
                '2021-01-14 15:08:48',
            ],
            'comment_date_gmt' => [
                '2021-01-14 15:08:48',
            ],
            'comment_content' => [
                'Hi, this is a comment.'."\n"
                    .'To get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.'."\n"
                    .'Commenter avatars come from <a href="https://gravatar.com">Gravatar</a>.',
            ],
            'comment_karma' => [
                '0',
            ],
            'comment_approved' => [
                '1',
            ],
            'comment_agent' => [
                '',
            ],
            'comment_type' => [
                'comment',
            ],
            'comment_parent' => [
                '0',
            ],
            'user_id' => [
                '0',
            ],
        ],
    ],
    [
        'timestamp' => 1640940038,
        'site_id' => 1,
        'group' => 'comment',
        'key' => '1',
        'type' => 'object',
        'timeout' => 0,
        'data' => $o[0],
    ],
    []
);
/*@DOCKET_CACHE_EOF*/