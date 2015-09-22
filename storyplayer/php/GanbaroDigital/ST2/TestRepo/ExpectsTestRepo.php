<?php

namespace GanbaroDigital\ST2\TestRepo;

use GanbaroDigital\Filesystem\Checks\IsFolder;
use Prose\E5xx_ExpectFailed;

class ExpectsTestRepo
{
    public function existsLocally()
    {
        // what are we doing?
        $log = usingLog()->startAction("make sure the local test repo exists");

        if (!fromTestRepo()->checkLocalRepoExists()) {
            throw new E5xx_ExpectFailed(__METHOD__, "test repo exists", "test repo does not exist");
        }

        // all done
        $log->endAction();
    }
}