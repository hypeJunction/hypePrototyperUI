<?php

$entities = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'prototyper_demo_object',
	'limit' => 1,
));

if (!$entities) {
	return;
}

echo hypePrototyper()->profile->with($entities[0], 'prototyper/demo/save_object')->view();