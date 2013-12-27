<?php
/**
 * @file HtmlCoreAttributeCollectorTest.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Symfony\Component\DomCrawler\Crawler;

class HtmlCoreAttributeCollectorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var HtmlCoreAttributeCollector
     */
    private $collector;

    public function setUp()
    {
        $html = file_get_contents(__DIR__ . '/../../../fixtures/html/html-meta-1.html');
        $crawler = new Crawler($html);
        $this->collector = new HtmlCoreAttributeCollector();
        $this->collector->collect($crawler, array());
    }

    public function tearDown()
    {
        $this->collector = null;
    }

    public function testCollection()
    {


        $metadata = $this->collector->getMetadata();

        $this->assertCount(9, $metadata);
    }

}
