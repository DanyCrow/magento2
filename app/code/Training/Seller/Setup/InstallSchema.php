<?php

namespace Training\Seller\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Training\Seller\Api\Data\SellerInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $installer, ModuleContextInterface $context)
    {
        $installer->startSetup();

        /**
         * Create table 'training_seller'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable(SellerInterface::TABLE_NAME)
        )->addColumn(
            SellerInterface::FIELD_SELLER_ID,
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
        )->addColumn(
            SellerInterface::FIELD_IDENTIFIER,
            Table::TYPE_TEXT,
            64,
            ['nullable' => false]
        )->addColumn(
            SellerInterface::FIELD_NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false]
        )->addColumn(
            SellerInterface::FIELD_CREATED_AT,
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT]
        )->addColumn(
            SellerInterface::FIELD_UPDATED_AT,
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]
        )->addIndex(
            $installer->getIdxName(
                SellerInterface::TABLE_NAME,
                [SellerInterface::FIELD_IDENTIFIER],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            [SellerInterface::FIELD_IDENTIFIER],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'CMS Block Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
