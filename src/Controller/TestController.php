<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 04/05/2018
 * Time: 16:20
 */

namespace App\Controller;


class TestController
{
    public function __invoke()
    {
        return $this->render('home/home.html.twig', [
            'comments'       => "comment",
            'slug'           => 'slugTest',
            'articleContent' => "article content",
        ]);
    }
}