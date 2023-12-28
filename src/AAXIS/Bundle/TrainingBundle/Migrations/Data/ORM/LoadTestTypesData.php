<?php
namespace AAXIS\Bundle\TrainingBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use AAXIS\Bundle\TrainingBundle\Entity\TestType;

class LoadTestTypesData extends AbstractFixture
{
    protected const TYPE_WEB = 'WEB';
    protected const TYPE_LOCAL = 'LOCAL';
    protected const TYPE_DUAL = 'DUAL';

    /**
     * Load roles
     */
    public function load(ObjectManager $manager): void
    {
        $typeWeb = new TestType(self::TYPE_WEB);
        $typeLocal = new TestType(self::TYPE_LOCAL);
        $typeDual = new TestType(self::TYPE_DUAL);

        $manager->persist($typeWeb);
        $manager->persist($typeLocal);
        $manager->persist($typeDual);

        $manager->flush();
    }
}
