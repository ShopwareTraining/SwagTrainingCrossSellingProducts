<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Event;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntitySearchedEvent;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: EntitySearchedEvent::class)]
class AddEntityExtensionToProductSearchListener
{
    /**
     * @param EntitySearchedEvent $event
     */
    public function __invoke(EntitySearchedEvent $event)
    {
        if ($event->getDefinition()->getEntityName() !== ProductDefinition::ENTITY_NAME) {
            return;
        }

        $event->getCriteria()->addAssociation('upsellingProducts');
    }
}
