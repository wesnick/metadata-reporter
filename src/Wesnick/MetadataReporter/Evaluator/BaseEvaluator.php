<?php
/**
 * @file BaseEvaluator.php
 */

namespace Wesnick\MetadataReporter\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Metadata\LinkElement;
use Wesnick\MetadataReporter\Metadata\MetaDatumInterface;
use Wesnick\MetadataReporter\Metadata\MetaTag;
use Wesnick\MetadataReporter\Reporter\Reporter;

abstract class BaseEvaluator implements EvaluatorInterface
{
    /**
     * @var Reporter
     */
    protected $reporter;

    /**
     * @param Reporter $reporter
     */
    public function setReporter(Reporter $reporter)
    {
        $this->reporter = $reporter;
    }

    /**
     * @param ArrayCollection $metadata
     * @param $target
     * @return ArrayCollection
     */
    protected function getMetaTagFor(ArrayCollection $metadata, $target)
    {
        $filter = function (MetaDatumInterface $m) use ($target) { return ($m instanceof MetaTag && $m->getName() == $target); };
        return $metadata->filter($filter);
    }

    protected function getAnchorTagsByAttribute(ArrayCollection $metadata, $attrName, $attrValue)
    {
        $attrGetter = 'get' . ucfirst($attrName);

        $filter = function (MetaDatumInterface $m) use ($attrGetter, $attrValue) { return $m instanceof LinkElement && call_user_func(array($m, $attrGetter)) == $attrValue; };
        return $metadata->filter($filter);

    }

}
