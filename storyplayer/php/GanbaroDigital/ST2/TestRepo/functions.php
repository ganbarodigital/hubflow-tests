<?php

use GanbaroDigital\ST2\TestRepo\ExpectsTestRepo;
use GanbaroDigital\ST2\TestRepo\FromTestRepo;
use GanbaroDigital\ST2\TestRepo\UsingTestRepo;

/**
 * @return ExpectsTestRepo
 */
function expectsTestRepo()
{
    return new ExpectsTestRepo();
}

/**
 * @return FromTestRepo
 */
function fromTestRepo()
{
    return new FromTestRepo();
}

/**
 * @return UsingTestRepo
 */
function usingTestRepo()
{
    return new UsingTestRepo();
}