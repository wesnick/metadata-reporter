<?php
/**
 * @file DocTitle.php
 */

namespace Wesnick\MetadataReporter\Metadata;


class DocTitle implements MetaDatumInterface
{

    protected $title;

    function __construct($title)
    {
        $this->title = $title;
    }

    public function getValue()
    {
       return $this->title;
    }

    public function getName()
    {
        return 'title';
    }

    public function getDocumentLocation()
    {
        return MetaDatumInterface::CONTENT_HEAD;
    }


} 
