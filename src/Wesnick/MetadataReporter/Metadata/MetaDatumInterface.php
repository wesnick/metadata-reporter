<?php

namespace Wesnick\MetadataReporter\Metadata;


interface MetaDatumInterface
{

    const HEADERS       = 'headers';
    const CONTENT_HEAD  = 'content_head';
    const CONTENT_BODY  = 'content_body';

    public function getValue();
    public function getName();
    public function getDocumentLocation();


} 
