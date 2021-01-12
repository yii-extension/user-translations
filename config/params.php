<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@user-translations' =>  dirname(__DIR__) . '/language',
        ]
    ],

    'yiisoft/translator' => [
        'defaultCategoryName' => 'user',
        'fallbackLocale' => null,
        'locale' => 'en',
        'path' => '@user-translations',
    ],
];
