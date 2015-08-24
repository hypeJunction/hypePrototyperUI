<?php

$entities = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'prototyper_demo_object',
	'limit' => 1,
));

if ($entities) {
	$entity = $entities[0];
} else {
	$entity = array(
		'type' => 'object',
		'subtype' => 'prototyper_demo_object',
		'access_id' => ACCESS_PRIVATE,
	);
}

echo hypePrototyper()->form->with($entity, 'prototyper/demo/save_object')->view();

