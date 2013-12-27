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


} 
