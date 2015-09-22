<?php

namespace GanbaroDigital\ST2\GitRepo;

class FromGitRepo
{
    protected $pathToRepo;

    public function __construct($pathToRepo)
    {
        $this->pathToRepo = $pathToRepo;
    }

    public function getConfig($name)
    {
        // what are we doing?
        $log = usingLog()->startAction("get config '$name' from git repo in '{$this->pathToRepo}'");

        $result = usingShell()->runCommand("cd {$this->pathToRepo} && git config --get $name");

        // all done
        $log->endAction($result->output);
        return $result->output;
    }
}