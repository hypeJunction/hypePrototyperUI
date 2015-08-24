<?php

use Exception;
use hypeJunction\Prototyper\ValidationException;
use IOException;
use Sahipleri\Domains\DomainHandler;

$guid = get_input('guid');

$container_guid = get_input('container_guid');
$container = get_entity($container_guid);
if (!$container) {
	$container = elgg_get_site_entity();
}

$entity = array(
	'guid' => $guid,
	'type' => 'object',
	'subtype' => 'prototyper_demo_object',
	'container_guid' => $container->guid,
);

try {
	$action = hypePrototyper()->action->with($entity, 'prototyper/demo/save_object');

	if ($action->validate() && ($entity = $action->update())) {

		// do some custom stuff
	}
} catch (ValidationException $ex) {
	register_error(elgg_echo('prototyper:validate:error'));
	forward(REFERER);
} catch (IOException $ex) {
	register_error(elgg_echo('prototyper:io:error', array($ex->getMessage())));
	forward(REFERER);
} catch (Exception $ex) {
	register_error(elgg_echo('prototyper:handle:error', array($ex->getMessage())));
	forward(REFERER);
}

if ($entity) {
	system_message(elgg_echo('prototyper:action:success'));
	forward("/admin/prototyper/profile");
} else {
	register_error(elgg_echo('prototyper:action:error'));
	forward(REFERER);
}

