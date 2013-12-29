<?php
/**
 * @file ReporterInterface.php
 */

namespace Wesnick\MetadataReporter\Reporter;


interface ReporterInterface
{

    const LEVEL_INFO    = 'info';
    const LEVEL_WARNING = 'warn';
    const LEVEL_ERROR   = 'error';

    /**
     * @return string
     */
    public function getUri();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return array
     */
    public function getCategories();

    /**
     * @return int
     */
    public function getLevel();

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return array
     */
    public function getData();


} 
