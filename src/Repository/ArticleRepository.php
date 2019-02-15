<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class ArticleRepository extends ServiceEntityRepository
{
    protected $_em;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Article::class);
        $this->_em = $em;
    }

    public function save(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush();
    }

    public function delete(Article $article)
    {
        $this->_em->remove($article);
        $this->_em->flush();
    }
}
