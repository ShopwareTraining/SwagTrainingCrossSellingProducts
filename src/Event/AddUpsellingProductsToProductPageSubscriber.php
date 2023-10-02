<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Event;

use Shopware\Storefront\Page\Product\ProductPageCriteriaEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddUpsellingProductsToProductPageSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ProductPageCriteriaEvent::class => 'addAssociationToCriteria'
        ];
    }

    public function addAssociationToCriteria(ProductPageCriteriaEvent $event)
    {
        $event->getCriteria()->addAssociation('upsellingProducts.upsellingProduct');
    }
}
