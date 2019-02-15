<?php

namespace App\Service;

use App\Application\DTO\ArticleDTO;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ArticleService
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ArticleRepository $articleRepository, ValidatorInterface $validator)
    {
        $this->articleRepository = $articleRepository;
        $this->validator = $validator;
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

    public function addArticle(ArticleDTO $articleDTO): Article
    {
        $article = (new Article())
            ->setName($articleDTO->getName())
            ->setDescription($articleDTO->getDescription())
        ;

        $violations = $this->validator->validate($article);
        if (\count($violations) > 0) {
            throw new \DomainException((string)$violations);
        }

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
        if (!$article = $this->articleRepository->find($id)) {
            throw new EntityNotFoundException('Article with id '.$id.' does not exist!');
        }

        $this->articleRepository->delete($article);
    }
}