<?php

return [
    // 共通項目
    'maxName' => '60',
    'maxEmail' => '254',
    'maxComment' => '140',
    'minPassword' => '8',
    'passwordRule' => env('PASSWORD_RULE', '/^[a-zA-Z0-9!#$%()*+,.:;=?@\[\]^_{}-]+$/'),
];
