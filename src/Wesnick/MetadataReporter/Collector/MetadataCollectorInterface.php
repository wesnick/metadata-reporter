<?php

namespace Wesnick\MetadataReporter\Collector;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;

interface MetadataCollectorInterface
{
    /**
     * @param Crawler $content
     * @param array $headers
     */
    public function collect(Crawler $content, array $headers);

    /**
     * Return an array of names of metadata this collector collects
     *
     * @return array
     */
    public function getMetadataNames();

    /**
     * Return targeted metadata.
     *
     * @return ArrayCollection
     */
    public function getMetadata();

    /**
     * If a collector collects other types of metadata it is not targeting, it may return them here.
     *
     * @return ArrayCollection
     */
    public function getExtraMetadata();

} 
