<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'product_upselling:product:update', description: 'Update product with upselling products')]
class UpdateProductCommand extends Command
{
    public function __construct(
        #[Autowire(service: 'product.repository')] private EntityRepository $entityRepository,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->addArgument('product_id', InputArgument::REQUIRED, 'Product ID');
        $this->addArgument('upselling_product_id', InputArgument::REQUIRED, 'Upselling product ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productId = $input->getArgument('product_id');
        $upsellingProductId = $input->getArgument('upselling_product_id');

        $this->entityRepository->upsert([
            [
                'id' => $productId,
                'upsellingProducts' => [
                    [
                        'productId' => $productId,
                        'upsellingProductId' => $upsellingProductId,
                    ],
                ],
            ],
        ], Context::createDefaultContext());

        return Command::SUCCESS;
    }
}