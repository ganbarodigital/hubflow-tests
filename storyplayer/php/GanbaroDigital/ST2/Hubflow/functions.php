<?php

use GanbaroDigital\ST2\Hubflow\ExpectsHubflowOutput;
use GanbaroDigital\ST2\Hubflow\UsingHubflow;

/**
 * @param  string $pathToRepo
 *         the path to the git repo
 * @return ExpectsHubflow
 */
function expectsHubflow($pathToRepo)
{
    return new ExpectsHubflow($pathToRepo);
}

/**
 * @param  string $pathToRepo
 *         the path to the git repo
 * @return FromHubflow
 */
function fromHubflow($pathToRepo)
{
    return new FromHubflow($pathToRepo);
}

/**
 * @param  string $pathToRepo
 *         the path to the git repo
 * @return UsingHubflow
 */
function usingHubflow($pathToRepo)
{
    return new UsingHubflow($pathToRepo);
}

/**
 * @return ExpectsHubflowOutput
 */
function expectsHubflowOutput()
{
	return new ExpectsHubflowOutput;
}