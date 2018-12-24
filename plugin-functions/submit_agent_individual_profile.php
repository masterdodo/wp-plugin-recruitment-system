<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-agent-individual']))
{
    $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
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

    $name = wpja_sanitize_check($_POST['sname']);
    $surname = wpja_sanitize_check($_POST['surname']);
    $email = wpja_sanitize_check($_POST['email']);

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($name, $surname, $email);
    $sql_profile = "UPDATE $table_agent_individual_profiles SET name = %s,surname = %s,email = %s WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
}
