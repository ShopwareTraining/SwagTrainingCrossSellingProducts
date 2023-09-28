<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Event;

use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: ProductPageLoadedEvent::class)]
class AddCrossSellingProductsToProductPageListener
{
    public function __construct(
        private SystemConfigService $systemConfigService
    ) {}

    public function __invoke(ProductPageLoadedEvent $event)
    {
        $products = ['fsdf' => $this->getProductIdsFromConfig($event)];
        $event->getPage()->addArrayExtension('crossSellingProducts', $products);
    }

    /**
     * @param ProductPageLoadedEvent $event
     * @return string[]
     */
    private function getProductIdsFromConfig(ProductPageLoadedEvent $event): array
    {
        $salesChannelId = $event->getSalesChannelContext()->getSalesChannelId();
        return $this->systemConfigService->get('SwagTrainingCrossSellingProducts.config.products', $salesChannelId);
    }
}
