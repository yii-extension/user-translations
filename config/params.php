<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@user-translations' =>  dirname(__DIR__) . '/language',
        ]
    ],

    'yiisoft/translator' => [
        'path' => '@user-translations',
        'defaultCategoryName' => 'user',
        'locale' => 'en',
    ],
];
