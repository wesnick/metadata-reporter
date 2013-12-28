<?php

namespace Wesnick\MetadataReporter;


use Buzz\Browser;
use Buzz\Message\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\Evaluator\EvaluatorInterface;
use Wesnick\MetadataReporter\Collector\CollectorInterface;
use Wesnick\MetadataReporter\Collector\MetaTagCollector;

class ReportBuilder
{


    /**
     * @var EvaluatorInterface[]
     */
    protected $evaluators;

    /**
     * @var CollectorInterface[]
     */
    protected $collectors;


    /**
     * @param CollectorInterface $collector
     */
    public function addCollector(CollectorInterface $collector)
    {
        $this->collectors[get_class($collector)] = $collector;
    }



    public function doReport($uri, $headers, $content)
    {

//        $this->browser = new Browser();
//        $response = $this->browser->get("http://nytimes.com");

//        file_put_contents('/home/wes/www/metadata-reporter/nytimes.response', serialize($response));


//        /** @var $response Response */
//        $response = unserialize(file_get_contents('/home/wes/www/metadata-reporter/nytimes.response'));
//
//
//
//        file_put_contents('/home/wes/www/metadata-reporter/nytimes.response', serialize($response));


//        $dom = new \DOMDocument('1.0');
//        $dom->formatOutput = true;
//        @$dom->loadHTML($response->getContent());
//        $dom->saveHTMLFile('/home/wes/www/metadata-reporter/nytimes.html');
//       $collector->collect($content, $response->getHeaders());


        $crawler = new Crawler($content);

        $metadata = new ArrayCollection();
        /** @var $collector CollectorInterface */
        foreach ($this->getCollectors() as $collector) {
            $collector->collect($uri, $crawler, $headers);
            foreach ($collector->getMetadata()->getValues() as $value) {
                $metadata->add($value);
            }
        }

        foreach ($this->getEvaluators() as $evaluator) {
            $evaluator->evaluate($uri, $metadata);
            $reports = $evaluator->getEvaluations();
        }


        return $reports;

    }

    /**
     * @param \Wesnick\MetadataReporter\Collector\CollectorInterface[] $collectors
     */
    public function setCollectors($collectors)
    {
        $this->collectors = $collectors;
    }

    /**
     * @param \Wesnick\Evaluator\EvaluatorInterface[] $evaluators
     */
    public function setEvaluators($evaluators)
    {
        $this->evaluators = $evaluators;
    }


    /**
     * @return CollectorInterface[]
     */
    public function getCollectors()
    {
        return $this->collectors;
    }


    /**
     * @return \Wesnick\Evaluator\EvaluatorInterface[]
     */
    public function getEvaluators()
    {
        return $this->evaluators;
    }


} 
