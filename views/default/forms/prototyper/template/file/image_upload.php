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
			<label><?php echo elgg_echo('prototyper:ui:crop_ratio_w') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][data-crop-ratio-w]',
					'value' => elgg_extract('data-crop-ratio-w', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
	<div class = "prototyper-col-6">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:crop_ratio_h') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][data-crop-ratio-h]',
					'value' => elgg_extract('data-crop-ratio-h', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
	<div class = "prototyper-col-4">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:cropped_icon_large') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][data-crop-large-w]',
					'value' => elgg_extract('data-crop-large-w', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
	<div class = "prototyper-col-4">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:cropped_icon_medium') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][data-crop-medium-w]',
					'value' => elgg_extract('data-crop-medium-w', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
	<div class = "prototyper-col-4">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:cropped_icon_small') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][data-crop-small-w]',
					'value' => elgg_extract('data-crop-small-w', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
</div>