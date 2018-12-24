<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-agent-company']))
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

    if(isset($_POST['business_name']))
    {
        $business_name = wpja_sanitize_check($_POST['business_name']);
    }
    if(isset($_POST['full_business_address']))
    {
        $full_business_address = wpja_sanitize_check($_POST['full_business_address']);
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
    if(isset($_POST['company_registration_number']))
    {
        $company_registration_number = wpja_sanitize_check($_POST['company_registration_number']);
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($business_name, $full_business_address, $postcode, $commission_address, $phone, $fax, $email, $web, $company_registration_number);
    $sql_profile = "UPDATE $table_agent_company_profiles SET business_name = %s,full_business_address = %s,postcode = %s,commission_address = %s,phone = %s,fax = %s,email = %s,web = %s,company_registration_number = %s WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
    //$profile_id = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM $table_agent_company_profiles WHERE user_id = %d", $user_id ) );
    //$profile_id = $profile_id->id;
}