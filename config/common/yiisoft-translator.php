<?php

declare(strict_types=1);

use Psr\EventDispatcher\EventDispatcherInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Translator\Category;
use Yiisoft\Translator\MessageFormatterInterface;
use Yiisoft\Translator\MessageReaderInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\Translator\Formatter\Intl\IntlMessageFormatter;

return [
    MessageReaderInterface::class => [
        '__class' => MessageSource::class,
        '__construct()' =>  [fn (Aliases $aliases) => $aliases->get($params['yiisoft/translator']['path'])]
    ],

    MessageFormatterInterface::class => IntlMessageFormatter::class,

    Category::class => [
        '__class' => Category::class,
        '__construct()' => [
            'name' => $params['yiisoft/translator']['defaultCategoryName'],
        ],
    ],

    TranslatorInterface::class => [
        '__class' => Translator::class,
        '__construct()' => [
            Reference::to(Category::class),
            $params['yiisoft/translator']['locale'],
            $params['yiisoft/translator']['fallbackLocale'],
            Reference::to(EventDispatcherInterface::class),
        ],
    ],
];
