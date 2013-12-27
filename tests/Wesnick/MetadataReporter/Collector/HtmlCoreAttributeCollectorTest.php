<?php
/**
 * @file HtmlCoreAttributeCollectorTest.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Symfony\Component\DomCrawler\Crawler;

class HtmlCoreAttributeCollectorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Crawler
     */
    private $crawler;

    public function setUp()
    {
        $html = file_get_contents(__DIR__ . '/../../../fixtures/html/html-core-1.html');
        $this->crawler = new Crawler($html);
    }

    public function tearDown()
    {
        $this->crawler = null;
    }

    public function testCollection()
    {
        $collector = new HtmlCoreAttributeCollector();
        $metadata = $collector->collect($this->crawler, array());
        $x = 'y';



    }

}
