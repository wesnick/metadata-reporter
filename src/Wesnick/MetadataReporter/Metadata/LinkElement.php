<?php
/**
 * @file LinkElement.php
 */

namespace Wesnick\MetadataReporter\Metadata;


use Symfony\Component\DomCrawler\Link;

class LinkElement extends Link implements MetaDatumInterface
{

    const ANCHOR_TAG = 'anchor';
    const LINK_TAG   = 'link';

    protected $tag;
    protected $href;
    protected $rel;
    protected $type;

    public function __construct(\DOMNode $node, $currentUri, $method = 'GET')
    {
        parent::__construct($node, $currentUri, $method);
        $this->processAttributes($node);
    }


    private function processAttributes(\DOMNode $node)
    {

        $this->tag = ($node->nodeName == 'link') ? self::LINK_TAG : self::ANCHOR_TAG;

        $target_attribs = array(
            'href', 'rel', 'type'
        );
        $node_attributes = $node->attributes;
        foreach ($target_attribs as $attr) {
            if ($attributes = $node_attributes->getNamedItem($attr)) {
                $this->{$attr} = $attributes->nodeValue;
            }
        }

    }

    public function getValue()
    {
        // TODO: Implement getValue() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getDocumentLocation()
    {
        // TODO: Implement getDocumentLocation() method.
    }

    /**
     * @return mixed
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return mixed
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }



    /**
     * Sets current \DOMNode instance.
     *
     * @param \DOMNode $node A \DOMNode instance
     *
     * @throws \LogicException If given node is not an anchor
     */
    protected function setNode(\DOMNode $node)
    {
        if ( ! in_array($node->nodeName, array('link', 'a'))) {
            throw new \LogicException(sprintf('Unable to click on a "%s" tag.', $node->nodeName));
        }

        $this->node = $node;
    }
} 
