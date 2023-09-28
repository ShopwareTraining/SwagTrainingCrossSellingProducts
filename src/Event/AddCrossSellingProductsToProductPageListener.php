<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Event;

use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;

class AddCrossSellingProductsToProductPageListener
{
    public function addDataToProductPage(ProductPageLoadedEvent $event)
    {
        $event->getPage()->addArrayExtension('sdfsd', ['sdfsd' => 'sdffs']);
    }
}