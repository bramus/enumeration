<?php

$finder = PhpCsFixer\Finder::create()
	->exclude('node_modules')
	->exclude('vendor')
	->exclude('logs')
	->exclude('cache')
	->in(__DIR__);

return PhpCsFixer\Config::create()
	->setRules([
		'@PhpCsFixer' => true,
		'@Symfony' => true,
		'concat_space' => [ 'spacing' => 'one' ],
		'ternary_to_null_coalescing' => true,
		'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
	])
	->setIndent("\t")
	->setFinder($finder);
