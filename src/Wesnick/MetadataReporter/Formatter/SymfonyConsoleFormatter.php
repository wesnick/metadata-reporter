<?php
/**
 * @file SymfonyConsoleFormatter.php
 */

namespace Wesnick\MetadataReporter\Formatter;


use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Wesnick\MetadataReporter\Reporter\Reporter;
use Wesnick\MetadataReporter\Reporter\ReportInterface;

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
     * @var Reporter
     */
    protected $reporter;


    function __construct(OutputInterface $output, TableHelper $table)
    {
        $this->output = $output;
        $this->table = $table;
    }

    public function setReporter(Reporter $reporter)
    {
        $this->reporter = $reporter;
    }

    public function format()
    {

        $rows = array();

        foreach ($this->reporter->getCategories() as $category) {

            $reporters = $this->reporter->getReportersForCategory($category);

            /** @var $reporter ReportInterface */
            foreach ($reporters as $reporter) {
                $rows[] = array(
                    $category,
                    $reporter->getLabel(),
                    $reporter->getDescription(),
                    $reporter->getLevel(),
                    $reporter->getUri(),
                );
            }

        }

        $this->table
            ->setHeaders(array('Category', 'Label', 'Description', 'Level', 'URI'))
            ->setRows($rows)
        ;
        $this->table->render($this->output);

    }


} 
