<?php

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\DocTitle;

class HtmlCoreElementCollector implements CollectorInterface
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
        $this->processDocType($content);
        $head = $content->filter('head');

        $this->processTitle($head);
    }



    /**
     * @TODO
     * @param Crawler $content
     */
    private function processDocType(Crawler $content)
    {
        $docType = $content->getNode(0)->ownerDocument->doctype;

//        $this->metadata[] =new Metadatum(static::HTML_HEAD_TITLE, $content->filter('title')->text());
    }

    private function processTitle(Crawler $head)
    {
        $this->metadata[] = new DocTitle($head->filter('title')->text());
    }

    /**
     * Return targeted metadata.
     *
     * @return ArrayCollection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }



} 
