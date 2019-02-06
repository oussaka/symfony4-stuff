<?php

namespace App\Controller;

use App\Entity\Article;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * article controller
 * @package App\Controller
 *
 * @Route("/api")
 */
class articleController extends AbstractFOSRestController
{
    /**
     * Lists all Articles.
     * @FOSRest\Get("/articles")
     * @return View
     */
    public function getArticles(): View
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->findall();

        return View::create($article, Response::HTTP_OK, []);
    }

    /**
     * Retrieves an Article resource.
     * @FOSRest\Get("/articles/{articleId}")
     * @return View
     */
    public function getArticle(int $articleId): View
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findById($articleId);
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
        $article = new Article();
        $article->setName($request->get('name'));
        $article->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return View::create($article, Response::HTTP_CREATED, []);
    }

    /**
     * Replaces Article resource
     * @FOSRest\Put("/articles/{articleId}")
     * @return View
     */
    public function putArticle(int $articleId, Request $request): View
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->findById($articleId);
        if ($article) {
            $article->setTitle($request->get('title'));
            $article->setContent($request->get('content'));
            $em->getRepository(Article::class)->save($article);
        }
        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Removes the Article resource
     * @FOSRest\Delete("/articles/{articleId}")
     * @return View
     */
    public function deleteArticle(int $articleId): View
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findById($articleId);
        if ($article) {
            $this->getDoctrine()->getRepository(Article::class)->delete($article);
        }
        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}