<?php
/**
 * @file SymfonyConsoleFormatter.php
 */

namespace Wesnick\MetadataReporter\Formatter;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyConsoleFormatter implements FormatterInterface
{

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var TableHelper
     */
    protected $table;

    /**
     * @var ArrayCollection
     */
    protected $reporters;


    function __construct(OutputInterface $output, TableHelper $table)
    {
        $this->output = $output;
        $this->table = $table;
    }

    public function setReporters(ArrayCollection $reporters)
    {
        $this->reporters = $reporters;
    }

    public function format()
    {
        $this->output->writeln("Done doing symfony");

    }


} 
