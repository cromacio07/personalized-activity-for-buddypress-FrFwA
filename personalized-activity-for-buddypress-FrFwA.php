<?php
/**
* Plugin Name: Personalized Activity for Buddypress - Friends, Following, Admin
* Description: Makes Buddypress Activity Personalized For Users, by Including Activity Feeds Only From Users They Are Friends With, Users They Are Following And Administrator of Your Community.
* Version: 1.0.1
* Author: Yaglewad Onkar
* Author URI: https://onkar-yaglewad.pantheonsite.io
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
**/

function onkar_friends_followers_admin_activity_args( $args ) {
	
	if( ! bp_is_activity_directory() || !  is_user_logged_in() ) {
		return $args;
	}
	
	$user_id = get_current_user_id();
	$user_admin = 1;
	$user_ids = friends_get_friend_user_ids( $user_id );
	$user_idsf = bp_get_following_ids ( $user_id );
	
	//include users own too?
	array_push( $user_ids, $user_id, $user_admin);
	
	$args['user_id'] = $user_ids;
	$args['user_id'] = $user_idsf;
	
	//print_r($args);
	return $args;
	
}
add_filter( 'bp_after_has_activities_parse_args', 'onkar_friends_followers_admin_activity_args' );