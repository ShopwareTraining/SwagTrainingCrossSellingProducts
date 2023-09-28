<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Entity;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class UpsellingCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return UpsellingEntity::class;
    }
}
