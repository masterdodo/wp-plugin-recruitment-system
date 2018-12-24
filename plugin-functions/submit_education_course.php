<?php
if(isset($_POST['submit-education-course']))
{
    if(isset($_POST['course_name']) && isset($_POST['institution_name']) && isset($_POST['date_start']) && isset($_POST['date_end']))
    {
        $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
        $user_id = get_current_user_id();
        $result_profile = $wpdb->get_row( "SELECT * FROM $table_jobseeker_profiles WHERE user_id = $user_id" );
        $jobseeker_profile_id = (int)$result_profile->id;

        $course_name = sanitize_text_field($_POST['course_name']);
        $institution_name = sanitize_text_field($_POST['institution_name']);
        $date_start = sanitize_text_field($_POST['date_start']);
        $date_end = sanitize_text_field($_POST['date_end']);

        $table_education_courses = $wpdb->prefix . "wpja_education";
        $safe_vars = array( $jobseeker_profile_id, $course_name, $date_start, $date_end, $institution_name );
        $wpdb->query( $wpdb->prepare( "INSERT INTO $table_education_courses VALUES (null, %d, %s, %s, %s, %s)", $safe_vars ) );
    }
    else
    {
        wp_safe_redirect('/');
    }
}