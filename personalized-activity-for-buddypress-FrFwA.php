<?php
/**
* Plugin Name: Personalized Activity for Buddypress - Friends, Following, Admin
* Description: Makes Buddypress Activity Personalized For Users, by Including Activity Feeds Only From Users They Are Friends With, Users They Are Following And Administrator of Your Community.
* Version: 1.0.3
* Author: Rubix from SPARCK
* Author URI: https://drip-sparck.pantheonsite.io
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
**/

function personalized_activity_for_buddypress_FfFwA_by_rubix_args( $args ) {
	
	if( ! bp_is_activity_directory() || !  is_user_logged_in() ) {
		return $args;
	}
	
	//get owner's user id - by rubix	
	$user_id_by_rubix = get_current_user_id();
	
	//includes activity from user with user id as 1, generally it's of wp admin -by rubix
	$user_admin_by_rubix = 1;
	
	//get users ids of friends of the user viewing it -by rubix
	$user_id_friends_by_rubix = friends_get_friend_user_ids( $user_id );
	
	//get user ids of followings of user viewing it - by rubix
	$user_id_followings_by_rubix = bp_get_following_ids ( $user_id );
	
	//include activities from below mentioned ids collected in above statements - by rubix 
	array_push( $user_id_by_rubix, $user_admin_by_rubix, $user_id_friends_by_rubix, $user_id_followings_by_rubix);
	
	$args['user_id_by_rubix'] = $user_id_friends_by_rubix;
	$args['user_id_by_rubix'] = $user_id_followings_by_rubix;
	
	//print_r($args);
	return $args;
	
}
add_filter( 'bp_after_has_activities_parse_args', 'personalized_activity_for_buddypress_FfFwA_by_rubix_args' );
