<?php

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\MetaTag;

class MetaTagCollector implements CollectorInterface
{


    /**
     * @var ArrayCollection
     */
    private $metadata;

    /**
     * @param $uri
     * @param Crawler $content
     * @param array $headers
     */
    public function collect($uri, Crawler $content, array $headers)
    {
        $this->metadata = new ArrayCollection();
        $head = $content->filter('head');

        $this->processMetaTags($head);
    }


    private function processMetatags(Crawler $head)
    {
        $metas = $head->filter('meta');

        /** @var $tag \DOMElement */
        foreach ($metas as $tag) {
            $this->metadata->add(new MetaTag($tag));
        }
    }


    /**
     * Return metadata.
     *
     * @return ArrayCollection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

} 
