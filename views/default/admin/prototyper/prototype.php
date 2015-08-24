<?php

$container = elgg_get_site_entity();

echo elgg_view_form('prototyper/edit', array(
	'action' => 'action/prototyper/demo/save_prototype',
), array(
	'action' => 'prototyper/demo/save_object',
	'attributes' => array(
		'type' => 'object',
		'subtype' => 'prototyper_demo_object',
		'access_id' => ACCESS_PRIVATE,
		'container_guid' => elgg_get_site_entity()->guid,
	),
	'params' => array(
		'custom_parameter' => 'some_parameter',
	)
));
