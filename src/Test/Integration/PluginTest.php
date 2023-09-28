<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Test\Integration;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;

class PluginTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testHelloWorld()
    {
        $this->assertTrue(false);

        $container = $this->getContainer();
        $upsellingProductsRepository = $container->get('product_upselling.repository');

        $criteria = new Criteria;
        $context = Context::createDefaultContext();

        $upsellingProducts = $upsellingProductsRepository->search($criteria, $context);
        $this->assertNotEmpty($upsellingProducts);
    }
}