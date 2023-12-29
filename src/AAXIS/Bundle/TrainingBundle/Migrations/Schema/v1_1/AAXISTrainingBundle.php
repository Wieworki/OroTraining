<?php

namespace AAXIS\Bundle\TrainingBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AAXISTrainingBundle implements Migration
{
    protected const ORO_TRAINING_TEST_TABLE_NAME = 'oro_training_test';

    /**
     * {@inheritdoc}
     * @throws SchemaException
     */
    public function up(Schema $schema, QueryBag $queries): void
    {
        $table = $schema->getTable(self::ORO_TRAINING_TEST_TABLE_NAME);
        $table->addColumn('description', 'string',  [ 'length' => 200, 'notnull' => false ]);
    }
}
