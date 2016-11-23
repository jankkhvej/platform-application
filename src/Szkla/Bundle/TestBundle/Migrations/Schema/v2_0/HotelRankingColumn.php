<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Migrations\Schema\v2_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;

class HotelRankingColumn implements Migration
{

    /**
     * @inheritdoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->getTable('szkla_hotel');
        $table->addColumn(
            'hotel_ranking',
            'string',
            [
                'oro_options' => [
                    'extend' => [
                        'is_extend' => true,
                        'owner' => ExtendScope::OWNER_CUSTOM,
                    ],
                    'entity' => ['label' => 'Hotel rating'],
                    'datagrid' => ['is_visible' => false],
                ]
            ]
        );
    }
}