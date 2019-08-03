<?php

namespace Beck24\ReCaptcha;

const PLUGIN_ID = 'elgg_recaptcha';
const PLUGIN_VERSION = 20180118;
const PLUGIN_DIR = __DIR__;

require_once PLUGIN_DIR . '/lib/functions.php';
require_once PLUGIN_DIR . '/lib/hooks.php';

if (file_exists(PLUGIN_DIR . '/vendor/autoload.php')) {
	require_once PLUGIN_DIR . '/vendor/autoload.php';
}

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	elgg_extend_view('css/elgg', 'css/elgg_recaptcha');
	
	elgg_register_plugin_hook_handler('view', 'all', __NAMESPACE__ . '\\view_hook');
	elgg_register_plugin_hook_handler('action', 'all', __NAMESPACE__ . '\\action_hook');
}

/**
 * 
 * @staticvar type $browsers
 * @return Array an array of browsers we can identify
 */
function get_browsers() {
	static $browsers;
	
	if ($browsers) {
		return $browsers;
	}
	
	$refl = new \ReflectionClass('Wolfcast\BrowserDetection');
	$constants = $refl->getConstants();
	
	$browsers = array();
	foreach ($constants as $name => $value) {
		if (strpos($name, 'BROWSER_') === 0) {
			$browsers[$name] = $value;
		}
	}
	
	asort($browsers);
	
	return $browsers;
}

/**
 * get an array of platforms we can identify
 */
function get_platforms() {
	static $platforms;
	
	if ($platforms) {
		return $platforms;
	}
	
	$refl = new \ReflectionClass('Wolfcast\BrowserDetection');
	$constants = $refl->getConstants();
	
	$platforms = array();
	foreach ($constants as $name => $value) {
		if (strpos($name, 'PLATFORM_') === 0) {
			$platforms[$name] = $value;
		}
	}
	
	asort($platforms);
	
	return $platforms;
}

/**
 * get the current users platform
 */
function get_platform($label = true) {
	$browser = new \Wolfcast\BrowserDetection();
	
	$l = $browser->getPlatform();
	
	if ($label) {
		return $l;
	}
	
	// return the machine name
	$platforms = get_platforms();
	return array_search($l, $platforms);
}

/**
 * get the current users browser
 */
function get_browser($label = true) {
	$browser = new \Wolfcast\BrowserDetection();
	
	$l = $browser->getName();
	
	if ($label) {
		return $l;
	}
	
	// return the machine name
	$browsers = get_browsers();
	return array_search($l, $browsers);
}