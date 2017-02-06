<?php

// Debug from console
// set XDEBUG_CONFIG="idekey=netbeans-xdebug"
// php test.php

require_once __DIR__ . '/../vendor/autoload.php';

$phpunit = new PHPUnit_TextUI_TestRunner;

try {
    echo "<pre>\n";
    $testResults = $phpunit->doRun($phpunit->getTest(__DIR__, '', 'Test.php'), array(), false);
    echo "</pre>\n";
} catch (PHPUnit_Framework_Exception $e) {
    print $e->getMessage() . "\n";
    echo "Unit tests failed.";
}