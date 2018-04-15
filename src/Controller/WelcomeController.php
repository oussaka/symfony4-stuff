<?php

namespace App\Controller;

use App\Mailer\Emailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome/{name}", name="welcome")
     */
    public function index(Request $request, Emailer $emailer, string $name)
    {
        dump($emailer);

        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }
}
