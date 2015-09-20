<?php

namespace Beck24\ReCaptcha;

/**
 * input/recaptcha
 *
 * render a recaptcha challenge
 *
 * @uses $vars['theme'] Optional the theme to render: light | dark
 * @uses $vars['size']	Optional size of the captcha: compact | normal
 * @uses $vars['type']  Optional the type of recaptcha: image | audio
 * @uses $vars['form']  Optional the jquery selector for a form
 */


$options = array(
	'class' => 'g-recaptcha',
	'data-sitekey' => get_public_key(),
	'data-theme' => get_recaptcha_theme(),
	'data-size' => get_recaptcha_size(),
	'data-type' => get_recaptcha_type()
);

if ($vars['theme']) {
	$options['data-theme'] = $vars['theme'];
}

if ($vars['size']) {
	$options['data-size'] = $vars['size'];
}

if ($vars['type']) {
	$options['data-type'] = $vars['type'];
}

if ($vars['form']) {
	$options['data-form'] = $vars['form'];
}

$attributes = elgg_format_attributes($options);

echo "<div {$attributes}></div>";

elgg_require_js('elgg_recaptcha/render');