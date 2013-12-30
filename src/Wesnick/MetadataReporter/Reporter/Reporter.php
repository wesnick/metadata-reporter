<?php
/**
 * @file Reporter.php
 */

namespace Wesnick\MetadataReporter\Reporter;


use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Metadata\MetaDatumInterface;

class Reporter
{

    /**
     * @var ArrayCollection
     */
    protected $reporters;

    /**
     * Key is URI and value is URI title
     * @var array
     */
    protected $uriMap;


    function __construct()
    {
        $this->reporters = new ArrayCollection();
    }

    public function info($label, $description, $uri, $categories, $data = array())
    {
        $this->report($label, $description, $uri, $categories, $data, ReportInterface::LEVEL_INFO);
    }

    public function warn($label, $description, $uri, $categories, $data = array())
    {
        $this->report($label, $description, $uri, $categories, $data, ReportInterface::LEVEL_WARNING);
    }

    public function error($label, $description, $uri, $categories, $data = array())
    {
        $this->report($label, $description, $uri, $categories, $data, ReportInterface::LEVEL_ERROR);
    }

    public function report($label, $description, $uri, $categories, $data, $level)
    {
        $this->reporters->add(new Report($label, $description, $uri, $categories, $data, $level));
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReporters()
    {
        return $this->reporters;
    }

    public function getCategories()
    {
        $categories = array();
        /** @var $report ReportInterface */
        foreach ($this->reporters->toArray() as $report) {
            foreach ($report->getCategories() as $category) {
                if ( ! array_key_exists($category, $categories)) {
                    $categories[$category] = $category;
                }
            }
        }

        return $categories;
    }

    /**
     * @param $uri
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReportersForUri($uri)
    {
        return $this->reporters->filter(function (ReportInterface $r) use ($uri) { return $r->getUri() == $uri; });
    }

    /**
     * @param $name
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReportersForCategory($name)
    {
        return $this->reporters->filter(function (ReportInterface $r) use ($name) { return in_array($name, $r->getCategories()); });
    }

    /**
     * @param $level
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReportersForLevel($level)
    {
        return $this->reporters->filter(function (ReportInterface $r) use ($level) { return $level == $r->getLevel(); });
    }


    public function setTitleForUri($uri, $title)
    {
        $this->uriMap[$uri] = $title;
    }

} 
