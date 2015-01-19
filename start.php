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
	register_template('metadata', 'select', array(
		'optionsvalues' => true,
	));
	register_template('metadata', 'checkboxes', array(
		'multiple' => false,
		'optionsvalues' => true,
	));
	register_template('metadata', 'radio', array(
		'multiple' => false,
		'optionsvalues' => true,
	));
	register_template('metadata', 'tags', array(
		'multiple' => false,
	));
	register_template('metadata', 'date');
	register_template('metadata', 'email');
	register_template('metadata', 'url');

	register_template('annotation', 'stars');

	register_template('relationship', 'userpicker', array(
		'access' => false,
		'multiple' => false,
		'relationship' => true,
	));
	register_template('relationship', 'friendspicker', array(
		'access' => false,
		'multiple' => false,
		'relationship' => true,
	));
	register_template('category', 'category', array(
		'access' => false,
		'multiple' => true,
	));
	register_template('icon', 'file', array(
		'access' => false,
		'multiple' => false,
	));
}
