<?php

return [
    'api' => [
        'sort_ascending' => 'asc',
        'sort_descending' => 'desc',
        'sort_directions' => ['asc', 'desc'],
        'max_item_per_page' => 18,
    ],
    // 画像パス
    'upload_files_path_format' => [
        'avatar' => '/avatar/%d/uploadfiles/',
        'post_img' => '/post/%d/uploadfiles/',
    ],
    // ログイントークンの有効期限
    'token_expire_minutes' => [
        'default' => 5
    ],
    // ログイン試行回数制限
    'login_rate_limit' => [
        'max_attempts' => [
            'level1' => 3,
            'level2' => 5,
            'level3' => 10,
        ],
        'lockout_time' => [
            'short' => 1,
            'medium' => 10,
            'long' => 60,
        ],
    ],
];
