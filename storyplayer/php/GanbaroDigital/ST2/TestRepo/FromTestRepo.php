<?php

namespace GanbaroDigital\ST2\TestRepo;

use GanbaroDigital\Git\Repo\Checks\IsGitRepo;
use GanbaroDigital\Git\Repo\ValueBuilders\GetGitConfig;
use Prose\E5xx_ActionFailed;

class FromTestRepo
{
    public function getGitConfig($configName)
    {
        // shorthand
        $path = fromTestRepo()->getPathToLocalRepo();

        // what are we doing?
        $log = usingLog()->startAction("get Git config '{$configName}' from path '{$path}'");

        // get the config
        $configValue = GetGitConfig::from(realpath($path), $configName);

        // all done
        $log->endAction($configValue);
        return $configValue;
    }

    public function getPathToLocalRepo()
    {
        // what are we doing?
        $log = usingLog()->startAction("get the path to the local test repo");

        // the path is stored as a setting in the storyplayer.json config file
        $path = fromStoryplayer()->get("testrepo.path");

        // all done
        $log->endAction($path);
        return $path;
    }

    public function checkLocalRepoExists()
    {
        // what are we doing?
        $log = usingLog()->startAction("does the local test repo exist?");

        // does it?
        $path = fromTestRepo()->getPathToLocalRepo();
        $retval = IsGitRepo::check($path);

        // all done
        if ($retval) {
            $log->endAction("yes");
        }
        else {
            $log->endAction("no");
        }

        return $retval;
    }
}