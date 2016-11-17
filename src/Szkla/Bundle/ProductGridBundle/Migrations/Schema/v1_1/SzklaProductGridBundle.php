<?php

namespace Szkla\Bundle\ProductGridBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Migration Class SzklaProductGridBundle
 *
 */
class SzklaProductGridBundle implements Migration
{

    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        // @codingStandardsIgnoreStart
        $schema->getTable('products')->getColumn('is_active')->setDefault(1);
        $schema->getTable('users')->getColumn('is_active')->setDefault(1);
        $schema->getTable('attributes')->getColumn('is_required')->setDefault(0);
        // @codingStandardsIgnoreEnd
    }
}
