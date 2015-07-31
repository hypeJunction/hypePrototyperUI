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

<div class = "prototyper-ui-section-extras">
	<div class = "prototyper-col-6">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:min') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][min]',
					'value' => elgg_extract('min', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
	<div class = "prototyper-col-6">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:max') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][max]',
					'value' => elgg_extract('max', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
</div>