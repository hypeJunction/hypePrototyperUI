<?php

namespace hypeJunction\Prototyper\UI;

use hypeJunction\Prototyper\Field;
use hypeJunction\Prototyper\Prototype;

elgg_require_js('framework/prototyper_ui');

elgg_push_context('prototyper-ui');

$action = elgg_extract('action', $vars, '');
$attributes = elgg_extract('attributes', $vars, array());
$params = elgg_extract('params', $vars, array());

$prototype = new Prototype(null, $attributes, $params);
$form = $prototype->form($action);
$fields = $form->getFields();

?>
<div class="prototyper-ui-dashboard prototyper-row">
	<div class="prototyper-col-3">
		<div class="prototyper-ui-attribute-fields">
			<?php
			echo elgg_view('forms/prototyper/attributes', array(
				'fields' => $fields
			));
			?>
		</div>
		<div class="prototyper-ui-dashboard-source">
			<?php
			$templates = Template::getTemplates();
			foreach ($templates as $dt => $dt_options) {
				echo '<h3>' . elgg_echo("prototyper:ui:$dt") . '</h3>';
				foreach ($dt_options as $it => $it_options) {
					echo elgg_format_element('h4', array(
						'class' => 'prototyper-ui-add',
						'data-dt' => $dt,
						'data-it' => $it,
							), elgg_echo("prototyper:ui:$it"));

					$shortname = "prototyper_$dt_$it";
					$field = $form->addField($shortname, array(
						'type' => $it,
						'data_type' => $dt,
					));
					if (!$field instanceof Field) {
						continue;
					}
					echo elgg_format_element('div', array(
						'class' => 'prototyper-ui-template',
						'data-dt' => $dt,
						'data-it' => $it,
							), elgg_view('forms/prototyper/template', array('field' => $field)));
				}
			}
			?>
		</div>
	</div>
	<div class="prototyper-col-9">
		<div class="prototyper-ui-dashboard-target">
			<?php
			foreach ($fields as $field) {
				if (!$field instanceof Field) {
					continue;
				}
				$dt = $field->getDataType();
				$it = $field->getType();
				if (!isset($templates[$dt][$it])) {
					continue;
				}
				echo elgg_format_element('div', array(
					'class' => 'prototyper-ui-field',
						), elgg_view('forms/prototyper/template', array('field' => $field)));
			}
			?>
		</div>
		<div class="elgg-foot text-right">
			<?php
			echo elgg_view('input/submit', array(
				'value' => elgg_echo('save')
			));
			?>
		</div>
	</div>
</div>
<?php

foreach ($attributes as $key => $value) {
	echo elgg_view('input/hidden', array(
		'name' => $key,
		'value' => $value
	));
}

foreach ($params as $key => $value) {
	echo elgg_view('input/hidden', array(
		'name' => $key,
		'value' => $value
	));
}

elgg_pop_context();
