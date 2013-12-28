<?php

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;

interface CollectorInterface
{
    /**
     * @param $uri
     * @param Crawler $content
     * @param array $headers
     * @return
     */
    public function collect($uri, Crawler $content, array $headers);

    /**
     * Return metadata.
     *
     * @return ArrayCollection
     */
    public function getMetadata();

} 
