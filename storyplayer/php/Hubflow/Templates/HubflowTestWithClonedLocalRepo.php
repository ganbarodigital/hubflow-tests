<?php

namespace Hubflow\Templates;

// use Storyplayer\Stories\StoryTemplate;
use DataSift\Storyplayer\PlayerLib\StoryTemplate;

class HubflowTestWithClonedLocalRepo extends StoryTemplate
{
    public function testSetup()
    {
        usingTestRepo()->unpackLocalRepo();
        usingTestRepo()->setOrigin();
        usingTestRepo()->forcePushToGithub();
        usingTestRepo()->removeLocalRepo();
        usingTestRepo()->cloneRemoteRepo();
    }
}