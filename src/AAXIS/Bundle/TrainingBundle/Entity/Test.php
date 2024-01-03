<?php

namespace AAXIS\Bundle\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use AAXIS\Bundle\TrainingBundle\Entity\TestTypeAttr;

/**
 * ORM Entity Document.
 *
 * @ORM\Entity()
 * @ORM\Table(name="oro_training_test")
 * @Config
 */
class Test
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
     * @ORM\OneToOne(
     *     targetEntity="AAXIS\Bundle\TrainingBundle\Entity\TestTypeAttr"
     * )
     * @ORM\JoinColumn(
     *     name="type_id",
     *     nullable=true,
     *     onDelete="SET NULL"
     * )
     */
    private ?TestTypeAttr $type;

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

    public function getType(): ?TestTypeAttr
    {
    return $this->type;
    }

    public function setType(?TestTypeAttr $type): self
    {
    $this->type = $type;

    return $this;
    }
}
