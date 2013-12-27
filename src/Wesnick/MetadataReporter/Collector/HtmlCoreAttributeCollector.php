<?php
/**
 * @file HtmlMetaAttributes.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\Metadatum;

class HtmlCoreAttributeCollector implements MetadataCollectorInterface
{

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

        return $this->processMetaTags($head);

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
            'html.meta.charset.character_set'    => 'Specifies the character encoding for the HTML document',
            'html.meta.content.text'             => 'Gives the value associated with the http-equiv or name attribute',
            'html.meta.http-equiv.content-type'  => 'HTTP Header equivalent meta tag describing the content type of the document',
            'html.meta.http-equiv.default-style' => '',
            'html.meta.http-equiv.refresh'       => 'HTTP Header equivalent designating the automatic refresh interval of the page',
            'html.meta.author'                   => '',
            'html.meta.description'              => '',
            'html.meta.generator'                => '',
            'html.meta.keywords'                 => '',
            'html.meta.robots'                   => '',
            'html.meta.scheme.format-uri'        => 'Specifies a scheme to be used to interpret the value of the content attribute',
        );
    }



    private function processMetatags(Crawler $head)
    {
        $metas = $head->filter('meta');

        $rawTags = array();
        /** @var $tag \DOMElement */
        foreach ($metas as $index => $tag) {
            $attrs = $tag->attributes;

            $rawTags[$index] = array();

            /** @var $node \DOMAttr */
            foreach ($attrs as $node) {
                $rawTags[$index][$node->nodeName] = $node->nodeValue;
            }
        }

        $return_tags = array();
        foreach ($rawTags as $tag) {
            $return_tags[] = $this->processRawTag($tag);
        }

        return $return_tags;
    }

    private function processRawTag($tag)
    {

        if (!isset($tag['content'])) {
            throw new \Exception("Missing content for tag . " . print_r($tag));
        }

        switch ($tag) {
            case (isset($tag['http-equiv'])):
                return new Metadatum($tag['http-equiv'], $tag['content']);
                break;
            case (isset($tag['name'])):
                return new Metadatum($tag['name'], $tag['content']);
                break;
        }

    }
} 
