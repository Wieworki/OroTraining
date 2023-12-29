<?php

namespace AAXIS\Bundle\TrainingBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AAXISTrainingBundle implements Migration, ExtendExtensionAwareInterface
{
    protected const ORO_TRAINING_TEST_TABLE_NAME = 'oro_training_test';
    protected const ORO_TRAINING_TEST_TYPE_TABLE_NAME = 'oro_training_test_type';

    /**
     * @var ExtendExtension
     */
    protected ExtendExtension $extendExtension;

    public function setExtendExtension(ExtendExtension $extendExtension): void
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * {@inheritdoc}
     * @throws SchemaException
     */
    public function up(Schema $schema, QueryBag $queries): void
    {
        /** Tables generation **/
        $this->createOroTrainingTypeTable($schema);
        $this->createOroTrainingTestTable($schema);

        /** Foreign keys generation **/
        $this->addOroTrainingTestTableForeignKeys($schema);
    }

    /**
     * Create oro_training_test_type table
     */
    protected function createOroTrainingTypeTable(Schema $schema): void
    {
        $table = $schema->createTable(self::ORO_TRAINING_TEST_TYPE_TABLE_NAME);
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn(
            'name',
            'string',
            [
                'length' => 250,
                'oro_options' => [
                    'extend'  => ['owner' => ExtendScope::OWNER_CUSTOM],
                    'entity' => ['label' => 'name']
                ]
            ]
        );
        $table->setPrimaryKey(['id']);
    }

    /**
     * Create oro_training_test table
     */
    protected function createOroTrainingTestTable(Schema $schema): void
    {
        $table = $schema->createTable(self::ORO_TRAINING_TEST_TABLE_NAME);
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn(
            'name',
            'string',
            [
                'notnull' => true,
                'length' => 250,
                'oro_options' => [
                    'extend'  => ['owner' => ExtendScope::OWNER_CUSTOM],
                    'entity' => ['label' => 'name']
                ]
            ]
        );
        $this->extendExtension->addManyToOneRelation(
            $schema,
            $table,
            'type',
            'oro_training_test_type',
            'name',
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ]
            ]
        );
        $table->setPrimaryKey(['id']);
        $table->addIndex(['type_id'], 'UNIQ_9BF685C4C54C8C93', []);
    }

    /**
     * Add oro_training_test foreign keys.
     * @throws SchemaException
     */
    protected function addOroTrainingTestTableForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable(self::ORO_TRAINING_TEST_TABLE_NAME);
        $table->addForeignKeyConstraint(
            $schema->getTable(self::ORO_TRAINING_TEST_TYPE_TABLE_NAME),
            ['type_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }
}
