<?php
/**
 * @file Reporter.php
 */

namespace Wesnick\MetadataReporter\Reporter;


class Reporter implements ReporterInterface
{

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @var array
     */
    protected $data;

    function __construct($label, $description, $uri, $categories = array(), $data = array(), $level = ReporterInterface::LEVEL_INFO)
    {
        $this->label = $label;
        $this->description = $description;
        $this->uri;
        $this->level = $level;
        $this->categories = $categories;
        $this->data = $data;

    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }


} 
