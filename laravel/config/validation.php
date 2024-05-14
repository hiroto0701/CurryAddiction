<?php

return [
    // 共通項目
    'maxName' => '60',
    'maxDisplayName' => '20',
    'maxEmail' => '254',
    'maxComment' => '140',
    'minPassword' => '8',
    'passwordRule' => env('PASSWORD_RULE', '/^[a-zA-Z0-9!#$%()*+,.:;=?@\[\]^_{}-]+$/'),
    'maxFileSize' => '1024',   // 1MB
];
