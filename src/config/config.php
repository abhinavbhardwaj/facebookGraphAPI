<?php
define('SITE_URL', 'http://localhost/abhinav/facebook/');
define('APP_ID', '373232799449646');
define('APP_SECRET', 'c4e772ccceb71b26957c44a86de5fce1');
define('API_V', 'v2.5');

global $permissions;
$permissions  = [
						'email',
						'instagram_basic',
						'instagram_manage_comments',
						'instagram_manage_insights',
						'manage_pages',
						'pages_manage_cta',
						'pages_manage_instant_articles',
						'pages_messaging',
						'pages_messaging_phone_number',
						'pages_show_list',
						'publish_actions',
						'publish_pages',
						'public_profile',
						'read_audience_network_insights',
						'read_custom_friendlists',
						'read_insights',
						'read_page_mailboxes',
						'rsvp_event',
						'user_about_me',
						'user_actions:washurface',
						'user_actions.books',
						'user_actions.fitness',
						'user_actions.music',
						'user_actions.news',
						'user_actions.video',
						'user_birthday',
						'user_education_history',
						'user_events',
						'user_friends',
						'user_games_activity',
						'user_hometown',
						'user_likes',
						'user_location',
						'user_managed_groups',
						'user_photos',
						'user_posts',
						'user_relationship_details',
						'user_relationships',
						'user_religion_politics',
						'user_tagged_places',
						'user_videos',
						'user_website',
						'user_work_history'
			   ];


function prd($string, $noDie = false){
	echo "<pre>";
	print_r($string);
	echo "</pre>";

	if($noDie===false) die;
}