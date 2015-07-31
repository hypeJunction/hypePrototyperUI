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
	<div class="prototyper-col-12">
		<div class="prototyper-ui-section-value">
			<?php
				$crop_options = array(
					'name' => 'field[__ID__][crop]',
					'value' => 1,
				);
				
				if (elgg_extract('crop', $input_vars, false)) {
					$crop_options['checked'] = true;
				}
				echo elgg_view('input/checkbox', $crop_options);
				echo '<label>' . elgg_echo('prototyper:ui:crop') . '</label>';
			?>
		</div>
	</div>
	<div class = "prototyper-col-6">
		<div class="prototyper-ui-section-value">
			<label><?php echo elgg_echo('prototyper:ui:crop_ratio_w') ?></label>
			<div class="prototyper-ui-properties">
				<?php
				echo elgg_view('input/text', array(
					'name' => 'field[__ID__][crop_ratio_w]',
					'value' => elgg_extract('crop_ratio_w', $input_vars, ''),
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
					'name' => 'field[__ID__][crop_ratio_h]',
					'value' => elgg_extract('crop_ratio_h', $input_vars, ''),
				));
				?>
			</div>
		</div>
	</div>
</div>