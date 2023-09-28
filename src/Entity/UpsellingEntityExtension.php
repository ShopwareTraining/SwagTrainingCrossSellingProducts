<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Entity;

use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class UpsellingEntityExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return UpsellingDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(new OneToManyAssociationField('upsellingProducts', UpsellingDefinition::class, 'productId'));
    }
}
