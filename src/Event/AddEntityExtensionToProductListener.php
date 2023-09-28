<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Event;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Content\Product\ProductEvents;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;


#[AsEventListener(event: ProductEvents::PRODUCT_LOADED_EVENT)]
class AddEntityExtensionToProductListener
{
    /**
     * @param ProductPageLoadedEvent $event
     * @param array $productIds
     * @return EntityCollection
     */
    public function __invoke(EntityLoadedEvent $event)
    {
        /** @var ProductEntity $productEntity */
        foreach ($event->getEntities() as $productEntity) {
            //$productEntity->addExtension('upsellingProducts'));
        }
    }
}
