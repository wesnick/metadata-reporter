<?php

namespace Wesnick\MetadataReporter\Evaluator;


use Doctrine\Common\Collections\ArrayCollection;

class AuthorshipEvaluator extends BaseEvaluator
{

    /**
     * @var ArrayCollection
     */
    private $metadata;

    /**
     * @var string
     */
    private $uri;

    /**
     * @param string $uri
     * @param ArrayCollection $metadata
     */
    public function evaluate($uri, ArrayCollection $metadata)
    {
        $this->uri = $uri;
        $this->metadata = $metadata;

        $this->evaluateAuthor();
        $this->evaluatePublisher();
    }

    private function evaluateAuthor()
    {
        $links = $this->getAnchorTagsByAttribute($this->metadata, 'rel', 'author');

        if (0 === $links->count()) {
            $this->reporter->warn("No Author Information Found.", "No authoriship information may be appropriate for pages with a lot of aggregated content", $this->uri, array('rel links'));
            return;
        }




    }

    private function evaluatePublisher()
    {
        $links = $this->getAnchorTagsByAttribute($this->metadata, 'rel', 'publisher');
        if (0 === $links->count()) {
            $this->reporter->warn("No Publisher Information Found.", "There should be publisher information included", $this->uri, array('rel links'));
            return;
        }

    }

} 
