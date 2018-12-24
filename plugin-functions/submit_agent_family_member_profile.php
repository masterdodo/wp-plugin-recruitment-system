<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-agent-family-member']))
{
    
    function wpja_sanitize_check($field)
    {
        if(isset($field))
        {
            $field = sanitize_text_field($field);
            $field = substr($field, 0, 100);
        }
        else
        {
            $field = '';
        }
        return $field;
    }

    if(isset($_POST['aname']))
    {
        $name = wpja_sanitize_check($_POST['aname']);
    }
    if(isset($_POST['surname']))
    {
        $surname = wpja_sanitize_check($_POST['surname']);
    }
    if(isset($_POST['email']))
    {
        $email = wpja_sanitize_check($_POST['email']);
    }
    if(isset($_POST['family_relation']))
    {
        $family_relation = wpja_sanitize_check($_POST['family_relation']);
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($name, $surname, $email, $family_relation);
    $sql_profile = "UPDATE $table_agent_family_member_profiles SET name = %s,surname = %s,email = %s,family_relation = %s WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
    //$profile_id = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM $table_agent_family_member_profiles WHERE user_id = %d", $user_id ) );
    //$profile_id = $profile_id->id;
}