<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration())
    ->ignoreErrorsOnPackage('composer/semver', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->ignoreUnknownClasses(['Haste\Util\Format'])
;
