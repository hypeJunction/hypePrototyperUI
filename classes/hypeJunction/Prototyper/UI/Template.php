<?php

namespace hypeJunction\Prototyper\UI;

class Template {

	static $templates;
	protected $sections = array(
		'required' => true,
		'access' => true,
		'multiple' => true,
		'label' => true,
		'help' => true,
		'optionsvalues' => false,
		'relationship' => false,
		'validation' => true,
		'value' => true,
	);

	private function __construct($data_type = 'metadata', $type = 'text', $params = array()) {
		foreach ($this->sections as $name => $default) {
			$show = elgg_extract($name, $params, $default);
			$this->$name = ($show) ? 'visible' : 'hidden';
		}
	}

	public static function registerTemplate($data_type, $type, $params = array()) {
		$template = new Template($data_type, $type, $params);
		self::$templates[$data_type][$type] = $template;
	}

	public static function getTemplate($data_type, $type) {
		if (isset(self::$templates[$data_type][$type])) {
			return self::$templates[$data_type][$type];
		}
		return new Template($data_type, $type);
	}

	public static function getTemplates($data_type = '') {

		if (!$data_type) {
			return self::$templates;
		}
		return elgg_extract($data_type, self::$templates, array());
	}

	public static function getPrototype() {
		$language = elgg_get_plugin_setting('default_language', PLUGIN_ID);
		if (!$language) {
			$language = 'en';
		}

		$attribute = get_input('attribute', array());
		$field = get_input('field', array());
		$temp = array();

		foreach ($field as $uid => $options) {

			$shortname = elgg_extract('shortname', $options, $uid);
			$shortname = preg_replace("/[^A-Za-z0-9_]/", "_", $shortname);
			$shortname = strtolower($shortname);

			list($data_type, $input_type) = explode('::', elgg_extract('dit', $options, ''));
			$required = (bool) elgg_extract('required', $options, false);
			$multiple = (bool) elgg_extract('multiple', $options, false);
			$show_access = (bool) elgg_extract('show_access', $options, false);

			$relationship = elgg_extract('relationship', $options, array());
			$inverse_relationship = (bool) elgg_extract('inverse_relationship', $relationship, false);
			$bilateral = (bool) elgg_extract('bileteral', $relationship, false);

			$value = elgg_extract('value', $options);

			$hide_label = (bool) elgg_extract('hide_label', $options, false);
			$label = ($hide_label) ? false : elgg_extract('label', $options, '');

			$hide_help = (bool) elgg_extract('hide_help', $options, false);
			$help = ($hide_help) ? false : elgg_extract('help', $options, '');

			$options_values = elgg_extract('options_values', $options, array());
			$options_values_config = array();
			for ($i = 0; $i < count($options_values['value']); $i++) {
				$o_value = $options_values['value'][$i];
				$o_label = $options_values['label'][$language][$i];
				$options_values_config[$o_value] = array($language => $o_label);
			}
			$temp[$shortname] = array(
				'type' => $input_type,
				'data_type' => $data_type,
				'required' => $required,
				'multiple' => $multiple,
				'show_access' => $show_access,
				'inverse_relationship' => $inverse_relationship,
				'bilateral' => $bilateral,
				'value' => $value,
				'label' => $label,
				'help' => $help,
				'options_values' => $options_values_config,
			);
		}

		$fields = array();

		$title = elgg_extract('title', $attribute);
		$description = elgg_extract('description', $attribute);
		$access_id = elgg_extract('access_id', $attribute);

		if ($title && !array_key_exists('title', $temp)) {
			$fields['title'] = array(
				'required' => true,
			);
		}
		if ($description && !array_key_exists('description', $temp)) {
			$fields['description'] = array(
				'type' => 'longtext',
			);
		}

		foreach ($temp as $shortname => $options) {
			$fields[$shortname] = $options;
		}

		if ($access_id && !array_key_exists('access_id', $temp)) {
			$fields['access_id'] = array(
				'type' => 'access',
			);
		}

		return $fields;
	}

}
