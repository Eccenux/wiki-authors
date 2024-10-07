<?php
// die when not in CLI
if (php_sapi_name() != "cli") {
    echo "Not in cli-mode";
}

// Lib under test
require_once './lib/TitleParser.php';

// Helper function to run a single test
function runTest($testName, $expected, $actual)
{
	$ok = 0;
	echo "Test result: ";
	if ($expected === $actual) {
		$ok = 1;
		echo "PASSED ($testName)";
	} else {
		echo "FAILED ($testName)";
		echo "\n  Expected: ". var_export($expected, true);
		echo "\n    Actual: ". var_export($actual, true);
	}
	echo "\n";
	return $ok;
}

// Initialize the TitleParser
$titleParser = new TitleParser();

// Test cases
$testCases = [
	// Test canonical English namespace
	[
		'input' => 'Talk:SamplePage',
		'expected' => ['namespace' => 1, 'title' => 'SamplePage'],
		'description' => 'Canonical namespace (English)'
	],
	// Test Polish namespace
	[
		'input' => 'Dyskusja:Przykład',
		'expected' => ['namespace' => 1, 'title' => 'Przykład'],
		'description' => 'Polish namespace'
	],
	// Test another canonical English namespace
	[
		'input' => 'User:ExampleUser',
		'expected' => ['namespace' => 2, 'title' => 'ExampleUser'],
		'description' => 'Canonical User namespace (English)'
	],
	// Test Polish user namespace
	[
		'input' => 'Wikipedysta:JanKowalski',
		'expected' => ['namespace' => 2, 'title' => 'JanKowalski'],
		'description' => 'Polish User namespace'
	],
	// Test template in Polish
	[
		'input' => 'Szablon:TestowySzablon',
		'expected' => ['namespace' => 10, 'title' => 'TestowySzablon'],
		'description' => 'Polish Template namespace'
	],
	// Test canonical Template namespace
	[
		'input' => 'Template:ExampleTemplate',
		'expected' => ['namespace' => 10, 'title' => 'ExampleTemplate'],
		'description' => 'Canonical Template namespace (English)'
	],
	// Test an invalid input (no namespace)
	[
		'input' => 'SamplePage',
		'expected' => 'SamplePage',
		'description' => 'Invalid format (no namespace)'
	],
	// Test an unknown namespace
	[
		'input' => 'UnknownNamespace:ExamplePage',
		'expected' => 'UnknownNamespace:ExamplePage',
		'description' => 'Unknown namespace'
	],
];

// Run the tests
$ok = 0;
$total = 0;
foreach ($testCases as $testCase) {
	$actual = $titleParser->parseNamespaceAndTitle($testCase['input']);
	$ok += runTest($testCase['description'], $testCase['expected'], $actual);
	$total++;
}
echo "\nTested: $total, ok: $ok";
echo "; " . ($total == $ok ? 'AllCool' : 'ERRORS FOUND');
echo "\n";