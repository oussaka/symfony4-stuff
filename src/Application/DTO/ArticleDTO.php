<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 08/02/19
 * Time: 20:35
 */

namespace App\Application\DTO;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArticleDTO
 * @package App\Application\DTO
 */
final class ArticleDTO
{
    /**
     * @Serializer\Type("string")
     * @Assert\Length(min="5")
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @Serializer\Type("string")
     * @Assert\NotBlank
     */
    public $description;

    /**
     * ArticleDTO constructor.
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name = '', string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}