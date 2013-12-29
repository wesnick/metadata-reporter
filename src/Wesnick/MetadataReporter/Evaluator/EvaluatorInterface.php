<?php
/**
 * @file EvaluatorInterface.php
 */

namespace Wesnick\MetadataReporter\Evaluator;

use Doctrine\Common\Collections\ArrayCollection;

interface EvaluatorInterface
{

    /**
     * @param $uri
     * @param ArrayCollection $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata);

    /**
     * Return evaluations/reports.
     *
     * @return ArrayCollection
     */
    public function getReporters();

} 
