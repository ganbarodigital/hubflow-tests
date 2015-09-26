<?php

namespace GanbaroDigital\ST2\Hubflow;

use GanbaroDigital\TextTools\Filters\FilterForMatchingString;
use Prose\E5xx_ExpectFailed;

class ExpectsHubflowOutput
{
    public function isRequiresInitialisation($output)
    {
        // what are we doing?
        $log = usingLog()->startAction("make sure that the output tells the user to initialise Hubflow first");

        // filter the output for the desired text
        $filteredText = FilterForMatchingString::against($output, 'fatal: Not a hubflow-enabled repo yet. Please run "git hf init" first.');

        if (empty($filteredText)) {
            $log->endAction("expected text not found");
            throw new E5xx_ExpectFailed(__METHOD__, "output tells the user to initialise Hubflow first", "output does not tell the user to initialise Hubflow first");
        }

        // all done
        $log->endAction();
    }
}