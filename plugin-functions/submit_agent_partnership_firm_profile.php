<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-agent-partnership-firm']))
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

    if(isset($_POST['firm_name']))
    {
        $firm_name = wpja_sanitize_check($_POST['firm_name']);
    }
    if(isset($_POST['full_firm_address']))
    {
        $full_firm_address = wpja_sanitize_check($_POST['full_firm_address']);
    }
    if(isset($_POST['postcode']))
    {
        $postcode = wpja_sanitize_check($_POST['postcode']);
    }
    if(isset($_POST['commission_address']))
    {
        $commission_address = wpja_sanitize_check($_POST['commission_address']);
    }
    if(isset($_POST['phone']))
    {
        $phone = wpja_sanitize_check($_POST['phone']);
    }
    if(isset($_POST['fax']))
    {
        $fax = wpja_sanitize_check($_POST['fax']);
    }
    if(isset($_POST['email']))
    {
        $email = wpja_sanitize_check($_POST['email']);
    }
    if(isset($_POST['web']))
    {
        $web = wpja_sanitize_check($_POST['web']);
    }
    if(isset($_POST['firm_registration_number']))
    {
        $firm_registration_number = wpja_sanitize_check($_POST['firm_registration_number']);
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($firm_name, $full_firm_address, $postcode, $commission_address, $phone, $fax, $email, $web, $firm_registration_number);
    $sql_profile = "UPDATE $table_agent_partnership_firm_profiles SET firm_name = %s,full_firm_address = %s,postcode = %s,commission_address = %s,phone = %s,fax = %s,email = %s,web = %s,firm_registration_number = %s WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
    //$profile_id = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM $table_agent_partnership_firm_profiles WHERE user_id = %d", $user_id ) );
    //$profile_id = $profile_id->id;
}