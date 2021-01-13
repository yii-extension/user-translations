<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
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

    TranslatorInterface::class => static function (ContainerInterface $container) use ($params) {
        $category = $container->get(Category::class);
        $categoryUser = $container->get(CategoryUser::class);
        $categoryUserFlashMessage = $container->get(CategoryUserFlashMessage::class);
        $categoryUserMailer = $container->get(CategoryUserMailer::class);
        $categoryUserView = $container->get(CategoryUserView::class);

        $translator = new Translator(
            $category,
            $params['yiisoft/translator']['locale'],
            $params['yiisoft/translator']['fallbackLocale'],
        );

        $translator->addCategorySource($categoryUser);
        $translator->addCategorySource($categoryUserFlashMessage);
        $translator->addCategorySource($categoryUserMailer);
        $translator->addCategorySource($categoryUserView);

        return $translator;
    },
];
