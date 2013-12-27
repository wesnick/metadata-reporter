<?php
/**
 * @file ReportBuilder.php
 */

namespace Wesnick\MetadataReporter;


use Buzz\Browser;
use Buzz\Message\Response;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Collector\HtmlCoreAttributeCollector;

class ReportBuilder
{


    /**
     * @var Browser
     */
    protected $browser;






    public function run()
    {
//        $this->browser = new Browser();
//        $response = $this->browser->get("http://nytimes.com");

//        file_put_contents('/home/wes/www/metadata-reporter/nytimes.response', serialize($response));


        /** @var $response Response */
        $response = unserialize(file_get_contents('/home/wes/www/metadata-reporter/nytimes.response'));



        file_put_contents('/home/wes/www/metadata-reporter/nytimes.response', serialize($response));


//        $dom = new \DOMDocument('1.0');
//        $dom->formatOutput = true;
//        @$dom->loadHTML($response->getContent());
//        $dom->saveHTMLFile('/home/wes/www/metadata-reporter/nytimes.html');
//
        $content = new Crawler($response->getContent());


        $collector = new HtmlCoreAttributeCollector();
        $collector->collect($content, $response->getHeaders());




    }
} 
