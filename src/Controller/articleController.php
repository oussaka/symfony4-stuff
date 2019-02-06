<?php

namespace App\Controller;

use App\Entity\Article;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * article controller
 * @package App\Controller
 *
 * @Route("/api")
 */
class articleController extends AbstractController
{
    /**
     * Lists all Articles.
     * @FOSRest\Get("/articles")
     *
     * @return array
     */
    public function getArticleAction()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->findall();

        return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * Create Article.
     * @FOSRest\Post("/article")
     *
     * @return array
     */
    public function postArticleAction(Request $request)
    {
        $article = new Article();
        $article->setName($request->get('name'));
        $article->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return View::create($article, Response::HTTP_CREATED, []);
    }
}