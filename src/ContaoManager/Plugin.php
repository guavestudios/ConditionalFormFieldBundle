<?php

namespace Guave\ConditionalFormFieldBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Guave\ConditionalFormFieldBundle\GuaveConditionalFormFieldBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(GuaveConditionalFormFieldBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
