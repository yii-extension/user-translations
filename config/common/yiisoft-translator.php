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

    Translator::class => [
        '__class' => Translator:: class,
        '__construct()' => [
            Reference::to(Category::class),
            $params['yiisoft/translator']['locale'],
            $params['yiisoft/translator']['fallbackLocale'],
            Reference::to(EventDispatcherInterface::class),
        ],
    ],

    TranslatorInterface::class => static function (ContainerInterface $container) {
        $translator = $container->get(Translator::class);

        $translator->addCategorySource($container->get(CategoryUser::class));
        $translator->addCategorySource($container->get(CategoryUserFlashMessage::class));
        $translator->addCategorySource($container->get(CategoryUserMailer::class));
        $translator->addCategorySource($container->get(CategoryUserView::class));

        return $translator;
    },
];
