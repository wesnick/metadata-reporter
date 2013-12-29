<?php
/**
 * @file RobotsMetaEvaluator.php
 */

namespace Wesnick\MetadataReporter\Evaluator;

use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Reporter\ReporterInterface;

class RobotsMetaEvaluator implements EvaluatorInterface
{

    protected static $codes = array(
        'index' => 'robots are welcome to include this page in search services.',
        'follow' => 'robots are welcome to follow links from this page to find other pages.',
        'noindex' => 'Do not index this page, no prohibition on following links',
        'nofollow' => 'allows the page to be indexed, but no links from the page are explored.',
        'none' => 'ignore the page.',
        'noodp' => 'Sometimes, if you are listed in DMOZ (ODP), the search engines will display snippets of text about your site taken from them instead of your description meta tag.',
        'noydir' => 'If the search engine (in this case, Yahoo!) displays information about your site taken from the Yahoo! Directory instead of your description meta tag.',
        'noarchive' => 'Do not store cached copy of the page'
    );

    protected static $bots = array(
        'googlebot' => 'Google Bot',
        'slurp'     => 'Yahoo Bot',
        'msnbot'    => 'Bing Bot',
        'teoma'     => 'Ask',
    );

    /**
     * @param $uri
     * @param \Doctrine\Common\Collections\ArrayCollection $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata)
    {
        // TODO: Implement evaluate() method.
    }

    /**
     * Return evaluations/reports.
     *
     * @return ReporterInterface
     */
    public function getReporters()
    {
        // TODO: Implement getReporters() method.
    }


} 
