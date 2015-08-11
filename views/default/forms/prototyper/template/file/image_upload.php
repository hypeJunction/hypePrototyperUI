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

$icon_sizes = (array) elgg_extract('data-icon-sizes', $input_vars, array());
$icon_sizes[] = array(); // add an empty form
$system_icon_sizes = array_keys((array) elgg_get_config('icon_sizes'));

?>

<div class = "prototyper-ui-section-extras">
	<div class="prototyper-col-12">
		<label><?php echo elgg_echo('prototyper:ui:icon_sizes') ?></label>
		<div class="elgg-text-help"><?php echo elgg_echo('prototyper:ui:icon_sizes:help', array(implode(', ', $system_icon_sizes))) ?></div>
		<label class="prototyper-row">
			<div class="prototyper-col-2">&nbsp;</div>
			<div class="prototyper-col-4"><?php echo elgg_echo('prototyper:ui:icon_sizes:name') ?></div>
			<div class="prototyper-col-3"><?php echo elgg_echo('prototyper:ui:icon_sizes:w') ?></div>
			<div class="prototyper-col-3"><?php echo elgg_echo('prototyper:ui:icon_sizes:h') ?></div>
		</label>
		<div class="prototyper-ui-properties">
			<?php
			foreach ($icon_sizes as $icon_size) {
				?>
				<div class="prototyper-row prototyper-ui-options-item">
					<div class="prototyper-col-2">
						<?php
						echo elgg_view('output/url', array(
							'class' => 'prototyper-ui-options-add',
							'text' => elgg_view_icon('prototyper-ui-add'),
							'href' => '#'
						));
						echo elgg_view('output/url', array(
							'class' => 'prototyper-ui-options-remove',
							'text' => elgg_view_icon('prototyper-ui-remove'),
							'href' => '#'
						));
						?>
					</div>
					<div class="prototyper-col-4">
						<?php
						echo elgg_view('input/text', array(
							'name' => 'field[__ID__][data-icon-sizes][name][]',
							'value' => elgg_extract('name', $icon_size, ''),
						));
						?>
					</div>
					<div class="prototyper-col-3">
						<?php
						echo elgg_view('input/text', array(
							'name' => "field[__ID__][data-icon-sizes][w][]",
							'value' => elgg_extract('w', $icon_size, ''),
						));
						?>
					</div>
					<div class="prototyper-col-3">
						<?php
						echo elgg_view('input/text', array(
							'name' => "field[__ID__][data-icon-sizes][h][]",
							'value' => elgg_extract('h', $icon_size, ''),
						));
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>