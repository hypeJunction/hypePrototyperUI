<?php

use hypeJunction\Prototyper\Elements\Field;

if (!elgg_in_context('prototyper-ui')) {
	return;
}

$field = elgg_extract('field', $vars);
$entity = elgg_extract('entity', $vars);

if (!$field instanceof Field) {
	return true;
}

$language = hypePrototyper()->config->get('default_language', 'en');

$options = array(
	'class' => 'prototyper-ui-template',
	'data-dt' => $dt,
	'data-it' => $it,
);

$type = $field->getType();
$data_type = $field->getDataType();

$template = hypePrototyper()->ui->getTemplate($data_type, $type);
foreach ($template as $key => $val) {
	$options["data-$key"] = $val;
}
$options['data-it'] = $type;
$options['data-dt'] = $data_type;
$attrs = elgg_format_attributes($options);

$shortname = $field->getShortname();
$value_type = $field->getValueType();

$required = $field->isRequired();
$admin_only = $field->isAdminOnly();
$hide_on_profile = $field->isHiddenOnProfile();
$show_access = $field->hasAccessInput();
$multiple = $field->isMultiple();

$label = $field->getLabel();
$help = $field->getHelp();

$input_vars = $field->getInputVars($entity);
?>

<section class="prototyper-ui-options" <?php echo $attrs ?>>
	<div class="prototyper-ui-template-form prototyper-row">
		<div class="prototyper-ui-template-head">
			<div class="prototyper-ui-template-controls clearfix">
				<div class="prototyper-col-8 no-padding">
					<?php
					echo elgg_view('output/url', array(
						'class' => 'prototyper-ui-template-drag',
						'text' => elgg_view_icon('prototyper-ui-move'),
						'href' => '#'
					));
					echo elgg_view('input/text', array(
						'class' => 'prototyper-ui-template-shortname',
						'name' => 'field[__ID__][shortname]',
						'value' => (strpos($shortname, 'prototyper_') === false) ? $shortname : '',
						'placeholder' => elgg_echo('prototyper:ui:shortname:placeholder'),						
					));
					?>
				</div>
				<div class="prototyper-col-4 text-right no-padding">
					<?php
					echo elgg_view('output/url', array(
						'class' => 'prototyper-ui-template-edit',
						'text' => elgg_view_icon('prototyper-ui-edit'),
						'href' => '#'
					));
					echo elgg_view('output/url', array(
						'class' => 'prototyper-ui-template-clone',
						'text' => elgg_view_icon('prototyper-ui-clone'),
						'href' => '#'
					));
					echo elgg_view('output/url', array(
						'class' => 'prototyper-ui-template-remove',
						'text' => elgg_view_icon('prototyper-ui-remove'),
						'href' => '#'
					));
					?>
				</div>
			</div>
		</div>
		<div class="prototyper-ui-template-body">
			<div class="prototyper-row">
				<div class="prototyper-col-6">
					<div>
						<label><?php echo elgg_echo('prototyper:ui:dit') ?></label>
						<div class="prototyper-ui-properties">
							<select class="prototyper-ui-dit-select" name="field[__ID__][dit]">
								<?php
								$templates = hypePrototyper()->ui->getTemplates();
								foreach ($templates as $template_data_type => $data_type_input_types) {
									?>
									<optgroup label="<?php echo $template_data_type ?>">
										<?php
										foreach ($data_type_input_types as $data_type_input_type => $data_type_input_options) {
											echo elgg_format_element('option', array(
												'class' => 'prototyper-ui-dit-select-option',
												'value' => "$template_data_type::$data_type_input_type",
												'data-dt' => $template_data_type,
												'data-it' => $data_type_input_type,
												'selected' => ("$template_data_type::$data_type_input_type" == "$data_type::$type")
													), $data_type_input_type);
										}
										?>
									</optgroup>
									<?php
								}
								?>
							</select>
						</div>

						<!-- START REQUIRED SECTION -->
						<label class="prototyper-ui-section-required">
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][required]',
								'value' => 1,
								'checked' => $required,
							)) . elgg_echo('prototyper:ui:required')
							?>
						</label>
						<!-- END REQUIRED SECTION -->

						<!-- START ADMIN ONLY SECTION -->
						<label class="prototyper-ui-section-adminonly">
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][admin_only]',
								'value' => 1,
								'checked' => $admin_only,
							)) . elgg_echo('prototyper:ui:admin_only')
							?>
						</label>
						<!-- END ADMIN ONLY SECTION -->

						<!-- START HIDDEN FROM PROFILE SECTION -->
						<label class="prototyper-ui-section-adminonly">
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][hide_on_profile]',
								'value' => 1,
								'checked' => $hide_on_profile,
							)) . elgg_echo('prototyper:ui:hide_on_profile')
							?>
						</label>
						<!-- END HIDDEN FROM PROFILE SECTION -->

						<!-- START MULTIPLE SECTION -->
						<label class="prototyper-ui-section-multiple">
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][multiple]',
								'value' => 1,
								'checked' => $multiple,
							)) . elgg_echo('prototyper:ui:multiple')
							?>
						</label>
						<!-- END MULTIPLE SECTION -->

						<!-- START ACCESS SECTION -->
						<label class="prototyper-ui-section-show-access">
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][show_access]',
								'value' => 1,
								'checked' => $show_access,
							)) . elgg_echo('prototyper:ui:show_access')
							?>
						</label>
						<!-- END ACCESS SECTION -->
					</div>

					<!-- START RELATIONSHIP SECTION -->
					<div class="prototyper-ui-section-relationship">
						<label>
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][relationship][inverse]',
								'value' => 1,
								'checked' => $field->get('inverse_relationship'),
							)) . elgg_echo('prototyper:ui:inverse_relationship')
							?>
						</label>
						<label>
							<?php
							echo elgg_view('input/checkbox', array(
								'name' => 'field[__ID__][relationship][bilateral]',
								'value' => 1,
								'checked' => $field->get('bilateral'),
							)) . elgg_echo('prototyper:ui:bilateral')
							?>
						</label>
					</div>
					<!-- END RELATIONSHIP SECTION -->

					<!-- START DEFAULT FLAGS SECTION -->
					<div class="prototyper-ui-section-value">
						<label><?php echo elgg_echo('prototyper:ui:flags') ?></label>
						<div class="prototyper-ui-properties">
							<?php
							$flags = $field->getFlags();
							echo elgg_view('input/text', array(
								'name' => 'field[__ID__][flags]',
								'value' => is_array($flags) ? implode(', ', $flags) : $flags,
							));
							?>
						</div>
					</div>
					<!-- END LABEL SECTION -->

				</div>

				<div class="prototyper-col-6">

					<!-- START DEFAULT VALUE SECTION -->
					<div class="prototyper-ui-section-value">
						<label><?php echo elgg_echo('prototyper:ui:value') ?></label>
						<div class="prototyper-ui-properties">
							<?php
							echo elgg_view('input/text', array(
								'name' => 'field[__ID__][value]',
								'value' => $field->getDefaultValue(),
							));
							?>
						</div>
					</div>
					<!-- END LABEL SECTION -->

					<!-- START LABEL SECTION -->
					<div class="prototyper-ui-section-label">
						<label><?php echo elgg_echo('prototyper:ui:label', array(elgg_echo($language))) ?></label>
						<div class="prototyper-ui-properties">
							<label>
								<?php
								echo elgg_view('input/checkbox', array(
									'name' => 'field[__ID__][hide_label]',
									'value' => 1,
									'checked' => ($label === false),
								)) . elgg_echo('prototyper:ui:hide_label')
								?>
							</label>
							<div>
								<?php
								$translation = ($field->getLabel($language, true) != $field->getLabel($language, false)) ? $field->getLabel($language) : '';
								echo elgg_view('input/text', array(
									'name' => "field[__ID__][label][$language]",
									'value' => $translation,
								));
								?>
							</div>
						</div>
					</div>
					<!-- END LABEL SECTION -->

					<!-- START HELP SECTION -->
					<div class="prototyper-ui-section-help">
						<label><?php echo elgg_echo('prototyper:ui:help', array(elgg_echo($language))) ?></label>
						<div class="prototyper-ui-properties">
							<label>
								<?php
								echo elgg_view('input/checkbox', array(
									'name' => 'field[__ID__][hide_help]',
									'value' => 1,
									'checked' => ($help === false),
								)) . elgg_echo('prototyper:ui:hide_help')
								?>
							</label>
							<div>
								<?php
								$translation = ($field->getHelp($language, true) != $field->getHelp($language, false)) ? $field->getHelp($language) : '';
								echo elgg_view('input/text', array(
									'name' => "field[__ID__][help][$language]",
									'value' => $translation,
								));
								?>
							</div>
						</div>
						<!-- END HELP SECTION -->

					</div>
				</div>

				<!-- START OPTIONS VALUES SECTION -->
				<div class="prototyper-ui-section-optionsvalues">
					<div class="prototyper-col-12">
						<label><?php echo elgg_echo('prototyper:ui:options') ?></label>
						<div class="prototyper-ui-properties">
							<div class="prototyper-row">
								<div class="prototyper-col-2">
									&nbsp;
								</div>
								<div class="prototyper-col-5">
									<label><?php echo elgg_echo('prototyper:ui:options:value') ?></label>
								</div>
								<div class="prototyper-col-5">
									<label><?php echo elgg_echo('prototyper:ui:options:label', array(elgg_echo($language))) ?></label>
								</div>
							</div>
							<div class="prototyper-ui-options-list">
								<?php
								$options_values = elgg_extract('options_values', $field->getInputVars($entity), array());
								if (!count($options_values)) {
									$options_values = array('' => array($lang => ''));
								}
								foreach ($options_values as $value => $key) {
									?>
									<div class="prototyper-row prototyper-ui-options-item">
										<div class="prototyper-col-2 no-padding">
											<?php
											echo elgg_view('output/url', array(
												'class' => 'prototyper-ui-options-move',
												'text' => elgg_view_icon('prototyper-ui-move'),
												'href' => '#'
											));
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
										<div class="prototyper-col-5">
											<?php
											echo elgg_view('input/text', array(
												'name' => 'field[__ID__][options_values][value][]',
												'value' => $value,
											));
											?>
										</div>
										<div class="prototyper-col-5">
											<?php
											echo elgg_view('input/text', array(
												'name' => "field[__ID__][options_values][label][$language][]",
												'value' => $key,
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
				</div>
				<!-- END OPTIONS VALUES SECTION -->

				<!-- START VALIDATION SECTION -->
				<div class="prototyper-ui-section-validation">
					<div class="prototyper-col-12">
						<label><?php echo elgg_echo('prototyper:ui:validation') ?></label>
						<div class="prototyper-ui-properties">
							<div class="prototyper-row">
								<div class="prototyper-col-2">
									&nbsp;
								</div>
								<div class="prototyper-col-5">
									<label><?php echo elgg_echo('prototyper:ui:validation:rule') ?></label>
								</div>
								<div class="prototyper-col-5">
									<label><?php echo elgg_echo('prototyper:ui:validation:expectation') ?></label>
								</div>
							</div>
							<div class="prototyper-ui-options-list">
								<?php
								$validation_rule_defs = hypePrototyper()->config->getValidationRules();
								$validation_rule_defs_options = array('' => '');
								foreach ($validation_rule_defs as $rule => $rule_opts) {
									$validation_rule_defs_options[$rule] = elgg_echo("prototyper:ui:validation:rule:$rule");
								}

								$validation_rules = $field->getValidationRules();
								if (empty($validation_rules)) {
									$validation_rules = array('' => '');
								}

								foreach ($validation_rules as $rule => $expectation) {
									?>
									<div class="prototyper-row prototyper-ui-validation-item">
										<div class="prototyper-col-2 no-padding">
											<?php
											echo elgg_view('output/url', array(
												'class' => 'prototyper-ui-validation-move',
												'text' => elgg_view_icon('prototyper-ui-move'),
												'href' => '#'
											));
											echo elgg_view('output/url', array(
												'class' => 'prototyper-ui-validation-add',
												'text' => elgg_view_icon('prototyper-ui-add'),
												'href' => '#'
											));
											echo elgg_view('output/url', array(
												'class' => 'prototyper-ui-validation-remove',
												'text' => elgg_view_icon('prototyper-ui-remove'),
												'href' => '#'
											));
											?>
										</div>
										<div class="prototyper-col-5">
											<?php
											echo elgg_view('input/dropdown', array(
												'name' => 'field[__ID__][validation][rule][]',
												'value' => $rule,
												'options_values' => $validation_rule_defs_options,
												'class' => 'prototyper-ui-validation-type-select',
											));
											?>
										</div>
										<div class="prototyper-col-5">
											<?php
											foreach ($validation_rule_defs as $rule_def => $rule_def_opts) {
												if (is_array($rule_def_opts)) {
													$rule_def_opts_values = array('' => '');
													foreach ($rule_def_opts as $ro) {
														$rule_def_opts_values[$ro] = elgg_echo("prototyper:ui:validation:$rule_def:$ro");
													}
													echo elgg_view('input/dropdown', array(
														'data-name' => "field[__ID__][validation][expectation][]",
														'value' => $expectation,
														'options_values' => $rule_def_opts_values,
														'data-rule' => $rule_def,
														'class' => 'prototyper-ui-validation-value-select hidden',
													));
												} else {
													echo elgg_view('input/text', array(
														'data-name' => "field[__ID__][validation][expectation][]",
														'value' => $expectation,
														'data-rule' => $rule_def,
														'class' => 'prototyper-ui-validation-value-select hidden',
													));
												}
											}
											?>
										</div>

									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- END VALIDATION SECTION -->

				<?php
				echo elgg_view("forms/prototyper/template/extend", $vars);
				echo elgg_view("forms/prototyper/template/$data_type/$type", $vars);
				?>
			</div>
		</div>
</section>
