<?php

namespace GanbaroDigital\ST2\GitRepo;

class UsingGitRepo
{
    protected $pathToRepo;

    public function __construct($pathToRepo)
    {
        $this->pathToRepo = $pathToRepo;
    }
}