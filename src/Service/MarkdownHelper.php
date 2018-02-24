<?php

namespace App\Service;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    private $cache;
    private $markdown;
    /**
     * @var LoggerInterface|null
     */
    private $logger;


    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
    }

    /**
     * @required
     * @param LoggerInterface $markdownLogger
     */
    public function setLogger(LoggerInterface $markdownLogger)
    {
        $this->logger = $markdownLogger;
    }

    public function parse(string $source): string
    {
        $this->logger->info('They are talking about bacon again!');

        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }
}
