<?php
/**
 * @file FormatterInterface.php
 */

namespace Wesnick\MetadataReporter\Formatter;


use Wesnick\MetadataReporter\Reporter\Reporter;

interface FormatterInterface
{

    public function setReporter(Reporter $reporters);
    public function format();

} 
