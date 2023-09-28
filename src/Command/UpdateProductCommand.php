<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productId = 'c7bca22753c84d08b6178a50052b4146';
        $upsellingProductId = '2a88d9b59d474c7e869d8071649be43c';

        $this->entityRepository->upsert([
            [
                'id' => $productId,
                'upsellingProducts' => [
                    [
                        'productId' => $productId,
                        'upsellingProductId' => $upsellingProductId
                    ]
                ]
            ]
        ], Context::createDefaultContext());

        return Command::SUCCESS;
    }
}