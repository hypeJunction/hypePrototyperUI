<?php

/**
 * Prototyper UI
 *
 * @package hypeJunction
 * @subpackage Prototyper\UI
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 */

namespace hypeJunction\Prototyper\UI;

const PLUGIN_ID = 'hypePrototyper';
const PAGEHANDLER = 'prototyper';

require_once __DIR__ . '/vendors/autoload.php';

require_once __DIR__ . '/lib/functions.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	
	elgg_extend_view('css/elgg', 'css/framework/prototyper/ui/stylesheet.css');

	register_template('metadata', 'hidden', array(
		'required' => false,
		'access' => false,
		'multiple' => false,
		'label' => false,
		'help' => false,
	));

	register_template('metadata', 'text');
	register_template('metadata', 'plaintext');
	register_template('metadata', 'longtext');
	register_template('metadata', 'dropdown', array(
		'optionsvalues' => true,
	));
	register_template('metadata', 'checkboxes', array(
		'multiple' => false,
		'optionsvalues' => true,
	));

	register_template('annotation', 'stars');

	register_template('relationship', 'userpicker', array(
		'relationship' => true,
	));
	register_template('relationship', 'friendspicker', array(
		'relationship' => true,
	));

	register_template('icon', 'file');
}
