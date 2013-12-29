<?php
/**
 * @file EvaluatorInterface.php
 */

namespace Wesnick\MetadataReporter\Evaluator;

use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Reporter\ReporterInterface;

interface EvaluatorInterface
{

    /**
     * @param $uri
     * @param \Doctrine\Common\Collections\ArrayCollection $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata);

    /**
     * Return evaluations/reports.
     *
     * @return ReporterInterface
     */
    public function getReporters();

} 
