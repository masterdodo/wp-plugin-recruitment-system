<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-employer-individual']))
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

    if(isset($_POST['sname']))
    {
        $name = wpja_sanitize_check($_POST['sname']);
    }
    if(isset($_POST['surname']))
    {
        $surname = wpja_sanitize_check($_POST['surname']);
    }
    if(isset($_POST['passport_number']))
    {
        $passport_number = wpja_sanitize_check($_POST['passport_number']);
    }
    if(isset($_POST['email']))
    {
        $email = wpja_sanitize_check($_POST['email']);
    }
    if(isset($_POST['gender']))
    {
        $gender = wpja_sanitize_check($_POST['gender']);
    }
    else
    {
        $gender = '';
    }
    if(isset($_POST['address']))
    {
        $address = wpja_sanitize_check($_POST['address']);
    }
    if(isset($_POST['town']))
    {
        $town = wpja_sanitize_check($_POST['town']);
    }
    if(isset($_POST['postcode']))
    {
        $postcode = wpja_sanitize_check($_POST['postcode']);
    }
    if(isset($_POST['country']))
    {
        $country_id = wpja_sanitize_check($_POST['country']);
    }
    else
    {
        $country_id = null;
    }
    if(isset($_POST['country_origin']))
    {
        $country_origin_id = wpja_sanitize_check($_POST['country_origin']);
    }
    else
    {
        $country_origin_id = null;
    }
    if(isset($_POST['tel_land_line']))
    {
        $tel_land_line = wpja_sanitize_check($_POST['tel_land_line']);
    }
    if(isset($_POST['tel_mobile']))
    {
        $tel_mobile = wpja_sanitize_check($_POST['tel_mobile']);
    }
    if(isset($_POST['date_of_birth']))
    {
        $date_of_birth = wpja_sanitize_check($_POST['date_of_birth']);
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($name, $surname, $passport_number, $email, $gender, $address, $town, $postcode, $country_id, $country_origin_id, $tel_land_line, $tel_mobile, $date_of_birth);
    $sql_profile = "UPDATE $table_employer_individual_profiles SET name = %s,surname = %s,passport_number = %s,email = %s,gender = %s,address = %s,town = %s,postcode = %s,country_id = %d,country_origin_id = %d,tel_land_line = %s,tel_mobile = %s,date_of_birth = %s WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
    //$profile_id = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM $table_employer_individual_profiles WHERE user_id = %d", $user_id ) );
    //$profile_id = $profile_id->id;
}
