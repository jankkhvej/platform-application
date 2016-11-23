<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class Hotel (Migrations)
 */
class Hotel implements Migration
{

    /**
     *
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable('szkla_hotel');
        $table->addOption('collate','utf8mb4_general_ci');
        $table->addOption('charset','utf8mb4');
        $table->addOption('engine','InnoDB');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['name'], 'hotel_name_idx', []);
    }
}
