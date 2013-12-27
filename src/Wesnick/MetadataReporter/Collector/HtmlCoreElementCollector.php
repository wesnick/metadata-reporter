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
     * @return Metadatum[]
     */
    public function collect(Crawler $content, array $headers)
    {
        $this->metadata = array();
        $head = $content->filter('head');

        $this->processTitle($head);

        return $this->metadata;

    }

    /**
     * Return an array of names of metadata this collector collects
     *
     * @return array
     */
    public function getTargetNames()
    {
        return array(
            static::HTML_DOCTYPE                => 'HTML DocType',
            static::HTML_HEAD_TITLE             => 'Page Title',

        );
    }


    private function processTitle(Crawler $head)
    {
        $this->metadata[] =new Metadatum('html.head.title', $head->filter('title')->text());
    }


} 
