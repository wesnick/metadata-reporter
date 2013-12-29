<?php

namespace Wesnick\MetadataReporter\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Wesnick\MetadataReporter\Formatter\SymfonyConsoleFormatter;
use Wesnick\MetadataReporter\ReportBuilder;

class MetadataReporterCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('wesnick:metadata:evaluate')
            ->setDescription('Fetch and display metadata evaluation from a given URI')
            ->addOption("uri", null, InputOption::VALUE_REQUIRED, "URI to fetch metadata from")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $uri = $input->getOption('uri');

        // @TODO: a temporary low internet usage solution
//        $browser = new \Buzz\Browser();
//        $response = $this->browser->get($uri);

        /** @var $response \Buzz\Message\Response */
        $response = unserialize(file_get_contents('/home/wes/www/metadata-reporter/scratch/nytimes.response'));


        $builder = new ReportBuilder();

        $builder->setCollectors(array(
            new \Wesnick\MetadataReporter\Collector\HtmlCoreElementCollector(),
            new \Wesnick\MetadataReporter\Collector\LinkCollector(),
            new \Wesnick\MetadataReporter\Collector\MetaTagCollector(),
        ));

        $builder->setEvaluators(array(
            new \Wesnick\MetadataReporter\Evaluator\BasicPageInfoEvaluator(),
            new \Wesnick\MetadataReporter\Evaluator\RobotsMetaEvaluator(),

        ));


        $builder->doReport('http://localhost/test', $response->getHeaders(), $response->getContent());

        $formatter = new SymfonyConsoleFormatter($output, $this->getHelperSet()->get('table'));
        $builder->format($formatter);

    }


}
