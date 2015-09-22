<?php

use GanbaroDigital\TextTools\Filters\FilterForMatchingString;
use Hubflow\Templates\HubflowTestWithClonedLocalRepo;


// ==================================================================
//
// When a Git repo has been freshly cloned,
//     we can run 'git hf feature help'
//
// NOTES:
// - we are not proving that the help command provides the expected output
//   (there will be other tests for that)
// ------------------------------------------------------------------


$story = newStoryFor("Hubflow")
         ->inGroup("Before Initialisation")
         ->called("Can run `git hf feature help`")
         ->basedOn(new HubflowTestWithClonedLocalRepo);

$story->requiresStoryplayerVersion(2);

$story->addAction(function() {
    $checkpoint = getCheckpoint();
    $result = usingTestRepo()->runCommand('git hf feature help');
    $checkpoint->output = $result->output;
});

$story->addPostTestInspection(function() {
    // make sure we have some output to examine
    $checkpoint = getCheckpoint();
    assertsObject($checkpoint)->hasAttribute('output');

    // make sure there is NO fatal error message
    $output = FilterForMatchingString::against(explode(PHP_EOL, $checkpoint->output), 'fatal: Not a hubflow-enabled repo yet.');
    assertsArray($output)->isEmpty();

    // make sure the message tells the user how to run the command
    $output = FilterForMatchingString::against(explode(PHP_EOL, $checkpoint->output), 'usage:');
    assertsArray($output)->isNotEmpty();

});