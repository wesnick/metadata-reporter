<?php
/**
 * @file BasicPageInfoEvaluator.php
 */

namespace Wesnick\MetadataReporter\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;
use Wesnick\MetadataReporter\Metadata\DocTitle;
use Wesnick\MetadataReporter\Metadata\MetaDatumInterface;

class BasePageInfoEvaluator extends BaseEvaluator
{

    /**
     * @var ArrayCollection
     */
    protected $metadata;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @param string $uri
     * @param \Doctrine\Common\Collections\ArrayCollection $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata)
    {
        $this->uri = $uri;
        $this->metadata = $metadata;

        $this->evaluateTitle();

        $this->evaluateDescription();

    }


    private function evaluateTitle()
    {

        $titleArray = $this->metadata->filter(function (MetaDatumInterface $m) { return $m instanceof DocTitle; });

        // Ensure 1 title
        switch ($count = count($titleArray)) {
            case 0:
                $this->reporter->error("Title is missing from the document.", "This should be considered an important oversight", $this->uri, array('base'));
                return;
            case $count > 1:
                $this->reporter->error("More than one title found", "First One Wins", $this->uri, array('base'));
                break;
        }


        /** @var $title DocTitle */
        $title = $titleArray->first();
        $this->reporter->setTitleForUri($this->uri, $title->getValue());

        $titleDesc = <<<EOF
<strong>Optimal Format</strong>
<ul>
<li>Primary Keyword - Secondary Keyword | Brand Name</li>
<li>Brand Name | Primary Keyword and Secondary Keyword</li>
</ul>
EOF;


        $this->reporter->info(sprintf("Title: %s", $title->getValue()), $titleDesc, $this->uri, array('base'), array('metadata' => array($title)));

        $lengthDesc = <<<EOF
<strong>Best Practices for Length</strong>
<p>Aim for title tags containing fewer than 70 characters. This is the limit Google displays in search results. Title
tags longer than 70 characters may be truncated in the results, or search engines may choose to display different text
from the document in place of the title tag. Recent experiments have shown that the number of characters displayed in
the search results may also vary based on—among other things—the width in pixels of each letter. 70 characters is still
a good general guideline for length, though.</p>
EOF;


        if (strlen($title->getValue()) > 70) {
            $this->reporter->warn("Title too long", $lengthDesc, $this->uri, array('base'), array('metadata' => array($title)));
        }



    }

    private function evaluateDescription()
    {
        $descriptionArray = $this->getMetaTagFor($this->metadata, 'description');

        // Ensure 1 description
        switch ($count = count($descriptionArray)) {
            case 0:
                $this->reporter->error("Description is missing from the document.", "This should be considered an important oversight", $this->uri, array('base'));
                return;
            case $count > 1:
                $this->reporter->error("More than one description is found", "You should remove the unwanted descriptions", $this->uri, array('base'));
                break;
        }

        $description = $descriptionArray->first();

        $this->reporter->info(sprintf("Description: %s", $description->getValue()), "The description is the snippet that will appear on search results page below your page title.", $this->uri, array('base'), array('metadata' => array($description)));


        $lengthDesc = <<<EOF
Meta descriptions can be any length, but search engines generally will truncate snippets longer than 160 characters.
EOF;


        if (strlen($description->getValue()) > 160) {
            $this->reporter->warn("Description is too long", $lengthDesc, $this->uri, array('base'), array('metadata' => array($description)));
        }


    }


} 
