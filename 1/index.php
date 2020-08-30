<?php
include 'phar://' . dirname(__FILE__) . '/leadrock-integration.phar/vendor/autoload.php';
$integration = new \Leadrock\Layouts\PreLanding();
$integration
    ->findTrackIn('track_id')
    ->setWebmasterLinkFromParam('track_url')
;
include 'prelanding.html';
$integration->end();