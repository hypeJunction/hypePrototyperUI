<?php

use hypeJunction\Prototyper\Elements\Field;

if (!elgg_in_context('prototyper-ui')) {
	return true;
}

$field = elgg_extract('field', $vars);
if (!$field instanceof Field) {
	return true;
}

$entity = elgg_extract('entity', $vars);
$input_vars = $field->getInputVars($entity);
?>

<div class="prototyper-ui-section-extras">
	<div class="prototyper-col-6">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:time:format') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				$time = time();
				echo elgg_view('input/dropdown', array(
					'name' => 'field[__ID__][format]',
					'value' => elgg_extract('format', $input_vars),
					'options_values' => array(
						"g:ia" => date("g:ia", $time),
						"H:i" => date("H:i", $time)
					)
				));
				?>
			</div>
		</div>
	</div>
	<div class="prototyper-col-6">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:time:interval') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][interval]',
					'value' => elgg_extract('interval', $input_vars, 900),
				));
				?>
			</div>
		</div>
	</div>
</div>