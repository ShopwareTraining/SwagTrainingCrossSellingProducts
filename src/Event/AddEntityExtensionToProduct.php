<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Event;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepository;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class AddEntityExtensionToProduct
{
    /**
     * @param ProductPageLoadedEvent $event
     * @param array $productIds
     * @return EntityCollection
     */
    public function __invoke(EntityLoadedEvent $event)
    {
    }
}
