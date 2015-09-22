<?php

namespace GanbaroDigital\ST2\GitRepo;

use GanbaroDigital\Git\Repo\Checks\IsGitRepo;
use Prose\E5xx_ExpectFailed;

class ExpectsGitRepo
{
    protected $pathToRepo;

    public function __construct($pathToRepo)
    {
        $this->pathToRepo = $pathToRepo;
    }

    public function hasConfig($name)
    {
        // what are we doing?
        $log = usingLog()->startAction("make sure that git repo '{$this->pathToRepo}' has config item '{$name}' set");

        $config = fromGitRepo($this->pathToRepo)->getConfig($name);
        if (empty($config)) {
            $log->endAction("config not found");
            throw new E5xx_ExpectFailed(__METHOD__, "config '{$name}' set", "config '{$name}' not set");
        }

        // all done
        $log->endAction();
    }

    public function isGitRepo()
    {
        // what are we doing?
        $log = usingLog()->startAction("make sure that '{$this->pathToRepo}' is a valid Git repo");

        if (!IsGitRepo::check($this->pathToRepo)) {
            $log->endAction("folder '{$this->pathToRepo}' not found or not a Git repo :(");
            throw new E5xx_ExpectFailed(__METHOD__, "folder '{$this->pathToRepo}' is a Git repo", "folder '{$this->pathToRepo}' not found or not a Git repo");
        }

        // if we get here, it's now time to ask git to confirm things
        $result = usingShell()->runCommandAndIgnoreErrors("cd '{$this->pathToRepo}' && git status");
    }
}