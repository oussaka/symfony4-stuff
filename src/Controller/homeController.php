<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 17/02/2018
 * Time: 11:34
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class homeController extends AbstractController
{
    public function __invoke()
    {
        return $this->render('home/home.html.twig', ['comments' => []]);
    }
}