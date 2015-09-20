<?php

namespace Beck24\ReCaptcha;

const PLUGIN_ID = 'elgg_recaptcha';
const PLUGIN_VERSION = 20150919;

require_once __DIR__ . '/lib/functions.php';
require_once __DIR__ . '/lib/hooks.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	elgg_extend_view('css/elgg', 'css/elgg_recaptcha');
	
	elgg_register_plugin_hook_handler('view', 'all', __NAMESPACE__ . '\\view_hook');
	elgg_register_plugin_hook_handler('action', 'all', __NAMESPACE__ . '\\action_hook');
	
	elgg_define_js('google_recaptcha', array(
		'src' => 'https://www.google.com/recaptcha/api.js?render=explicit&onload=elgg_recaptcha_render&hl=' . get_language()
	));
}
