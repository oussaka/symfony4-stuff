<?php

namespace App\Controller\Rest;

use App\Service\ArticleService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Article controller
 * @package App\Controller
 *
 * @Route("/api")
 */
class ArticleController extends AbstractFOSRestController
{
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Lists all Articles.
     * @FOSRest\Get("/articles")
     * @return View
     */
    public function getArticles(): View
    {
        $articles = $this->articleService->getAllArticles();

        return View::create($articles, Response::HTTP_OK, []);
    }

    /**
     * Retrieves an Article resource.
     * @FOSRest\Get("/articles/{articleId}")
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getArticle(int $articleId): View
    {
        $article = $this->articleService->getArticle($articleId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Create Article.
     * @FOSRest\Post("/article")
     * @param Request $request
     * @return View
     */
    public function postArticle(Request $request): View
    {
        $article = $this->articleService->addArticle($request->get('name'), $request->get('description'));

        return View::create($article, Response::HTTP_CREATED, []);
    }

    /**
     * Replaces Article resource
     * @FOSRest\Put("/articles/{articleId}")
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putArticle(int $articleId, Request $request): View
    {
        $article = $this->articleService->updateArticle(
            $articleId,
            $request->get('name'),
            $request->get('description')
        );

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Removes the Article resource
     * @FOSRest\Delete("/articles/{articleId}")
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteArticle(int $articleId): View
    {
        $this->articleService->deleteArticle($articleId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}