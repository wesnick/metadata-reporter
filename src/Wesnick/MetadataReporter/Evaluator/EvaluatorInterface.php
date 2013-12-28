<?php
/**
 * @file EvaluatorInterface.php
 */

namespace Wesnick\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;

interface EvaluatorInterface
{

    /**
     * @param $uri
     * @param \Doctrine\Common\Collections\ArrayCollection $metadata
     * @return
     */
    public function evaluate($uri, ArrayCollection $metadata);

    /**
     * Return metadata.
     *
     * @return ArrayCollection
     */
    public function getEvaluations();

} 
