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
}
