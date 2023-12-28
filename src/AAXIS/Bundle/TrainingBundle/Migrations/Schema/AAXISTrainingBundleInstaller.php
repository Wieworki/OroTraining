<?php

namespace AAXIS\Bundle\TrainingBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Handles all migrations logic executed during installation.
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class AAXISTrainingBundleInstaller implements Migration, ExtendExtensionAwareInterface
{
    protected const ORO_TRAINING_TEST_TABLE_NAME = 'oro_training_test';
    protected const ORO_TRAINING_TEST_TYPE_TABLE_NAME = 'oro_training_test_type';

    /**
     * @var ExtendExtension
     */
    protected ExtendExtension $extendExtension;

    /**
     * Returns the version to check if updates are needed
     */
    public function getMigrationVersion(): string
    {
        return 'v1_00';
    }

    /**
     * {@inheritdoc}
     */
    public function setExtendExtension(ExtendExtension $extendExtension): void
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries): void
    {
        /** Tables generation **/
        $this->createOroTrainingTypeTable($schema);
        $this->createOroTrainingTestTable($schema);
    }

    /**
     * Create oro_catalog_category table
     */
    protected function createOroTrainingTypeTable(Schema $schema): void
    {
        $table = $this->extendExtension->createCustomEntityTable(
            $schema,
            self::ORO_TRAINING_TEST_TYPE_TABLE_NAME
        );
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn(
            'name',
            'string',
            [
                'length' => 100,
                'oro_options' => [
                    'extend'  => ['owner' => ExtendScope::OWNER_CUSTOM],
                    'entity' => ['label' => 'name']
                ]
            ]
        );
        $table->setPrimaryKey(['id']);
    }

    /**
     * Create oro_catalog_category table
     */
    protected function createOroTrainingTestTable(Schema $schema): void
    {
        $table = $this->extendExtension->createCustomEntityTable(
            $schema,
            self::ORO_TRAINING_TEST_TABLE_NAME
        );
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
            'oro_training_type',
            'name',
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ]
            ]
        );
        $table->setPrimaryKey(['id']);
    }
}
