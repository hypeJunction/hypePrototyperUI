hypePrototyperUI
================
![Elgg 1.8](https://img.shields.io/badge/Elgg-1.8.x-orange.svg?style=flat-square)
![Elgg 1.9](https://img.shields.io/badge/Elgg-1.9.x-orange.svg?style=flat-square)
![Elgg 1.10](https://img.shields.io/badge/Elgg-1.10.x-orange.svg?style=flat-square)
![Elgg 1.11](https://img.shields.io/badge/Elgg-1.11.x-orange.svg?style=flat-square)

User Interface for hypePrototyper

## Introduction

The plugin allows developers to present a visual UI for construction forms. This
can be useful, when working with volatile entity types that will require admin/user
modifications over time.

![alt text](https://raw.github.com/hypeJunction/hypePrototyperUI/master/screenshots/prototyper-ui.png "User Interface")
![alt text](https://raw.github.com/hypeJunction/hypePrototyperUI/master/screenshots/prototyper-form.png "Resulting Form")


## Requirements

Even though this plugins runs on 1.8, your theme will need to support jQuery 1.7+.

## How to Use

### Display the UI

Let's assume you have an action to create/edit new books, e.g. ```books/save```.
You may want to differentiate what forms to display, based on what library
this book is available in.

Register an action that will take care of storing the form config, e.g.
```books/prototype/save```.

```php

echo elgg_view_form('prototyper/edit', array(
	'action' => 'books/prototype/save',
), array(
	'action' => 'books/save',
	'attributes' => array(
		'type' => 'object',
		'subtype' => 'book',
		'access_id' => ACCESS_PUBLIC,
		'container_guid' => $library_guid,
	),
	'params' => array(
		'layout' => array('main', 'sidebar', 'footer'),
	),
));

```

### Save config

Perhaps the easiest is to store the config as metadata on a library. You can also
use plugin settings, annotations or any method that will allow you to retrieve
the config to feed into the plugin hook.

In ```books/prototype/save```, save your config:

```php

use hypeJunction\Prototyper\UI\Template;

$container_guid = get_input('container_guid');
$library = get_entity($container_guid);

$prototype = hypePrototyper()->ui->buildPrototypeFromInput();

$library->book_prototype = json_encode($prototype);
```

### Hook into the prototype

```php

elgg_register_plugin_hook_handler('prototype', 'books/save', 'book_form');

function book_form($hook, $type, $return, $params) {

	$book = elgg_extract('entity', $params);
	if (elgg_instanceof($book, 'object', 'book')) {
		$library = $entity->getContainerEntity();
		if ($library->book_prototype) {
			return json_decode($library->book_prototype, true);
		}
	}

	return $return;
}
```

### Display the form

```php

$book = elgg_extract('entity', $vars);
$library = elgg_extract('container', $vars);

$attributes = array(
	'guid' => $book->guid,
	'type' => 'object',
	'subtype' => 'book',
	'container_guid' => $library->guid,
);

$body = hypePrototyper()->form->with($attributes, 'books/save')->viewBody();
$body .= elgg_view('input/submit', array(
	'value' => elgg_echo('save')
));

echo elgg_view('input/form', array(
	'action' => 'action/books/save',
	'body' => $body
));

```

### Handle the form

Now in your action file, all you need to do is use:

```php

$guid = get_input('guid');

$attributes = array(
	'guid' => $guid,
	'type' => 'object',
	'subtype' => 'book',
	'container_guid' => get_input('container_guid'),
);

hypePrototyper()->action->with($attributes, 'books/save')->handle();

```