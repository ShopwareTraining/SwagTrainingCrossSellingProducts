<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Command;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'product_upselling:product:view', description: 'View product with upselling products')]
class ViewProductCommand extends Command
{
    public function __construct(
        #[Autowire(service: 'product.repository')] private EntityRepository $productRepository,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->addArgument('product_id', InputArgument::REQUIRED, 'Product ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productId = $input->getArgument('product_id');

        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('id', $productId));
        $criteria->addAssociation('upsellingProducts');

        $result = $this->productRepository->search($criteria, Context::createDefaultContext());
        $product = $result->getEntities()->first();

        /** @var ProductEntity $product */
        if (false === $product->hasExtension('upsellingProducts')) {
            $output->writeln('<error>upsellingProducts extension is not available</error>');
        }

        $upsellingProducts = $product->getExtension('upsellingProducts');
        foreach ($upsellingProducts as $upsellingProduct) {
            $output->writeln("Upselling product: ".$upsellingProduct->getId()."\n");
        }

        return Command::SUCCESS;
    }
}