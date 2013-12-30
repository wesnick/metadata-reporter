<?php

namespace Wesnick\MetadataReporter\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
            ->addArgument("uri", InputArgument::REQUIRED, "URI to fetch metadata from")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $uri = $input->getArgument('uri');

        $browser = new \Buzz\Browser();
        $response = $browser->get($uri);

        $builder = new ReportBuilder();

        $builder->setCollectors(array(
            new \Wesnick\MetadataReporter\Collector\HtmlCoreElementCollector(),
            new \Wesnick\MetadataReporter\Collector\LinkCollector(),
            new \Wesnick\MetadataReporter\Collector\MetaTagCollector(),
        ));

        $builder->setEvaluators(array(
            new \Wesnick\MetadataReporter\Evaluator\BasePageInfoEvaluator(),
            new \Wesnick\MetadataReporter\Evaluator\RobotsMetaEvaluator(),
            new \Wesnick\MetadataReporter\Evaluator\AuthorshipEvaluator()

        ));


        $builder->doReport($uri, $response->getHeaders(), $response->getContent());

        $formatter = new SymfonyConsoleFormatter($output, $this->getHelperSet()->get('table'));
        $builder->format($formatter);

    }


}
