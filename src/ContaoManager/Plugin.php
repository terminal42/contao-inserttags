<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Terminal42\InsertTagsBundle\Terminal42InsertTagsBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(Terminal42InsertTagsBundle::class)->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
