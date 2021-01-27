<?php

declare(strict_types=1);

use Psr\EventDispatcher\EventDispatcherInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\MessageFormatterInterface;
use Yiisoft\Translator\MessageReaderInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Translator\Message\Gettext\MessageSource;
use Yiisoft\Translator\Formatter\Intl\IntlMessageFormatter;

return [
    MessageReaderInterface::class => [
        '__class' => MessageSource::class,
        '__construct()' =>  [fn (Aliases $aliases) => $aliases->get('@user-translations')]
    ],

    MessageFormatterInterface::class => IntlMessageFormatter::class,

    CategorySource::class => [
        '__class' => CategorySource::class,
        '__construct()' => [
            'name' => $params['yiisoft/translator']['defaultCategory'],
        ],
    ],

    CategoryUser::class => [
        '__class' => CategorySource::class,
        '__construct()' => [
            'name' => 'user',
        ],
    ],

    CategoryUserMailer::class => [
        '__class' => CategorySource::class,
        '__construct()' => [
            'name' => 'user-mailer',
        ],
    ],

    CategoryUserView::class => [
        '__class' => CategorySource::class,
        '__construct()' => [
            'name' => 'user-view',
        ],
    ],

    TranslatorInterface::class => [
        '__class' => Translator:: class,
        '__construct()' => [
            $params['yiisoft/translator']['locale'],
            $params['yiisoft/translator']['fallbackLocale'],
            Reference::to(EventDispatcherInterface::class),
        ],
        'addCategorySources()' => [
            array_merge(
                [
                    Reference::to(CategoryUser::class),
                    Reference::to(CategoryUserMailer::class),
                    Reference::to(CategoryUserView::class),
                ],
                $params['yiisoft/translator']['addCategories'],
            ),
        ],
    ],
];
