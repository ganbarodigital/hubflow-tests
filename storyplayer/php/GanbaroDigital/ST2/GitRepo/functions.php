<?php

use GanbaroDigital\ST2\GitRepo\ExpectsGitRepo;
use GanbaroDigital\ST2\GitRepo\FromGitRepo;
use GanbaroDigital\ST2\GitRepo\UsingGitRepo;

/**
 * @param  string $pathToRepo
 *         the path to the git repo
 * @return ExpectsGitRepo
 */
function expectsGitRepo($pathToRepo)
{
    return new ExpectsGitRepo($pathToRepo);
}

/**
 * @param  string $pathToRepo
 *         the path to the git repo
 * @return FromGitRepo
 */
function fromGitRepo($pathToRepo)
{
    return new FromGitRepo($pathToRepo);
}

/**
 * @param  string $pathToRepo
 *         the path to the git repo
 * @return UsingGitRepo
 */
function usingGitRepo($pathToRepo)
{
    return new UsingGitRepo($pathToRepo);
}