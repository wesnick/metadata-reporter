<?php
/**
 * @file Reporter.php
 */

namespace Wesnick\MetadataReporter\Reporter;


class Reporter implements ReporterInterface
{

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

    function __construct($label, $description, $level = ReporterInterface::LEVEL_INFO, $categories = array(), $data = array())
    {
        $this->label = $label;
        $this->description = $description;
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


} 
