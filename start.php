<?php

/**
 * Prototyper UI
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 */

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

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
	}

}
