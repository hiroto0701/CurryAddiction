<?php

return [
    'api' => [
        'sort_ascending' => 'asc',
        'sort_descending' => 'desc',
        'sort_directions' => ['asc', 'desc'],
        'max_item_per_page' => 18,
    ],
    'avatar' => [
        'uploadfiles_path_format' => '/avatar/%d/uploadfiles/',
    ],
    'post_img' => [
        'uploadfiles_path_format' => '/post/%d/uploadfiles/',
    ],
    'two_step_authentication_valid_minute' => [
        'default' => 5
    ],
];
