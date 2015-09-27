<?php

use Hubflow\Templates\HubflowTestWithClonedLocalRepo;

// ==================================================================
//
// When a Git repo has been freshly cloned,
//     we can run 'git hf push help',
//     and we are told to initialise Hubflow first
//
// ------------------------------------------------------------------

$story = newStoryFor("Hubflow")
         ->inGroup("Before Initialisation")
         ->called("Running `git hf push help` results in fatal error")
         ->basedOn(new HubflowTestWithClonedLocalRepo);

$story->requiresStoryplayerVersion(2);

$story->addAction(function() {
    $checkpoint = getCheckpoint();
    $result = usingTestRepo()->runCommandAndIgnoreErrors('git hf push help');
    $checkpoint->output = $result->output;
});

$story->addPostTestInspection(function() {
    // make sure we have some output to examine
    $checkpoint = getCheckpoint();
    assertsObject($checkpoint)->hasAttribute('output');

    // make sure the output is as expected
    expectsHubflowOutput()->isFatalError($checkpoint->output);
    expectsHubflowOutput()->isRequiresInitialisation($checkpoint->output);
});