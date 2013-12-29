<?php

namespace Wesnick\MetadataReporter;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Collector\CollectorInterface;
use Wesnick\MetadataReporter\Evaluator\EvaluatorInterface;
use Wesnick\MetadataReporter\Formatter\FormatterInterface;

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
     * @var ArrayCollection
     */
    protected $reporters;

    /**
     * @param CollectorInterface $collector
     */
    public function addCollector(CollectorInterface $collector)
    {
        $this->collectors[get_class($collector)] = $collector;
    }

    public function doReport($uri, $headers, $content)
    {
        $crawler = new Crawler($content, $uri);

        $metadata = new ArrayCollection();

        /** @var $collector CollectorInterface */
        foreach ($this->getCollectors() as $collector) {
            $collector->collect($uri, $crawler, $headers);
            foreach ($collector->getMetadata()->getValues() as $value) {
                $metadata->add($value);
            }
        }

        $this->reporters = new ArrayCollection();

        foreach ($this->getEvaluators() as $evaluator) {
            $evaluator->evaluate($uri, $metadata);
            foreach ($evaluator->getReporters()->getValues() as $value) {
                $this->reporters->add($value);
            }
        }

    }

    /**
     * @param CollectorInterface[] $collectors
     */
    public function setCollectors($collectors)
    {
        $this->collectors = $collectors;
    }

    /**
     * @param EvaluatorInterface[] $evaluators
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
     * @return EvaluatorInterface[]
     */
    public function getEvaluators()
    {
        return $this->evaluators;
    }


    public function format(FormatterInterface $formatter)
    {
        $formatter->setReporters($this->reporters);
        return $formatter->format();
    }


} 
