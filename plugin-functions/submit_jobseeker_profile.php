<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-jobseeker']))
{
    global $wpdb;
    $table_jobseeker_profile_vehicle = $wpdb->prefix . "wpja_jobseeker_profile_vehicle";
    $table_vehicles = $wpdb->prefix . "wpja_vehicles";
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
    if(isset($_POST['education']))
    {
        $education_level_id = wpja_sanitize_check($_POST['education']);
    }
    else
    {
        $education_level_id = null;
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $prepare_vars = array($name, $surname, $passport_number, $email, $gender, $address, $town, $postcode, $country_id, $country_origin_id, $tel_land_line, $tel_mobile, $date_of_birth, $education_level_id);
    $sql_profile = "UPDATE $table_jobseeker_profiles SET name = %s,surname = %s,passport_number = %s,email = %s,gender = %s,address = %s,town = %s,postcode = %s,country_id = %d,country_origin_id = %d,tel_land_line = %s,tel_mobile = %s,date_of_birth = %s,education_level_id = %d WHERE user_id = $user_id";
    $result_profile = $wpdb->query( $wpdb->prepare( $sql_profile, $prepare_vars ) );
    $profile_id = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM $table_jobseeker_profiles WHERE user_id = %d", $user_id ) );
    $profile_id = $profile_id->id;

        for($count = 0; $count < 16; $count++)
        {
        	$string = "driving_licence".$count."a";
        	if (isset( $_POST[$string] ) && $_POST[$string] != '' )
        	{
                $prepared_vars = array($profile_id, $count);
                $result = $wpdb->query( $wpdb->prepare( "SELECT id FROM $table_jobseeker_profile_driving_licence WHERE (jobseeker_profile_id = %d) AND (driving_licence_id = %d)", $prepared_vars ) );
                if(!$result)
                {
                    $sql_prepare_values = array($profile_id, $count);
        		    $sql_driving_licence = "INSERT INTO $table_jobseeker_profile_driving_licence(jobseeker_profile_id, driving_licence_id) VALUES(%d,%d)";
                    $result_driving_licence = $wpdb->query($wpdb->prepare($sql_driving_licence, $sql_prepare_values));
                }
            }
            else
            {
                $prepared_vars = array($profile_id, $count);
                $wpdb->query( $wpdb->prepare( "DELETE FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d AND driving_licence_id = %d", $prepared_vars ) );
            }
        }
    $vehicle_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_vehicles" );
        for ($count = 1; $count < $vehicle_count; $count++)
        {
            $string = "vehicle".$count."a";
        	if ( isset( $_POST[$string] ) && $_POST[$string] != '' )
        	{
                $sql_prepare_values = array($profile_id, $_POST[$string]);
                $if_already_exists = $wpdb->get_results( $wpdb->prepare( "SELECT id FROM $table_jobseeker_profile_vehicle WHERE jobseeker_profile_id = %d AND vehicle_id = %d", $sql_prepare_values ) );
                if( ! $if_already_exists )
                {
        	        $sql_vehicle = "INSERT INTO $table_jobseeker_profile_vehicle(jobseeker_profile_id, vehicle_id) VALUES(%d,%d)";
                    $result_vehicle = $wpdb->query($wpdb->prepare($sql_vehicle, $sql_prepare_values));
                }
        	}
        }

}
