<?php

namespace AAXIS\Bundle\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* ORM Entity Document.
*
* @ORM\Entity()
* @ORM\Table(name="oro_training_test")
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
    *     targetEntity="AAXIS\Bundle\TrainingBundle\Entity\TestType"
    * )
    * @ORM\JoinColumn(
    *     name="type_id",
    *     nullable=true,
    *     onDelete="SET NULL"
    * )
    */
    private ?TestType $type;

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

    public function getType(): ?TestType
    {
    return $this->type;
    }

    public function setType(?TestType $type): self
    {
    $this->type = $type;

    return $this;
    }
}
