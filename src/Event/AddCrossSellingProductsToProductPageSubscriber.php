<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Event;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepository;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Navigation\NavigationPageLoadedEvent;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddCrossSellingProductsToProductPageSubscriber implements EventSubscriberInterface
{
    public function __construct(
        #[Autowire(service: 'sales_channel.product.repository')] private SalesChannelRepository $productRepository,
        private SystemConfigService $systemConfigService
    ) {}

    public static function getSubscribedEvents()
    {
        return [
            ProductPageLoadedEvent::class => 'addProductsToProductPage'
        ];
    }

    public function addProductsToProductPage(ProductPageLoadedEvent $event)
    {
        $productIds = $this->getProductIdsFromConfig($event);
        $products = $this->getProductsFromProductIds($event, $productIds);
        $data = ['products' => $products];
        $event->getPage()->addArrayExtension('crossSellingProducts', $data);
    }

    /**
     * @param ProductPageLoadedEvent $event
     * @param array $productIds
     * @return EntityCollection
     */
    private function getProductsFromProductIds(ProductPageLoadedEvent $event, array $productIds): EntityCollection
    {
        $criteria = new Criteria($productIds);
        $context = $event->getSalesChannelContext();
        return $this->productRepository->search($criteria, $context)->getEntities();
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