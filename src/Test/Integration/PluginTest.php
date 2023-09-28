<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Test\Integration;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;

class PluginTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testHelloWorld()
    {
        $container = $this->getContainer();
        $upsellingProductsRepository = $container->get('product_upselling.repository');

        $criteria = new Criteria;
        $context = Context::createDefaultContext();

        $upsellingProducts = $upsellingProductsRepository->search($criteria, $context);
        $this->assertNotEmpty($upsellingProducts);
    }
}
