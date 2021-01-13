<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
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
        '__construct()' =>  [fn (Aliases $aliases) => $aliases->get('@user-translations')]
    ],

    MessageFormatterInterface::class => IntlMessageFormatter::class,

    Category::class => [
        '__class' => Category::class,
        '__construct()' => [
            'name' => $params['yiisoft/translator']['defaultCategory'],
        ],
    ],

    CategoryUser::class => [
        '__class' => Category::class,
        '__construct()' => [
            'name' => 'user',
        ],
    ],

    CategoryUserFlashMessage::class => [
        '__class' => Category::class,
        '__construct()' => [
            'name' => 'user-flash-message',
        ],
    ],

    CategoryUserMailer::class => [
        '__class' => Category::class,
        '__construct()' => [
            'name' => 'user-mailer',
        ],
    ],

    CategoryUserView::class => [
        '__class' => Category::class,
        '__construct()' => [
            'name' => 'user-view',
        ],
    ],

    TranslatorInterface::class => [
        '__class' => Translator:: class,
        '__construct()' => [
            Reference::to(Category::class),
            $params['yiisoft/translator']['locale'],
            $params['yiisoft/translator']['fallbackLocale'],
            Reference::to(EventDispatcherInterface::class),
        ],
        'addCategorySource()' =>  [Reference::to(CategoryUser::class)],
        'addCategorySource()' =>  [Reference::to(CategoryUserFlashMessage::class)],
        'addCategorySource()' =>  [Reference::to(CategoryUserMailer::class)],
        'addCategorySource()' =>  [Reference::to(CategoryUserView::class)],
    ],
];
