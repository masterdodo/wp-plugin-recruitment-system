<?php
if(isset($_POST['submit-work-experience']))
{
    if(isset($_POST['job_type']) && isset($_POST['position_held']) && isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['company_name']))
    {
        $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
        $user_id = get_current_user_id();
        $result_profile = $wpdb->get_row( "SELECT * FROM $table_jobseeker_profiles WHERE user_id = $user_id" );
        $jobseeker_profile_id = (int)$result_profile->id;

        $job_type_id = sanitize_text_field($_POST['job_type']);
        $position_held = sanitize_text_field($_POST['position_held']);
        $date_start = sanitize_text_field($_POST['date_start']);
        $date_end = sanitize_text_field($_POST['date_end']);
        $company_name = sanitize_text_field($_POST['company_name']);

        $table_work_experiences = $wpdb->prefix . "wpja_work_experiences";
        $safe_vars = array( $jobseeker_profile_id, $job_type_id, $position_held, $date_start, $date_end, $company_name );
        $wpdb->query( $wpdb->prepare( "INSERT INTO $table_work_experiences VALUES (null, %d, %d, %s, %s, %s, %s)", $safe_vars ) );
    }
    else
    {
        wp_safe_redirect('/');
    }
}