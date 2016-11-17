<?php

namespace Szkla\Bundle\ProductGridBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class SzklaProductGridBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createAttributesTable($schema);
        $this->createProductsTable($schema);
        $this->createUsersTable($schema);
        $this->createValueDatetimesTable($schema);
        $this->createValueDecimalsTable($schema);
        $this->createValueIntegersTable($schema);
        $this->createValueTextsTable($schema);
        $this->createValueVarcharsTable($schema);

        /** Foreign keys generation **/
        $this->addValueDatetimesForeignKeys($schema);
        $this->addValueDecimalsForeignKeys($schema);
        $this->addValueIntegersForeignKeys($schema);
        $this->addValueTextsForeignKeys($schema);
        $this->addValueVarcharsForeignKeys($schema);
    }

    /**
     * Create attributes table
     *
     * @param Schema $schema
     */
    protected function createAttributesTable(Schema $schema)
    {
        $table = $schema->createTable('attributes');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('attribute_name', 'string', ['length' => 255]);
        $table->addColumn('attribute_type', 'string', ['length' => 255]);
        $table->addColumn('is_required', 'boolean', []);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['attribute_name'], 'attribute_name_UNIQUE');
        $table->addIndex(['attribute_type'], 'attribute_type', []);
        $table->addIndex(['is_required'], 'is_required', []);
    }

    /**
     * Create products table
     *
     * @param Schema $schema
     */
    protected function createProductsTable(Schema $schema)
    {
        $table = $schema->createTable('products');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('create_time', 'datetime', ['notnull' => false]);
        $table->addColumn('modify_time', 'datetime', ['notnull' => false]);
        $table->addColumn('sku', 'string', ['length' => 255]);
        $table->addColumn('is_active', 'boolean', []);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['sku'], 'sku_UNIQUE');
        $table->addIndex(['is_active'], 'is_active', []);
    }

    /**
     * Create users table
     *
     * @param Schema $schema
     */
    protected function createUsersTable(Schema $schema)
    {
        $table = $schema->createTable('users');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('create_time', 'datetime', ['notnull' => false]);
        $table->addColumn('modify_time', 'datetime', ['notnull' => false]);
        $table->addColumn('username', 'string', ['length' => 64]);
        $table->addColumn('email', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('password', 'string', ['length' => 128]);
        $table->addColumn('note', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('is_active', 'boolean', []);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['username'], 'username_UNIQUE');
        $table->addIndex(['is_active'], 'is_active', []);
    }

    /**
     * Create value_datetimes table
     *
     * @param Schema $schema
     */
    protected function createValueDatetimesTable(Schema $schema)
    {
        $table = $schema->createTable('value_datetimes');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', ['notnull' => false]);
        $table->addColumn('attribute_id', 'integer', ['notnull' => false]);
        $table->addColumn('value', 'datetime', []);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['product_id'], 'fk_value_datetimes_products1_idx', []);
        $table->addIndex(['attribute_id'], 'fk_value_datetimes_attributes1_idx', []);
    }

    /**
     * Create value_decimals table
     *
     * @param Schema $schema
     */
    protected function createValueDecimalsTable(Schema $schema)
    {
        $table = $schema->createTable('value_decimals');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', ['notnull' => false]);
        $table->addColumn('attribute_id', 'integer', ['notnull' => false]);
        $table->addColumn('value', 'decimal', ['precision' => 9, 'scale' => 2]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['product_id'], 'fk_value_decimals_products1_idx', []);
        $table->addIndex(['attribute_id'], 'fk_value_decimals_attributes1_idx', []);
    }

    /**
     * Create value_integers table
     *
     * @param Schema $schema
     */
    protected function createValueIntegersTable(Schema $schema)
    {
        $table = $schema->createTable('value_integers');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', ['notnull' => false]);
        $table->addColumn('attribute_id', 'integer', ['notnull' => false]);
        $table->addColumn('value', 'integer', []);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['product_id'], 'fk_value_integers_products1_idx', []);
        $table->addIndex(['attribute_id'], 'fk_value_integers_attributes1_idx', []);
    }

    /**
     * Create value_texts table
     *
     * @param Schema $schema
     */
    protected function createValueTextsTable(Schema $schema)
    {
        $table = $schema->createTable('value_texts');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', ['notnull' => false]);
        $table->addColumn('attribute_id', 'integer', ['notnull' => false]);
        $table->addColumn('value', 'text', ['length' => 65535]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['product_id'], 'fk_value_texts_products1_idx', []);
        $table->addIndex(['attribute_id'], 'fk_value_texts_attributes1_idx', []);
    }

    /**
     * Create value_varchars table
     *
     * @param Schema $schema
     */
    protected function createValueVarcharsTable(Schema $schema)
    {
        $table = $schema->createTable('value_varchars');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', ['notnull' => false]);
        $table->addColumn('attribute_id', 'integer', ['notnull' => false]);
        $table->addColumn('value', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['product_id'], 'fk_value_varchars_products_idx', []);
        $table->addIndex(['attribute_id'], 'fk_value_varchars_attributes1_idx', []);
    }

    /**
     * Add value_datetimes foreign keys.
     *
     * @param Schema $schema
     */
    protected function addValueDatetimesForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('value_datetimes');
        $table->addForeignKeyConstraint(
            $schema->getTable('products'),
            ['product_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('attributes'),
            ['attribute_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add value_decimals foreign keys.
     *
     * @param Schema $schema
     */
    protected function addValueDecimalsForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('value_decimals');
        $table->addForeignKeyConstraint(
            $schema->getTable('products'),
            ['product_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('attributes'),
            ['attribute_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add value_integers foreign keys.
     *
     * @param Schema $schema
     */
    protected function addValueIntegersForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('value_integers');
        $table->addForeignKeyConstraint(
            $schema->getTable('products'),
            ['product_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('attributes'),
            ['attribute_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add value_texts foreign keys.
     *
     * @param Schema $schema
     */
    protected function addValueTextsForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('value_texts');
        $table->addForeignKeyConstraint(
            $schema->getTable('products'),
            ['product_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('attributes'),
            ['attribute_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add value_varchars foreign keys.
     *
     * @param Schema $schema
     */
    protected function addValueVarcharsForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('value_varchars');
        $table->addForeignKeyConstraint(
            $schema->getTable('products'),
            ['product_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('attributes'),
            ['attribute_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }
}
