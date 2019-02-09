<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 17/02/2018
 * Time: 11:34
 */

namespace App\Controller;

use App\Service\MarkdownHelper;
use Nexy\Slack\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $slack;

    /**
     * homeController constructor.
     */
    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function __invoke(MarkdownHelper $markdownHelper)
    {
        if ($slug ?? 'khaaaaaan' === 'khaaaaaan') {
            $message = $this->slack->createMessage()
                ->from('Khan')
                ->withIcon(':ghost:')
                ->setText('Ah, Kirk, my old friend...');
            $this->slack->sendMessage($message);
        }

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];
        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;
        $articleContent = $markdownHelper->parse($articleContent);

        return $this->render('home/home.html.twig', [
            'comments'       => $comments,
            'slug'           => 'slugTest',
            'articleContent' => $articleContent,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart",name="article_toggle_heart",methods={"POST"})
     * @param $slug
     * @return JsonResponse
     */
    public function toggleArticleHeart($slug)
    {
        //TODO - actually heart/unheart the article!
        return new JsonResponse(['hearts' =>rand(5,100)]);
    }
}