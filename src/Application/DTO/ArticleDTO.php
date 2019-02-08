<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 08/02/19
 * Time: 20:35
 */

namespace App\Application\DTO;

/**
 * Class ArticleDTO
 * @package App\Application\DTO
 */
final class ArticleDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

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