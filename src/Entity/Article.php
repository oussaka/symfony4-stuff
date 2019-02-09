<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="5")
     * @var string
     */
    public $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
/*        if (strlen($name) < 5) {
            throw new \InvalidArgumentException("Name {$name} needs to have more then 5 characters.");
        }*/

        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }
}