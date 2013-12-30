<?php

namespace Wesnick\MetadataReporter;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Collector\CollectorInterface;
use Wesnick\MetadataReporter\Evaluator\EvaluatorInterface;
use Wesnick\MetadataReporter\Formatter\FormatterInterface;
use Wesnick\MetadataReporter\Reporter\Reporter;

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
     * @var Reporter
     */
    protected $reporter;

    /**
     * @var ArrayCollection
     */
    protected $metadata;

    function __construct(Reporter $reporter = null, $collectors = array(), $evaluators = array())
    {
        $this->collectors = $collectors;
        $this->evaluators = $evaluators;
        $this->metadata = new ArrayCollection();
        if ( ! $reporter instanceof Reporter) {
            $reporter = new Reporter();
        }
        $this->reporter = $reporter;
    }


    /**
     * @param CollectorInterface $collector
     */
    public function addCollector(CollectorInterface $collector)
    {
        $this->collectors[get_class($collector)] = $collector;
    }

    /**
     * @param EvaluatorInterface $evaluator
     */
    public function addEvaluator(EvaluatorInterface $evaluator)
    {
        $evaluator->setReporter($this->reporter);
        $this->evaluators[get_class($evaluator)] = $evaluator;
    }

    public function doReport($uri, $headers, $content)
    {
        $crawler = new Crawler($content, $uri);

        /** @var $collector CollectorInterface */
        foreach ($this->getCollectors() as $collector) {
            $collector->collect($uri, $crawler, $headers);
            foreach ($collector->getMetadata()->getValues() as $value) {
                $this->metadata->add($value);
            }
        }

        foreach ($this->getEvaluators() as $evaluator) {
            $evaluator->evaluate($uri, $this->metadata);
        }

    }

    /**
     * @param CollectorInterface[] $collectors
     */
    public function setCollectors(array $collectors)
    {
        $this->collectors = array();
        foreach ($collectors as $collector) {
            $this->addCollector($collector);
        }
    }

    /**
     * @param EvaluatorInterface[] $evaluators
     */
    public function setEvaluators(array $evaluators)
    {
        $this->evaluators = array();
        foreach ($evaluators as $evaluator) {
            $this->addEvaluator($evaluator);
        }
    }


    /**
     * @return CollectorInterface[]
     */
    public function getCollectors()
    {
        return $this->collectors;
    }


    /**
     * @return EvaluatorInterface[]
     */
    public function getEvaluators()
    {
        return $this->evaluators;
    }


    /**
     * @param FormatterInterface $formatter
     * @return mixed
     */
    public function format(FormatterInterface $formatter)
    {
        $formatter->setReporter($this->reporter);
        return $formatter->format();
    }


} 
