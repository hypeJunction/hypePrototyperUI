<?php

namespace hypeJunction\Prototyper\UI;

function register_template($data_type, $type, $params = array()) {
	Template::registerTemplate($data_type, $type, $params);
}

function normalize_fields_array() {
	return Template::getPrototype();
}
