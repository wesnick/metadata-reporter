<?php
/**
 * @file HtmlCoreElementCollector.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\Metadatum;

class HtmlCoreElementCollector implements MetadataCollectorInterface
{

    const HTML_DOCTYPE      = 'html.doctype';
    const HTML_HEAD_TITLE   = 'html.head.title';

    private $metadata;

    /**
     * @param Crawler $content
     * @param array $headers
     */
    public function collect(Crawler $content, array $headers)
    {
        $this->metadata = array();
        $head = $content->filter('head');

        $this->processTitle($head);
    }

    /**
     * Return an array of names of metadata this collector collects
     *
     * @return array
     */
    public function getMetadataNames()
    {
        return array(
            static::HTML_DOCTYPE                => 'HTML DocType',
            static::HTML_HEAD_TITLE             => 'Page Title',

        );
    }

    /**
     * @TODO
     * @param Crawler $content
     */
    private function processDocType(Crawler $content)
    {
//        $this->metadata[] =new Metadatum(static::HTML_HEAD_TITLE, $content->filter('title')->text());
    }

    private function processTitle(Crawler $head)
    {
        $this->metadata[] =new Metadatum(static::HTML_HEAD_TITLE, $head->filter('title')->text());
    }

    /**
     * Return targeted metadata.
     *
     * @return Metadatum[]
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * If a collector collects other types of metadata it is not targeting, it may return them here.
     *
     * @return Metadatum[]
     */
    public function getExtraMetadata()
    {
        return array();
    }


} 
