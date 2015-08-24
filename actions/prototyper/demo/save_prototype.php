<?php

$prototype = hypePrototyper()->ui->buildPrototypeFromInput();

if ($prototype) {

	$file = new ElggFile();
	$file->owner_guid = elgg_get_site_entity()->guid;
	$file->setFilename("prototypes/prototyper_demo.json");

	$file->open('write');
	$file->write(json_encode($prototype));
	$file->close();

	system_message("Prototype saved");
} else {
	register_error("Prototype could not be saved");
}

forward(REFERER);
