<?php

namespace GanbaroDigital\ST2\TestRepo;

use GanbaroDigital\Git\Repo\Checks\IsGitRepo;
use GanbaroDigital\Git\Repo\Editors\AddRemote;
use GanbaroDigital\Git\Repo\Transfers\ForcePush;
use Prose\E5xx_ActionFailed;

class UsingTestRepo
{
    // ==================================================================
    //
    // Filesystem commands
    //
    // ------------------------------------------------------------------

    public function unpackLocalRepo()
    {
        // what are doing?
        $log = usingLog()->startAction("unpack a new copy of the test repo");

        // remove the repo if it already exists
        usingTestRepo()->removeLocalRepo();

        // where is it going?
        $path = fromTestRepo()->getPathToLocalRepo();

        // unpack the tarball
        usingShell()->runCommand("TOPDIR=`pwd` && mkdir -p $path && cd $path && tar -zxf \$TOPDIR/resources/test-repo.tgz");

        // make sure everything is there
        if (!IsGitRepo::check($path)) {
            throw new E5xx_ActionFailed(__METHOD__, "test repo has not unpacked");
        }

        $log->endAction();
    }

    public function removeLocalRepo()
    {
        // what are we doing?
        $log = usingLog()->startAction("remove the local copy of the test repo");

        // do we have a local repo to remove?
        if (!fromTestRepo()->checkLocalRepoExists()) {
            // nothing to do
            $log->endAction("no local test repo found");
            return;
        }

        // remove the local copy
        $path = fromTestRepo()->getPathToLocalRepo();
        usingShell()->runCommand("rm -rf {$path}");

        // all done
        $log->endAction("removed");
    }

    public function cloneRemoteRepo()
    {
        // where is origin pointing?
        $origin = fromStoryplayer()->get("testrepo.origin");

        // what are doing?
        $log = usingLog()->startAction("clone test repo from '{$origin}'");

        // remove the repo if it already exists
        usingTestRepo()->removeLocalRepo();

        // where is it going?
        $path = fromTestRepo()->getPathToLocalRepo();

        // create our target and clone into it
        usingSHell()->runCommand("mkdir -p $path");
        usingShell()->runCommand("cd $path && git clone '{$origin}' .");

        // make sure everything is there
        if (!IsGitRepo::check($path)) {
            throw new E5xx_ActionFailed(__METHOD__, "test repo has not cloned");
        }

        $log->endAction();
    }

    // ==================================================================
    //
    // Github commands
    //
    // ------------------------------------------------------------------

    public function setOrigin()
    {
        // what are we doing?
        $log = usingLog()->startAction("set 'origin' in the local test repo");

        // where is origin pointing?
        $origin = fromStoryplayer()->get("testrepo.origin");

        // set it
        $path = realpath(fromTestRepo()->getPathToLocalRepo());
        AddRemote::to($path, 'origin', $origin);

        // all done
        $log->endAction();
    }

    public function forcePushToGithub()
    {
        // what are we doing?
        $log = usingLog()->startAction("force push the test repo up to Github");

        // push it
        $path = realpath(fromTestRepo()->getPathToLocalRepo());
        ForcePush::to($path, 'origin');

        // all done
        $log->endAction();
    }

    // ==================================================================
    //
    // Helpers
    //
    // ------------------------------------------------------------------

    public function runCommand($command)
    {
        // what are we doing?
        $log = usingLog()->startAction("run command '{$command}' in local Git repo");

        // where is the git repo?
        $path = realpath(fromTestRepo()->getPathToLocalRepo());

        // run it
        $result = usingShell()->runCommand("cd {$path} && {$command}");

        // all done
        $log->endAction();
        return $result;
    }

    public function runCommandAndIgnoreErrors($command)
    {
        // what are we doing?
        $log = usingLog()->startAction("run command '{$command}' in local Git repo");

        // where is the git repo?
        $path = realpath(fromTestRepo()->getPathToLocalRepo());

        // run it
        $result = usingShell()->runCommandAndIgnoreErrors("cd {$path} && {$command}");

        // all done
        $log->endAction();
        return $result;
    }
}