<?php

/**
 * Prototyper UI
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 */
$path = __DIR__;
if (file_exists("{$path}vendor/autoload.php")) {
	require_once "{$path}vendor/autoload.php";
}

elgg_register_event_handler('init', 'system', 'prototyper_ui_init');

/**
 * Init
 * @return void
 */
function prototyper_ui_init() {

	elgg_extend_view('css/elgg', 'css/framework/prototyper/ui/stylesheet');
	elgg_extend_view('css/admin', 'css/framework/prototyper/ui/stylesheet');

	if (\hypeJunction\Integration::isElggVersionBelow('1.9.0')) {
		elgg_register_simplecache_view('js/framework/legacy/prototyper_ui');
		elgg_register_js('prototyper_ui', elgg_get_simplecache_url('js', 'framework/legacy/prototyper_ui'), 'footer');

		elgg_register_js('jquery.cropper', '/mod/hypePrototyperUI/vendors/jquery.cropper/cropper.min.js', 'footer');

		elgg_register_simplecache_view('js/framework/legacy/prototyper_cropper');
		elgg_register_js('prototyper_cropper', elgg_get_simplecache_url('js', 'framework/legacy/prototyper_cropper'), 'footer');
	} else {
		elgg_define_js('cropper', array(
			'src' => '/mod/hypePrototyperUI/vendors/jquery.cropper/cropper.min.js',
			'deps' => array('jquery'),
		));
	}

	elgg_register_css('jquery.cropper', '/mod/hypePrototyperUI/vendors/jquery.cropper/cropper.min.css');

	elgg_extend_view('input/file', 'prototyper/ui/cropper');

	elgg_register_admin_menu_item('develop', 'prototype', 'prototyper');
	elgg_register_admin_menu_item('develop', 'form', 'prototyper');
	elgg_register_admin_menu_item('develop', 'profile', 'prototyper');

	elgg_register_action('prototyper/demo/save_prototype', __DIR__ . '/actions/prototyper/demo/save_prototype.php', 'admin');
	elgg_register_action('prototyper/demo/save_object', __DIR__ . '/actions/prototyper/demo/save_object.php', 'admin');

	elgg_register_plugin_hook_handler('prototype', 'prototyper/demo/save_object', 'hypeprototyper_ui_register_demo_form_fields');
}

/**
 * Demo form fields
 * 
 * @param string $hook   "prototype"
 * @param string $type   "prototyper/demo/save_object"
 * @param array  $return Fields
 * @param array  $params Hook params
 * @return array
 */
function hypeprototyper_ui_register_demo_form_fields($hook, $type, $return, $params) {

	if (!is_array($return)) {
		$return = array();
	}

	$file = new ElggFile();
	$file->owner_guid = elgg_get_site_entity()->guid;
	$file->setFilename("prototypes/prototyper_demo.json");

	if (!$file->exists()) {
		return $return;
	}

	$file->open('read');
	$json = $file->grabFile();
	$file->close();

	$fields = @json_decode($json, true);

	if (!is_array($fields)) {
		return $return;
	}

	return array_merge($return, $fields);
}
