<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1695900506 extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1695900506;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<'SQL'
CREATE TABLE IF NOT EXISTS `product_upselling` (
    `id` BINARY(16) NOT NULL,
    `product_id` BINARY(16) NULL,
    `upselling_product_id` BINARY(16) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
