<?php

namespace Shopware\Production\Merchants\Content\Merchant\Aggregate\MerchantOrder;

use Shopware\Core\Checkout\Order\OrderDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;
use Shopware\Production\Merchants\Content\Merchant\MerchantDefinition;

class MerchantOrderDefinition extends MappingEntityDefinition
{
    public function getEntityName(): string
    {
        return 'merchant_order';
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('merchant_id', 'merchantId', MerchantDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('order_id', 'orderId', OrderDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(OrderDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            new ManyToOneAssociationField('merchant', 'merchant_id', MerchantDefinition::class),
            new ManyToOneAssociationField('order', 'order_id', OrderDefinition::class),
            new CreatedAtField(),
        ]);
    }
}
