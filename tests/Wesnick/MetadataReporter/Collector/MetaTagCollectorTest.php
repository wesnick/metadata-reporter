<?php

namespace Wesnick\MetadataReporter\Collector;


use Symfony\Component\DomCrawler\Crawler;

class MetaTagCollectorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var MetaTagCollector
     */
    private $collector;

    public function setUp()
    {
        $html = file_get_contents(__DIR__ . '/../../../fixtures/html/html-meta-1.html');
        $crawler = new Crawler($html);
        $this->collector = new MetaTagCollector();
        $this->collector->collect($crawler, array());
    }

    public function tearDown()
    {
        $this->collector = null;
    }

    public function testCollection()
    {
        $metadata = $this->collector->getMetadata();
        $this->assertCount(40, $metadata);
    }

}
