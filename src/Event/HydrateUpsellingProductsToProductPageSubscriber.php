<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Event;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepository;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use SwagTraining\UpsellingProducts\Entity\UpsellingEntity;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HydrateUpsellingProductsToProductPageSubscriber implements EventSubscriberInterface
{
    public function __construct(
        #[Autowire(service: 'sales_channel.product.repository')] private SalesChannelRepository $productRepository,
        #[Autowire(service: 'product_media.repository')] private EntityRepository $productMediaRepository,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            ProductPageLoadedEvent::class => 'hydrateUpsellingProducts'
        ];
    }

    public function hydrateUpsellingProducts(ProductPageLoadedEvent $event)
    {
        $product = $event->getPage()->getProduct();
        if (false === $product->hasExtension('upsellingProducts')) {
            return;
        }

        /** @var UpsellingEntity[] $upsellingEntities */
        $upsellingEntities = $product->getExtension('upsellingProducts');
        foreach ($upsellingEntities as $upsellingEntity) {
            $this->hydrateUpsellingProduct($upsellingEntity, $event->getSalesChannelContext());
            $this->hydrateUpsellingProductCoverImage($upsellingEntity, $event->getContext());
        }

    }

    private function hydrateUpsellingProduct(UpsellingEntity $upsellingEntity, SalesChannelContext $salesChannelContext)
    {
        $upsellingProduct = $upsellingEntity->getUpsellingProduct();
        if ($upsellingProduct) {
            return;
        }

        $product = $this->productRepository->search(
            new Criteria([$upsellingEntity->getUpsellingProductId()]),
            $salesChannelContext
        )->first();

        $upsellingEntity->setUpsellingProduct($product);
    }

    private function hydrateUpsellingProductCoverImage(UpsellingEntity $upsellingEntity, Context $context)
    {
        $upsellingProduct = $upsellingEntity->getUpsellingProduct();
        if (false === $upsellingProduct) {
            return;
        }

        $coverId = $upsellingProduct->getCoverId();
        if (!$coverId) {
            return;
        }

        $cover = $upsellingProduct->getCover();
        if ($cover) {
            return;
        }

        // @todo: Rewrite this to be cleverly loaded with the association automatically
        $productMedia = $this->productMediaRepository->search(
            (new Criteria)->addFilter(new EqualsFilter('id', $coverId)),
            $context
        )->first();

        $upsellingProduct->setCover($productMedia);
        $upsellingEntity->setUpsellingProduct($upsellingProduct);
    }
}
