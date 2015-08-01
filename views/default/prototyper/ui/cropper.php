<?php
$entity = elgg_extract('entity', $vars);
$name = elgg_extract('name', $vars);

$ratio_x = elgg_extract('data-crop-ratio-w', $vars);
$ratio_y = elgg_extract('data-crop-ratio-h', $vars);

if (!$ratio_x || !$ratio_y) {
	return;
}

elgg_load_css('jquery.cropper');

if (\hypeJunction\Integration::isElggVersionBelow('1.9.0')) {
	elgg_load_js('jquery.cropper');
	elgg_load_js('prototyper_cropper');
} else {
	elgg_require_js('framework/prototyper_cropper');
}
?>
<div class="prototyper-image-upload-cropper">
<?php
echo elgg_format_element('p', array('class' => 'elgg-text-help'), elgg_echo('prototyper:ui:cropper_instructions'));
foreach (array('x1', 'y1', 'x2', 'y2') as $coord) {
	echo elgg_view('input/hidden', array(
		'name' => "image_upload_crop_coords[{$name}][{$coord}]",
		'value' => (int) $entity->$coord,
		"data-$coord" => true,
	));
}
?>
</div>

