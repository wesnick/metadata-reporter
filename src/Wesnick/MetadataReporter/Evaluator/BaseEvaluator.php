<?php
/**
 * @file BaseEvaluator.php
 */

namespace Wesnick\MetadataReporter\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Reporter\ReporterInterface;

abstract class BaseEvaluator implements EvaluatorInterface
{

    /**
     * @var ArrayCollection
     */
    protected $reporters;

    function __construct()
    {
        $this->reporters = new ArrayCollection();
    }

    /**
     * Return evaluations/reports.
     *
     * @return ReporterInterface
     */
    public function getReporters()
    {
        return $this->reporters;
    }


}
