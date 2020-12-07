<?php

/**
 * Die and dump
 *
 * @param mixed $args
 */
function dd ($args) {
	die(print_r($args));
}

/**
 * Get input from a file name
 *
 * @param string $filename
 * @return false|string
 */
function getInput (string $filename) {
	$filepath = sprintf('%s/input/%s', ROOT, $filename);

	if ( ! file_exists($filepath) ) {
		echo "Input file not found at: ".$filepath;
		exit -1;
	}
	return file_get_contents($filepath);
}