<?php
/**
 * @file MetaTag.php
 */

namespace Wesnick\MetadataReporter\Metadata;


class MetaTag implements MetaDatumInterface
{

    protected $content;
    protected $name;
    protected $httpEquiv = false;
    protected $documentLocation;

    function __construct(\DOMElement $node, $documentLocation = MetaDatumInterface::CONTENT_HEAD)
    {

        if ($node->hasAttribute('http-equiv')) {
            $this->httpEquiv = true;
            $this->name = $node->getAttribute('http-equiv');
        } elseif ($node->hasAttribute('property')) {
            $this->name = $node->getAttribute('property');
        } else {
            $this->name = $node->getAttribute('name');
        }

        $this->content = $node->getAttribute('content');
        $this->documentLocation = $documentLocation;

    }

    public function getValue()
    {
        return $this->content;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDocumentLocation()
    {
        return $this->documentLocation;
    }

    public function isHttpEquiv()
    {
        return $this->httpEquiv;
    }


}
