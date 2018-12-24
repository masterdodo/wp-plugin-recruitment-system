<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-employer-company']))
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
    if(isset($_POST['service_provider_details']))
    {
        $service_provider_details = wpja_sanitize_check($_POST['service_provider_details']);
    }
    if(isset($_POST['bank_name']))
    {
        $bank_name = wpja_sanitize_check($_POST['bank_name']);
    }
    if(isset($_POST['bank_address']))
    {
        $bank_address = wpja_sanitize_check($_POST['bank_address']);
    }
    if(isset($_POST['bank_postcode']))
    {
        $bank_postcode = wpja_sanitize_check($_POST['bank_postcode']);
    }
    if(isset($_POST['country']))
    {
        $country_id = wpja_sanitize_check($_POST['country']);
    }
    else
    {
        $country_id = null;
    }
    if(isset($_POST['sort_code']))
    {
        $sort_code = wpja_sanitize_check($_POST['sort_code']);
    }
    if(isset($_POST['iban_number']))
    {
        $iban_number = wpja_sanitize_check($_POST['iban_number']);
    }
    if(isset($_POST['account_name']))
    {
        $account_name = wpja_sanitize_check($_POST['account_name']);
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($business_name, $full_business_address, $postcode, $commission_address, $phone, $fax, $email, $web, $company_registration_number, $service_provider_details, $bank_name, $bank_address, $bank_postcode, $country_id, $sort_code, $iban_number, $account_name);
    $sql_profile = "UPDATE $table_employer_company_profiles SET business_name = %s,full_business_address = %s,postcode = %s,commission_address = %s,phone = %s,fax = %s,email = %s,web = %s,company_registration_number = %s,service_provider_details = %s,bank_name = %s,bank_address = %s,bank_postcode = %s,country_id = %d,sort_code = %s,iban_number = %s,account_name = %s WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
    //$profile_id = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM $table_employer_company_profiles WHERE user_id = %d", $user_id ) );
    //$profile_id = $profile_id->id;
}