<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 17/02/2018
 * Time: 11:34
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class homeController
{
    public function __invoke()
    {
        return new Response("Hello Symfony 4 !");
    }
}