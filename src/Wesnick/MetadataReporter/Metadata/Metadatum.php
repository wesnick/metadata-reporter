<?php
/**
 * @file Metadatum.php
 */

namespace Wesnick\MetadataReporter\Metadata;


class Metadatum
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var array
     */
    protected $data;

    function __construct($name, $value, $data = array())
    {
        $this->name = $name;
        $this->value = $value;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }




} 
