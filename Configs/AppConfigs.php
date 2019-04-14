<?php

return [
	
	'ENGINE_NAME' => 'ENGINE',
	
	'CURRENT_ENV' => 'Development',
	
	'DEBUG' => True,
	
	'URL' => 'engine.com',
	
	'TIMEZONE' => 'UTC+02:00',
	
	'MAIN_LANGUAGE' => 'EN',
	
	'BACKUP_LANGUAGES' => [
		'EN',
		'AR'
	],
	
	'ENCREPTION_KEY' => NULL,
	
	'CORE_PATH' => _DIR_.'/Core/',
	
	'SCHEMA' => _DIR_.'/SCHEMA.php',
	
	'VIEWS' => _DIR_.'/Views/',

	'TEMPLATES' => _DIR_.'/Templates/',

	'TEMPLATES_FILTERS' => _DIR_.'/TemplatesFilters/',

	'PUBLIC' => _DIR_.'/Public/',
];