<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Command;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'product_upselling:product:view', description: 'View product with upselling products')]
class ViewProductCommand extends Command
{
    public function __construct(
        #[Autowire(service: 'product.repository')] private EntityRepository $entityRepository,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productId = 'c7bca22753c84d08b6178a50052b4146';
        $criteria = new Criteria([$productId]);
        $criteria->addAssociation('upsellingProducts2');

        $result = $this->entityRepository->search(new Criteria([$productId]), Context::createDefaultContext());
        $product = $result->getEntities()->first();

        /** @var ProductEntity $product */
        print_r($product);

        return Command::SUCCESS;
    }
}