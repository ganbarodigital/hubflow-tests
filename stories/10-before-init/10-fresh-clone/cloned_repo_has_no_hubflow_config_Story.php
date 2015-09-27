<?php

use Hubflow\Templates\HubflowTestWithClonedLocalRepo;

// ==================================================================
//
// When a Git repo has been freshly cloned,
//     it contains no Hubflow config
//
// ------------------------------------------------------------------


$story = newStoryFor("Hubflow")
         ->inGroup(["Before Initialisation", "fresh-clone"])
         ->called("Cloned repo has no Hubflow config")
         ->basedOn(new HubflowTestWithClonedLocalRepo);

$story->requiresStoryplayerVersion(2);

$story->addAction(function() {
    // no action required
});

$story->addPostTestInspection(function() {
    $config = fromTestRepo()->getGitConfig("hubflow.branch.master");
    assertsArray($config)->isEmpty();
    $config = fromTestRepo()->getGitConfig("hubflow.branch.develop");
    assertsArray($config)->isEmpty();
});