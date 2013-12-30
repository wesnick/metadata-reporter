<?php

namespace Wesnick\MetadataReporter\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Reporter\Reporter;

interface EvaluatorInterface
{

    public function setReporter(Reporter $reporter);

    /**
     * @param string            $uri
     * @param ArrayCollection   $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata);

} 
