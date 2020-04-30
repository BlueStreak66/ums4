<?php

return [
	
	'dashboard' => [
		'title' => 'Dashboard',
		'payment_addr' => 'Payment Address',
		'post' => 'Posts',
	],

	'user-management' => [
		'title' => 'User Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],
	
	'permissions' => [
		'title' => 'Permissions',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Title',
		],
	],
	
	'roles' => [
		'title' => 'Roles',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Title',
			'permission' => 'Permissions',
		],
	],
	
	'users' => [
		'title' => 'Users',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'role' => 'Role',
			'remember-token' => 'Remember token',
		],
	],

	'team-management' => [
		'title' => 'Team Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],	

	'teams' => [
		'title' => 'Teams',
		'created_at' => 'Time',
		'fields' => [
			'team_name' => 'Team Name',
			'team_leader' => 'Team Leader',
			'created_at' => 'Created Time',
		],
	],

	'team-members' => [
		'title' => 'Team Members',
		'edit' => 'Edit Team Members',
		'team_name' => 'Team Name',
		'team_members' => 'Team Members',
		'created_at' => 'Time',
	],

	'payment_histories' => [
		'title' => 'Payment History',
		'fields' => [
			'amount' => 'Amount',
			'real_amount' => 'Real Amount',
			'name' => 'Name',
			'payment_address' => 'Payment Address',
			'comment' => 'Comment',
			'date' => 'Date',
			'state' => 'State',
			'actions' => 'Actions',
			'team_name' => 'Team_Name',
			'team_plan' => 'Team_Plan',
			'percent' => 'Percent',
		],
	],
	
	'total_payment' => [
		'title' => 'Total Payment',
		'individual' => 'Individual',
		'team' => 'Team',
	],

	'app_create' => 'Create',
	'app_save' => 'Save',
	'app_edit' => 'Edit',
	'app_view' => 'View',
	'app_update' => 'Update',
	'app_list' => 'List',
	'app_no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'app_logout' => 'Logout',
	'app_add_new' => 'Add new',
	'app_are_you_sure' => 'Are you sure?',
	'app_back_to_list' => 'Back to list',
	'app_dashboard' => 'Dashboard',
	'app_delete' => 'Delete',
	'app_hide' => 'Hide',
	'app_active' => 'Active',
	'global_title' => 'Quick LMS',
	'app_confirm' => 'Confirm',
	'app_confirmed' => 'Confirmed',
	'app_action' => 'Actions',
	'p_confirmed_state' => 1,
	'app_number' => 'No.',
];