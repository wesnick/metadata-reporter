<?php
/**
 * @file RobotsMetaEvaluator.php
 */

namespace Wesnick\MetadataReporter\Evaluator;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ExpressionBuilder;
use Wesnick\MetadataReporter\Metadata\MetaDatumInterface;
use Wesnick\MetadataReporter\Reporter\Reporter;

class RobotsMetaEvaluator extends BaseEvaluator
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
     * @param ArrayCollection $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata)
    {

        $metas = $this->getRobotsMetadata($metadata);

        switch ($meta_count = count($metas)) {
            case 0:
                $this->reporters->add(new Reporter("Robots not specified in metatags", "Serach Bots will index this page", $uri, array('robots')));
                break;
            case 1:
                $this->reporters->add(new Reporter("Robots specified in metatags", "Serach Bots will index this page", $uri, array('robots'), array('metadata' => array($metas->first()))));
                break;
            case $meta_count > 1:
                $this->reporters->add(new Reporter("More than one robots directive specified in metatags", "First One Wins", $uri, array('robots'), array('metadata' => array($metas->first()))));
                break;
        }

//        $reporter = new Reporter("Robots not specified in metatags", "Serach Bots will index this page", $uri, array('robots'));
//        $this->reporters->add($reporter);

    }


    private function getRobotsMetadata(ArrayCollection $metadata)
    {
        $builder = new ExpressionBuilder();
//        $expression = $builder->contains('categories', 'robots');
        $expression = $builder->andX($builder->eq('name', 'robots'), $builder->eq('documentLocation', MetaDatumInterface::CONTENT_HEAD));
        $criteria = new Criteria($expression);
        $found = $metadata->matching($criteria);

        return $found;



    }


} 
