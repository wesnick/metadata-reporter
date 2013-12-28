<?php
/**
 * @file run.php
 */ 


require_once 'vendor/autoload.php';



$builder = new \Wesnick\MetadataReporter\ReportBuilder();

$builder->setCollectors(array(
    new \Wesnick\MetadataReporter\Collector\HtmlCoreElementCollector(),
    new \Wesnick\MetadataReporter\Collector\LinkCollector(),
    new \Wesnick\MetadataReporter\Collector\MetaTagCollector(),
));

//        $browser = new \Buzz\Browser();
//        $response = $this->browser->get("http://nytimes.com");

/** @var $response \Buzz\Message\Response */
$response = unserialize(file_get_contents('/home/wes/www/metadata-reporter/scratch/nytimes.response'));

$meta = $builder->doReport('http://localhost/test', $response->getHeaders(), $response->getContent());

$x = 'y';
