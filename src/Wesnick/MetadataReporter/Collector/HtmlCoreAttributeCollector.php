<?php
/**
 * @file HtmlMetaAttributes.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\Metadatum;

class HtmlCoreAttributeCollector implements MetadataCollectorInterface
{

    const HTML_META_CHARSET                 = 'html.meta.charset.character_set';
    const HTML_META_CONTENT_TEXT            = 'html.meta.content.text' ;
    const HTML_META_HTTPEQUIV_CONTENT_TYPE  = 'html.meta.http-equiv.content-type';
    const HTML_META_HTTPEQUIV_DEFAULT_STYLE = 'html.meta.http-equiv.default-style';
    const HTML_META_HTTPEQUIV_REFRESH       = 'html.meta.http-equiv.refresh' ;
    const HTML_META_AUTHOR                  = 'html.meta.author' ;
    const HTML_META_DESCRIPTION             = 'html.meta.description'  ;
    const HTML_META_GENERATOR               = 'html.meta.generator';
    const HTML_META_KEYWORDS                = 'html.meta.keywords' ;
    const HTML_META_ROBOTS                  = 'html.meta.robots' ;
    const HTML_META_APPLICATION_NAME        = 'html.meta.application-name' ;
    const HTML_META_SCHEME                  = 'html.meta.scheme.format-uri' ;

    /**
     * @var ArrayCollection
     */
    private $metadata;

    /**
     * @param Crawler $content
     * @param array $headers
     */
    public function collect(Crawler $content, array $headers)
    {
        $this->metadata = new ArrayCollection();
        $head = $content->filter('head');

        $this->processMetaTags($head);
    }

    /**
     * Return an array of names of metadata this collector targets
     *
     * @return array
     */
    public function getMetadataNames()
    {
        return array(
            // @TODO: These need to take into account HTML4 or 5
//            static::HTML_META_CHARSET                   => 'Specifies the character encoding for the HTML document',
//            static::HTML_META_CONTENT_TEXT              => 'Gives the value associated with the http-equiv or name attribute',

           // @TODO:  These need to be moved to a "header" collector class
            static::HTML_META_HTTPEQUIV_CONTENT_TYPE    => 'HTTP Header equivalent meta tag describing the content type of the document',
            static::HTML_META_HTTPEQUIV_DEFAULT_STYLE   => 'Default Stylesheet of the Document  ',
            static::HTML_META_HTTPEQUIV_REFRESH         => 'HTTP Header equivalent designating the automatic refresh interval of the page',

            // Standard Meta Tags
            static::HTML_META_AUTHOR                    => 'Describes the Author of the Web Page.  Normally used for the Publishing organization rather than the individual author of the page',
            static::HTML_META_DESCRIPTION               => 'Description of the contents of the particular web page',
            static::HTML_META_GENERATOR                 => 'The generator of the page, usually a web framework or publishing system',
            static::HTML_META_KEYWORDS                  => 'A comma separated list of keywords for the web page',
            static::HTML_META_ROBOTS                    => 'Directives for web crawlers',
            static::HTML_META_APPLICATION_NAME          => 'A Human Readable name for the Application',

//            static::HTML_META_SCHEME                    => 'Specifies a scheme to be used to interpret the value of the content attribute',
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

        foreach ($rawTags as $tag) {
            $this->processRawTag($tag);
        }

    }

    private function processRawTag($tag)
    {

        if (!isset($tag['content'])) {
            $tag['content'] = null;
        }

        switch ($tag) {
            case (isset($tag['http-equiv'])):
                $this->handleHttpEquivMeta($tag['http-equiv'], $tag['content']);
                break;
            case (isset($tag['name'])):
                $this->handleNamedMeta($tag['name'], $tag['content']);
                break;
        }

    }

    private function handleNamedMeta($name, $content)
    {

        $canonical_name = null;
        switch (strtolower($name)) {
            case 'author':
                $canonical_name = static::HTML_META_AUTHOR;
                break;
            case 'description':
                $canonical_name = static::HTML_META_DESCRIPTION;
                break;
            case 'generator':
                $canonical_name = static::HTML_META_GENERATOR;
                break;
            case 'keywords':
                $canonical_name = static::HTML_META_KEYWORDS;
                break;
            case 'robots':
                $canonical_name = static::HTML_META_ROBOTS;
                break;
            case 'application-name':
                $canonical_name = static::HTML_META_APPLICATION_NAME;
                break;

        }

        if (isset($canonical_name)) {
            $this->metadata[] = new Metadatum($canonical_name, $content);
        }


    }


    private function handleHttpEquivMeta($name, $content)
    {
        switch (strtolower($name)) {
            case 'content-type':
                $name = static::HTML_META_HTTPEQUIV_CONTENT_TYPE;
                break;
            case 'default-style':
                $name = static::HTML_META_HTTPEQUIV_DEFAULT_STYLE;
                break;
            case 'refresh':
                $name = static::HTML_META_HTTPEQUIV_REFRESH;
                break;
        }

        $this->metadata[] = new Metadatum($name, $content);

    }

    /**
     * Return targeted metadata.
     *
     * @return ArrayCollection
     */
    public function getMetadata()
    {
        $targets = $this->getMetadataNames();

        return $this->metadata->filter(function (Metadatum $m) use ($targets) { return array_key_exists($m->getName(), $targets); });

    }

    /**
     * If a collector collects other types of metadata it is not targeting, it may return them here.
     *
     * @return Metadatum[]
     */
    public function getExtraMetadata()
    {
        $targets = $this->getMetadataNames();
        $ret = array();

        /** @var $metadata Metadatum */
        foreach ($this->metadata as $metadata) {
            if ( ! array_key_exists($metadata->getName(), $targets)) {
                $ret[] = $metadata;
            }
        }

        return $ret;
    }


} 
