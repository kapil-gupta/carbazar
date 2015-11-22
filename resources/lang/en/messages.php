<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Error Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are the default lines which match reasons
	| that are given by the password broker for a password update attempt
	| has failed, such as for an invalid token or invalid new password.
	|
	*/
	'errors' => array(
		'base' => array(
		),
		'corporate' => array(
			'access' => 'Access Restriction : you do not have access to the :section section.',
			'missing' => 'Resource Missing : no such resource exists',
			'auth' => 'Request not authenticated'
		),
		'database' => array(
			'failed' => 'Whoops! Something went wrong. Please try again.',
		),
		'max' => array (
		),
		'program' => array(
		)
	),
	'warnings' => array(
	),
	'messages' => array(
	),
	'crud' => array(
		'success' => 'The record was :action sucessfully.',
		'failed' => 'Whoops! Something went wrong. :action action failed.',
		'noresults' => 'No records found'
	),
        'account' => array(
		'passwordremind' => 'Your password has been reset. Please check your Email for additonal details.'
	)
);