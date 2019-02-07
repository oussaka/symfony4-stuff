<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;

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
        return $this->articleRepository->find($id);
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
            return null;
        }
        $article->setName($name);
        $article->setDescription($description);
        $this->articleRepository->save($article);

        return $article;
    }

    public function deleteArticle(int $id): void
    {
        $article = $this->articleRepository->findById($id);
        if ($article) {
            $this->articleRepository->delete($article);
        }
    }
}