<?php
/**
 * @file FormatterInterface.php
 */

namespace Wesnick\MetadataReporter\Formatter;


use Doctrine\Common\Collections\ArrayCollection;

interface FormatterInterface
{

    public function setReporters(ArrayCollection $reporters);
    public function format();

} 
