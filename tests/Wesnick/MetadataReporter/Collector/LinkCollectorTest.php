<?php
/**
 * @file LinkCollectorTest.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ExpressionBuilder;
use Symfony\Component\DomCrawler\Crawler;

class LinkCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MetaTagCollector
     */
    private $collector;

    public function setUp()
    {
        $html = file_get_contents(__DIR__ . '/../../../fixtures/html/html-meta-1.html');
        $crawler = new Crawler($html, 'http://localhost/test');
        $this->collector = new LinkCollector();
        $this->collector->collect($crawler, array());
    }

    public function tearDown()
    {
        $this->collector = null;
    }

    public function testCollection()
    {
        $metadata = $this->collector->getMetadata();
        $this->assertCount(7, $metadata);
    }

}
