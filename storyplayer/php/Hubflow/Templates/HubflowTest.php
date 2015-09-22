<?php

namespace Hubflow\Templates;

// use Storyplayer\Stories\StoryTemplate;
use DataSift\Storyplayer\PlayerLib\StoryTemplate;

class HubflowTest extends StoryTemplate
{
    public function testSetup()
    {
        usingTestRepo()->unpackLocalRepo();
        usingTestRepo()->setOrigin();
        usingTestRepo()->forcePushToGithub();
    }
}