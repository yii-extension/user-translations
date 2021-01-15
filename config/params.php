<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@user-translations' =>  dirname(__DIR__) . '/language',
        ]
    ],

    'yiisoft/translator' => [
        'addCategories' => [],
        'defaultCategory' => 'app',
        'fallbackLocale' => null,
        'locale' => 'en',
    ],
];
