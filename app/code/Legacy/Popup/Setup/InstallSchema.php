<?php

namespace Legacy\Popup\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        /*
         * Create table 'legacy_popup'
         */

        $table = $installer->getConnection()->newTable(
            $installer->getTable('legacy_popup')
        )->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Popup PK'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Descrption'
        )->addColumn(
            'store_ids',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Store Ids'
        )->addColumn(
            'customer_group_ids',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Customer Group Ids'
        )->addColumn(
            'content',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            ['nullable' => false],
            'Content'
        )->addColumn(
            'width',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => true],
            'Width'
        )->addColumn(
            'height',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => true],
            'Height'
        )->addColumn(
            'custom_style',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            ['nullable' => true],
            'Custom Style CSS'
        )->addColumn(
            'close_btn_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => true],
            'Close button color'
        )->addColumn(
            'dont_show_btn_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => true],
            "Don't show button color"
        )->addColumn(
            'which_page_to_show',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['default' => 1, 'nullable' => false],
            'Which page to show'
        )->addColumn(
            'include_pages',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            ['nullable' => true],
            'Include pages'
        )->addColumn(
            'exclude_page',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            ['nullable' => true],
            'Exclude page'
        )->addColumn(
            'publish_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'Publish Date'
        )->addColumn(
            'publish_date_end',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'Publish Date End'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['default' => 1, 'nullable' => false],
            'Active Status'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
            ],
            'Created At'
        )->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => true,
                'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
            ],
            'Updated At'
        )->addColumn(
            'sort_order',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['default' => 0, 'nullable' => false],
            'Sort Order'
        )->setComment(
            'Popup Data Table'
        );

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
