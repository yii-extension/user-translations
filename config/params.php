<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@user-translations' =>  dirname(__DIR__) . '/locales',
        ]
    ],

    'yiisoft/translator' => [
        'addCategories' => [],
        'defaultCategory' => 'app',
        'fallbackLocale' => null,
        'locale' => 'en_US.utf-8',
    ],
];
