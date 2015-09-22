<?php

use Hubflow\Templates\HubflowTest;

$story = newStoryFor("Hubflow")
         ->inGroup("Initialisation")
         ->called("Can init the test repo")
         ->basedOn(new HubflowTest);

$story->requiresStoryplayerVersion(2);

$story->addPreTestInspection(function() {
    $path = fromTestRepo()->getPathToLocalRepo();
    expectsGitRepo($path)->isGitRepo();
    expectsHubflow($path)->isNotInitialised();
});

$story->addAction(function() {
    $path = fromTestRepo()->getPathToLocalRepo();
    usingHubflow($path)->init();
});