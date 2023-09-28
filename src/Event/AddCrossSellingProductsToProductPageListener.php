<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Event;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;

class AddCrossSellingProductsToProductPageListener
{
    public function __construct(
        private SystemConfigService $systemConfigService
    ) {}

    public function addDataToProductPage(ProductPageLoadedEvent $event)
    {
        $salesChannelId = $event->getSalesChannelContext()->getSalesChannelId();
        $productIds = $this->systemConfigService->get('SwagTrainingCrossSellingProducts.config.products', $salesChannelId);
        $products = ['fsdf' => $productIds];

        $event->getPage()->addArrayExtension('crossSellingProducts', $products);
    }
}