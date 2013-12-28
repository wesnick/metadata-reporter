<?php

namespace Wesnick\MetadataReporter\Metadata;


class MetaTagTest extends \PHPUnit_Framework_TestCase
{


    public function basicMetadataProvider()
    {
        return array(
            array('http-equiv', 'content-type',  'text/html; charset=UTF-8'),
            array('name', 'author', 'Wesley O. Nichols'),
            array('property', 'og:title', 'Open Graph Title'),
        );
    }

    /**
     * @dataProvider basicMetadataProvider
     */
    public function testBasicMetaTag($attr, $name, $content)
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $element = $dom->createElement("meta");
        $element->setAttribute($attr, $name);
        $element->setAttribute('content', $content);

        $metatag = new MetaTag($element);

        $this->assertEquals($metatag->getName(), $name);
        $this->assertEquals($metatag->getValue(), $content);
        $this->assertAttributeEquals(('http-equiv' === $attr), 'httpEquiv', $metatag);

    }


    public function testBadMetaTagNameIsHandled()
    {

        $dom = new \DOMDocument('1.0', 'utf-8');
        $element = $dom->createElement("meta");
        $element->setAttribute('nayme', 'robots');
        $element->setAttribute('content', 'noindex');

        $metatag = new MetaTag($element);
        $this->assertEquals($metatag->getName(), '');
        $this->assertEquals($metatag->getValue(), 'noindex');

    }

    public function testBadMetaTagContentIsHandled()
    {

        $dom = new \DOMDocument('1.0', 'utf-8');
        $element = $dom->createElement("meta");
        $element->setAttribute('name', 'robots');

        $metatag = new MetaTag($element);
        $this->assertEquals($metatag->getName(), 'robots');
        $this->assertEquals($metatag->getValue(), '');

    }

}
