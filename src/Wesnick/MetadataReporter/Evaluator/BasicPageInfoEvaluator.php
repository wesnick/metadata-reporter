<?php
/**
 * @file BasicPageInfoEvaluator.php
 */

namespace Wesnick\MetadataReporter\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Reporter\ReporterInterface;

class BasicPageInfoEvaluator implements EvaluatorInterface
{
    const HTML_META_CHARSET                 = 'html.meta.charset.character_set';
    const HTML_META_CONTENT_TEXT            = 'html.meta.content.text' ;
    const HTML_META_HTTPEQUIV_CONTENT_TYPE  = 'html.meta.http-equiv.content-type';
    const HTML_META_HTTPEQUIV_DEFAULT_STYLE = 'html.meta.http-equiv.default-style';
    const HTML_META_HTTPEQUIV_REFRESH       = 'html.meta.http-equiv.refresh' ;
    const HTML_META_AUTHOR                  = 'html.meta.author' ;
    const HTML_META_DESCRIPTION             = 'html.meta.description'  ;
    const HTML_META_GENERATOR               = 'html.meta.generator';
    const HTML_META_KEYWORDS                = 'html.meta.keywords' ;
    const HTML_META_ROBOTS                  = 'html.meta.robots' ;
    const HTML_META_APPLICATION_NAME        = 'html.meta.application-name' ;
    const HTML_META_SCHEME                  = 'html.meta.scheme.format-uri' ;

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
