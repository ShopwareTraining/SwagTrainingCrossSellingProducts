<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Entity;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(name: 'shopware.entity.extension')]
class UpsellingEntityExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('upsellingProducts', UpsellingDefinition::class, 'product_id')
        );
    }
}
