<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Entity;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

class UpsellingDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'product_upselling';
    }

    public function getEntityClass(): string
    {
        return UpsellingEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        $fieldCollection = new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new FkField('product_id', 'productId', ProductDefinition::class, 'id'))->addFlags(new Required()),
            new IdField('upselling_product_id', 'upsellingProductId'),
            new ManyToOneAssociationField('productId', 'product_id', ProductDefinition::class, 'id')
        ]);

        return $fieldCollection;
    }
}
