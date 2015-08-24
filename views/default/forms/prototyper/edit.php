<?php
if (\hypeJunction\Integration::isElggVersionBelow('1.9.0')) {
	elgg_load_js('prototyper_ui');
} else {
	elgg_require_js('framework/prototyper_ui');
}

elgg_push_context('prototyper-ui');

$action = elgg_extract('action', $vars, '');
$attributes = elgg_extract('attributes', $vars, array());
$params = elgg_extract('params', $vars, array());

$templates = hypePrototyper()->ui->getTemplates();
$entity = hypePrototyper()->entityFactory->build($attributes);

$fields = hypePrototyper()->prototype->fields($entity, $action, $params);

?>
<div class="prototyper-ui-dashboard prototyper-row">
	<div class="prototyper-col-3">
		<div class="prototyper-ui-dashboard-source">
			<?php
			foreach ($templates as $dt => $dt_options) {
				echo '<h3>' . elgg_echo("prototyper:ui:$dt") . '</h3>';
				foreach ($dt_options as $it => $it_options) {
					echo elgg_format_element('h4', array(
						'class' => 'prototyper-ui-add',
						'data-dt' => $dt,
						'data-it' => $it,
							), elgg_echo("prototyper:ui:$it"));

					if (empty($it_options['shortname'])) {
						$it_options['shortname'] = "prototyper_$dt_$it";
					}
					$field = hypePrototyper()->fieldFactory->build($it_options);

					if (!$field instanceof \hypeJunction\Prototyper\Elements\Field) {
						continue;
					}
					echo elgg_format_element('div', array(
						'class' => 'prototyper-ui-template',
						'data-dt' => $dt,
						'data-it' => $it,
							), elgg_view('forms/prototyper/template', array(
						'field' => $field,
						'entity' => $entity,
							))
					);
				}
			}
			?>
		</div>
	</div>
	<div class="prototyper-col-9">
		<div class="prototyper-ui-dashboard-target">
			<?php
			foreach ($fields as $field) {
				if (!$field instanceof \hypeJunction\Prototyper\Elements\Field) {
					continue;
				}

				$dt = $field->getDataType();
				$it = $field->getType();
				if (!isset($templates[$dt][$it])) {
					continue;
				}
				echo elgg_format_element('div', array(
					'class' => 'prototyper-ui-field',
						), elgg_view('forms/prototyper/template', array(
					'field' => $field,
					'entity' => $entity,
				)));
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
	if (is_array($value)) {
		foreach ($value as $val) {
			echo elgg_view('input/hidden', array(
				'name' => "{$key}[]",
				'value' => $val
			));
		}
	} else {
		echo elgg_view('input/hidden', array(
			'name' => $key,
			'value' => $value
		));
	}
}

elgg_pop_context();
