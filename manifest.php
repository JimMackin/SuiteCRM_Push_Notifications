<?php

$manifest = array(
		'acceptable_sugar_flavors' => array('CE', 'PRO', 'CORP', 'ENT', 'ULT'),
		'acceptable_sugar_versions' => array(
				'exact_matches' => array('6.5.20'),
				'regex_matches' => array(),
    	),
    'author' => 'Jim Mackin',
    'description' => 'Adds push notifications as a workflow action',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'Workflow Push Notifications',
    'published_date' => '2015-05-17 20:00:00',
    'type' => 'module',
    'version' => '1.0',
);

$installdefs = array(
    'id' => 'JSMPushNotications',
	'copy' => array(
		array(
			'from' => '<basepath>/custom/include/JSMPushNotification/PushService.php',
			'to' => 'custom/include/JSMPushNotification/PushService.php',
		),
		array(
			'from' => '<basepath>/custom/include/JSMPushNotification/PushBulletService.php',
			'to' => 'custom/include/JSMPushNotification/PushBulletService.php',
		),
		array(
			'from' => '<basepath>/custom/modules/AOW_Actions/actions/actionJSMPushNotification.php',
			'to' => 'custom/modules/AOW_Actions/actions/actionJSMPushNotification.php',
		),
		array(
			'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Actions/JSMPushNotification.php',
			'to' => 'custom/Extension/modules/AOW_Actions/Ext/Actions/JSMPushNotification.php',
		),
	),
	'layoutfields'=> array(
		array(
			'additional_fields'=> array(
				'Users' => 'pushbullet_token_c',
			),
		),
	),
		
	//Add AOW actions
    'language' => array(
        array(
            'from' => '<basepath>/custom/Extension/modules/Users/Ext/Language/en_us.JSMPushNotifications.php',
            'to_module' => 'Users',
            'language' => 'en_us'
        ),
    	array(
            'from' => '<basepath>/custom/Extension/modules/AOW_Actions/Ext/Language/en_us.JSMPushNotification.php',
            'to_module' => 'AOW_Actions',
            'language' => 'en_us'
        ),
    ),
    'custom_fields' => array(
        array(
            'name' => 'pushbullet_token_c',
            'label' => 'LBL_PUSHBULLET_TOKEN',
            'type' => 'varchar',
            'module' => 'Users',
            'default_value' => '',
            'max_size' => 255,
            'required' => false,
            
        ),
	),
);