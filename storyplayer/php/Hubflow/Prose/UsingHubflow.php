<?php

namespace Hubflow\Prose;

class UsingHubflow
{
    protected $pathToRepo;

    public function __construct($pathToRepo)
    {
        $this->pathToRepo = $pathToRepo;
    }

    public function init()
    {
        // what are we doing?
        $log = usingLog()->startAction("{$this->pathToRepo}: git hf init");

        // do it
        usingShell()->runCommand("cd {$this->pathToRepo} && git hf init");
    }
}