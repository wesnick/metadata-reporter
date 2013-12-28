<?php
/**
 * @file LinkCollector.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\LinkElement;

class LinkCollector implements CollectorInterface
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
        $links = $content->filter('link');

        /** @var $link \DOMElement */
        foreach ($links as $index => $link) {
            $this->metadata[] = new LinkElement($link, "http://localhost/url");
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
