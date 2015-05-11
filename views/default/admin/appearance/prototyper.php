<?php

namespace hypeJunction\Prototyper\UI;

$hooks = _elgg_services()->hooks->getAllHandlers();
$prepare_hooks = elgg_extract('prepare', $hooks, array());

foreach ($prepare_hooks as $type => $handlers) {
	list($prefix, $action) = explode(':', $type);
	if ($prefix == 'form') {
		$options[] = $action;
	}
}

$action_name = get_input('action', $options[0]);

$form .= '<div>';
$form .= '<label>' . elgg_echo('prototyper:ui:action') . '</label>';
$form .= elgg_view('input/dropdown', array(
	'name' => 'action',
	'value' => $action_name,
	'options' => $options,
	'id' => '#prototyper-filter',
));
$form .= '</div>';

$form .= elgg_view('input/submit', array(
	'value' => elgg_echo('submit'),
	'class' => 'hidden',
));

echo elgg_view('input/form', array(
	'action' => current_page_url(),
	'body' => $form,
));

echo elgg_view_form('prototyper/edit', array(), array(
	'action_name' => $action_name,
));

elgg_pop_context();
