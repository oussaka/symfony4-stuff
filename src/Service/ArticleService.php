<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityNotFoundException;

final class ArticleService
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getArticle(int $id): ?Article
    {
        if (!$article = $this->articleRepository->find($id)) {
            throw new EntityNotFoundException('Article with id '.$id.' does not exist!');
        }

        return $article;
    }

    public function getAllArticles(): ?array
    {
        return $this->articleRepository->findAll();
    }

    public function addArticle(string $name, string $description): Article
    {
        $article = (new Article())
            ->setName($name)
            ->setDescription($description)
        ;
        $this->articleRepository->save($article);

        return $article;
    }

    public function updateArticle(int $id, string $name, string $description): ?Article
    {
        if (!$article = $this->articleRepository->findById($id)) {
            throw new EntityNotFoundException('Article with id '.$id.' does not exist!');
        }
        $article->setName($name);
        $article->setDescription($description);
        $this->articleRepository->save($article);

        return $article;
    }

    public function deleteArticle(int $id): void
    {
        if (!$article = $this->articleRepository->findById($id)) {
            throw new EntityNotFoundException('Article with id '.$id.' does not exist!');
        }

        $this->articleRepository->delete($article);
    }
}