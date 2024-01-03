<?php

namespace AAXIS\Bundle\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

/**
 * ORM Entity Document.
 *
 * @ORM\Entity()
 * @ORM\Table(name="oro_training_test_type")
 * @Config
 */
class TestTypeAttr
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=250,
     *     nullable=false
     * )
     */
    private ?string $name;


    /**
     * Populate the type name field
     *
     * @param string $name
     */
    public function __construct(string $name = '')
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
