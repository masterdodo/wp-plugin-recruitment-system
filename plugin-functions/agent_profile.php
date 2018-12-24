<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$my_plugin = WP_PLUGIN_DIR . '/job-applications/';
$user = wp_get_current_user();
$user_id = $user->ID;
$category = $wpdb->get_var( $wpdb->prepare( "SELECT user_category FROM $table_agent_profiles WHERE user_id = %d", $user_id ) );
if($category == 'individual')
{
    require_once $my_plugin . 'plugin-functions/agent_individual_profile.php';
}
else if($category == 'company')
{
    require_once $my_plugin . 'plugin-functions/agent_company_profile.php';
}
else if($category == 'partnership_firm')
{
    require_once $my_plugin . 'plugin-functions/agent_partnership_firm_profile.php';
}
else if($category == 'family_member')
{
    require_once $my_plugin . 'plugin-functions/agent_family_member_profile.php';
}
else
{
    return 'Error, Try again.';
}