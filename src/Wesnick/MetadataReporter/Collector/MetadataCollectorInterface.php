<?php
/**
 * @file MetadataCollectorInterface.php
 */

namespace Wesnick\MetadataReporter\Collector;


use Symfony\Component\DomCrawler\Crawler;
use Wesnick\MetadataReporter\Metadata\Metadatum;

interface MetadataCollectorInterface
{
    /**
     * @param Crawler $content
     * @param array $headers
     * @return Metadatum[]
     */
    public function collect(Crawler $content, array $headers);

    /**
     * Return an array of names of metadata this collector collects
     *
     * @return array
     */
    public function getTargetNames();

} 
