<?php

namespace hypeJunction\Prototyper\UI;

$english = array(

	'prototyper:ui:metadata:shortname' => 'Metadata Name',
	'prototyper:ui:annotation:shortname' => 'Annotation Name',

	'prototyper:ui:dit' => 'Type',
	'prototyper:ui:required' => 'Required',
	'prototyper:ui:admin_only' => 'Admin only field',
	'prototyper:ui:hide_on_profile' => 'Hidden on profile',
	'prototyper:ui:multiple' => 'Allow multiple inputs',
	'prototyper:ui:show_access' => 'Show access input',
	'prototyper:ui:value' => 'Default Value',
	'prototyper:ui:label' => 'Label (%s)',
	'prototyper:ui:hide_label' => 'Hide label',
	'prototyper:ui:help' => 'Help text (%s)',
	'prototyper:ui:hide_help' => 'Hide help text',
	'prototyper:ui:clone' => 'Clone',
	'prototyper:ui:remove' => 'Remove',
	'prototyper:ui:options' => 'Option Values',
	'prototyper:ui:options:value' => 'Value',
	'prototyper:ui:options:label' => 'Label (%s)',
	'prototyper:ui:inverse_relationship' => 'Inverse Relationship',
	'prototyper:ui:bilateral' => 'Bilateral Relationship',
	'prototyper:ui:flags' => 'Flags (for back end filtering)',
	'prototyper:ui:min' => 'Minimum value',
	'prototyper:ui:max' => 'Maximum value',

	'prototyper:ui:cropper_instructions' => 'Select an area of your image to crop',
	'prototyper:ui:icon_sizes' => 'Icon cropping sizes',
	'prototyper:ui:icon_sizes:help' => 'Specify additional cropping sizes required. The following aliases are reserved by the system: %s',
	'prototyper:ui:icon_sizes:name' => 'Alias',
	'prototyper:ui:icon_sizes:w' => 'Width',
	'prototyper:ui:icon_sizes:h' => 'Height',

	'prototyper:ui:attribute' => 'Attributes',
	'prototyper:ui:metadata' => 'Meta Fields',
	'prototyper:ui:annotation' => 'Annotations',
	'prototyper:ui:relationship' => 'Relationship',
	'prototyper:ui:icon' => 'Icon',
	'prototyper:ui:image' => 'Image',
	'prototyper:ui:category' => 'Categories',

	'prototyper:ui:title' => 'Title',
	'prototyper:ui:name' => 'Name',
	'prototyper:ui:description' => 'Description',
	'prototyper:ui:access_id' => 'Access',

	'prototyper:ui:hidden' => 'Hidden',
	'prototyper:ui:text' => 'Short Text',
	'prototyper:ui:plaintext' => 'Text (no editor)',
	'prototyper:ui:longtext' => 'Text (with editor)',
	'prototyper:ui:select' => 'Select',
	'prototyper:ui:checkboxes' => 'Checkboxes',
	'prototyper:ui:radio' => 'Radio boxes',
	'prototyper:ui:stars' => 'Star Rating',
	'prototyper:ui:userpicker' => 'User picker',
	'prototyper:ui:friendspicker' => 'Friend picker',
	'prototyper:ui:file' => 'File',
	'prototyper:ui:tags' => 'Tags',
	'prototyper:ui:date' => 'Date Picker',
	'prototyper:ui:email' => 'E-mail',
	'prototyper:ui:url' => 'URL',
	'prototyper:ui:access' => 'Access',
	'prototyper:ui:time' => 'Time',
	'prototyper:ui:upload' => 'File Upload',
	'prototyper:ui:image_upload' => 'Image Upload',

	'prototyper:ui:validation' => 'Validation',
	'prototyper:ui:validation:rule' => 'Rule',

	'prototyper:ui:validation:rule:type' => 'Value Type',
	'prototyper:ui:validation:type:integer' => 'Integer',
	'prototyper:ui:validation:type:string' => 'Text/String',
	'prototyper:ui:validation:type:alnum' => 'Alphanumeric',
	'prototyper:ui:validation:type:alpha' => 'Alphabetic',
	'prototyper:ui:validation:type:int' => 'Integer',
	'prototyper:ui:validation:type:numeric' => 'Numeric',
	'prototyper:ui:validation:type:date' => 'Date',
	'prototyper:ui:validation:type:url' => 'URL',
	'prototyper:ui:validation:type:email' => 'Email',
	'prototyper:ui:validation:type:guid' => 'Existing entity GUID',
	'prototyper:ui:validation:type:image' => 'Image File',

	'prototyper:ui:validation:rule:min' => 'Minimum',
	'prototyper:ui:validation:rule:max' => 'Maximum',
	'prototyper:ui:validation:rule:minlength' => 'Minimum Length',
	'prototyper:ui:validation:rule:maxlength' => 'Maximum Length',
	'prototyper:ui:validation:rule:contains' => 'Contains',
	'prototyper:ui:validation:rule:regex' => 'Regex',
	'prototyper:ui:validation:rule:img_min_width' => 'Min width',
	'prototyper:ui:validation:rule:img_max_width' => 'Max width',
	'prototyper:ui:validation:rule:img_min_height' => 'Min height',
	'prototyper:ui:validation:rule:img_max_height' => 'Max height',

	'prototyper:ui:validation:expectation' => 'Expectation',
	
	'prototyper:ui:time:format' => 'Format',
	'prototyper:ui:time:interval' => 'Interval between options in seconds',

	'admin:prototyper' => 'Prototyper',
	'admin:prototyper:prototype' => 'Demo Prototyper',
	'admin:prototyper:form' => 'Demo Form',
	'admin:prototyper:profile' => 'Demo Profile',

	'prototyper:ui:attributes:help' => 'To follow Elgg\'s data model, use "title" (for objects) or "name" (for users and groups), "description", and "access_id" fields in your form',
	'prototyper:ui:shortname:placeholder' => 'Enter unqiue field name',
	
);

add_translation('en', $english);
