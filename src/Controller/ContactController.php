<?php

namespace App\Controller;

use App\Service\CacheExample;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'cache' => ['hit' => false]
        ]);
    }

    /**
     * @Route("/cache", name="cache")
     *
     * @param CacheItemPoolInterface $cache
     * @return JsonResponse
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function cacheExample(CacheItemPoolInterface $cache): Response
    {
        $cachedData = $cache->getItem('random_number');

        if ($cachedData->isHit()) {
            return new JsonResponse([
                'data' => $cachedData->get(),
                'hit'  => $cachedData->isHit(),
            ]);
        }

        $number = mt_rand(1, 100);

        $cachedData->set($number);
        $cachedData->expiresAfter(10);

        $cache->save($cachedData);

        return new JsonResponse([
            'data' => $cachedData->get(),
            'hit'  => $cachedData->isHit(),
        ]);
    }

    /**
     * @Route("/cacheredis", name="cacheRedis")
     * @param CacheItemPoolInterface $cache
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function cacheRedis(CacheExample $cache)
    {

        return $this->render('contact/index.html.twig', [
            'cache' => [
                'hit' => $cache->get('some-value')->isHit(),
            ],
            'controller_name' => 'ContactController',
        ]);
    }

}
