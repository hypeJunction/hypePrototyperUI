<?php

namespace hypeJunction\Prototyper\UI;

$fields = elgg_extract('fields', $vars);

if (is_array($fields)) {
	foreach ($fields as $field) {
		if (!$field instanceof \hypeJunction\Prototyper\Field) {
			continue;
		}
		if ($field->getDataType() == 'attribute') {
			$values[$field->getShortname()] = true;
		}
	}
}

echo '<h3>' . elgg_echo('prototyper:ui:attributes') . '</h3>';
$attributes = array('title', 'description', 'access_id');

foreach ($attributes as $attr) {
	?>
	<label class="prototyper-ui-attribute-toggle">
		<?php
		echo elgg_view('input/checkbox', array(
			'name' => "attribute[$attr]",
			'value' => 1,
			'checked' => elgg_extract($attr, $values),
		)) . elgg_echo("prototyper:ui:attribute:$attr")
		?>
	</label>
	<?php
}