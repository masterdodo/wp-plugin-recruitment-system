<?php
/**
* @package JobApplicaions
*/
/*
Plugin name: Job Applications
Plugin URI: https://github.com/masterdodo/wp-plugin-job-applications
Description: This is a plugin that allows you to manage job applications.
Version: 1.0
Author: DA
Licence: GPLv3 or later
Text domain: wp-plugin-job-applications
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright (C) 2018  DA
*/

defined('ABSPATH') or die('You don\t have access to this file!');

class wpja_JobApplications
{
    function __construct()
    {
        $this->wpja_create_custom_admin_menu();
        $this->wpja_create_custom_user_roles();
    }

    function wpja_register()
    {
        add_action('wp_enqueue_scripts',array($this, 'wpja_enqueue'));
        add_action('admin_enqueue_scripts',array($this, 'wpja_enqueue'));
        add_action('init', array($this, 'wpja_submit_forms'));
        add_action('admin_post_submit-login', array($this, 'wpja_login_submit'));
        add_shortcode('job_application_form', array($this, 'wpja_application_form'));
        add_shortcode('job_application_table_all', array($this, 'wpja_table_all'));
        add_shortcode('job_application_signup', array($this, 'wpja_signup'));
        add_shortcode('job_application_login', array($this, 'wpja_login'));
        add_shortcode('job_application_profile', array($this, 'wpja_profile_determination'));
        add_shortcode('job_application_agent_add_jobseeker', array($this, 'wpja_agents_add_jobseeker'));
        add_shortcode('job_application_show_jobseekers', array($this, 'wpja_show_jobseekers'));
        add_shortcode('job_application_show_employers', array($this, 'wpja_show_employers'));
    }

    function wpja_activate()
    {
        $this->wpja_custom_admin_menu();
        $this->wpja_create_custom_user_roles();
        $this->wpja_create_custom_db_tables();
        flush_rewrite_rules();
    }

    function wpja_deactivate()
    {
        flush_rewrite_rules();
    }

    protected function wpja_create_custom_admin_menu()
    {
        add_action('admin_menu', array($this, 'wpja_custom_admin_menu'));
    }

    public function wpja_custom_admin_menu()
    {
        add_menu_page( 'Job Applications', 'Job Applications', 'manage_options', 'hr-setup', array($this, 'wpja_jobseekers'), 'dashicons-clipboard');
        add_submenu_page( 'hr-setup', 'All Jobseekers', 'All Jobseekers', 'manage_options', 'hr-setup', array($this, 'wpja_jobseekers') );
        add_submenu_page( 'hr-setup', 'All Employers (Company)', 'All Employers (Company)', 'manage_options', 'hr-setup-employers-company', array($this, 'wpja_employers_company') );
        add_submenu_page( 'hr-setup', 'All Employers (Individual)', 'All Employers (Individual)', 'manage_options', 'hr-setup-employers-individual', array($this, 'wpja_employers_individual') );
        add_submenu_page( 'hr-setup', 'All Agents (Company)', 'All Agents (Company)', 'manage_options', 'hr-setup-agents-company', array($this, 'wpja_agents_company') );
        add_submenu_page( 'hr-setup', 'All Agents (Individual)', 'All Agents (Individual)', 'manage_options', 'hr-setup-agents-individual', array($this, 'wpja_agents_individual') );
        add_submenu_page( 'hr-setup', 'All Agents (Family Member)', 'All Agents (Family Member)', 'manage_options', 'hr-setup-agents-family-member', array($this, 'wpja_agents_family_member') );
        add_submenu_page( 'hr-setup', 'All Agents (Part. Firm)', 'All Agents (Part. Firm)', 'manage_options', 'hr-setup-agents-firm', array($this, 'wpja_agents_firm') );
        add_submenu_page( 'hr-setup', 'Manage Vehicles', 'Manage Vehicles', 'manage_options', 'hr-setup-vehicles', array($this,'wpja_add_vehicle') );
    }

    public function wpja_create_custom_user_roles()
    {
        add_role(
            'jobseeker',
            __( 'Jobseeker' ),
            array(
                'read'         => true,
                'edit_posts'   => false,
            )
        );
        add_role(
            'employer',
            __( 'Employer' ),
            array(
                'read'         => true,
                'edit_posts'   => false,
            )
        );
        add_role(
            'agent',
            __( 'Agent' ),
            array(
                'read'         => true,
                'edit_posts'   => false,
            )
        );
    }

    function wpja_enqueue()
    {
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/css/main.css',__FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/js/main.js',__FILE__));
    }

    function wpja_create_custom_db_tables()
    {
        require_once 'plugin-functions/create_tables.php';
    }

    function wpja_add_vehicle()
    {
        global $wpdb;
        $table_vehicles = $wpdb->prefix . "wpja_vehicles";
        require_once 'plugin-functions/add_vehicle.php';
    }

    function wpja_jobseekers()
    {
        global $wpdb;
        $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
        $table_countries = $wpdb->prefix . "wpja_countries";
        $table_education_levels = $wpdb->prefix . "wpja_education_levels";
        require_once 'plugin-functions/jobseekers_page.php';
    }

    function wpja_employers_company()
    {
        global $wpdb;
        $table_employer_company_profiles = $wpdb->prefix . "wpja_employer_company_profiles";
        $table_countries = $wpdb->prefix . "wpja_countries";
        require_once 'plugin-functions/employers_company_page.php';
    }

    function wpja_employers_individual()
    {
        global $wpdb;
        $table_employer_individual_profiles = $wpdb->prefix . "wpja_employer_individual_profiles";
        $table_countries = $wpdb->prefix . "wpja_countries";
        require_once 'plugin-functions/employers_individual_page.php';
    }

    function wpja_agents_company()
    {
        global $wpdb;
        $table_agent_company_profiles = $wpdb->prefix . "wpja_agent_company_profiles";
        require_once 'plugin-functions/agents_company_page.php';
    }

    function wpja_agents_individual()
    {
        global $wpdb;
        $table_agent_individual_profiles = $wpdb->prefix . "wpja_agent_individual_profiles";
        require_once 'plugin-functions/agents_individual_page.php';
    }

    function wpja_agents_family_member()
    {
        global $wpdb;
        $table_agent_family_member_profiles = $wpdb->prefix . "wpja_agent_family_member_profiles";
        require_once 'plugin-functions/agents_family_member_page.php';
    }

    function wpja_agents_firm()
    {
        global $wpdb;
        $table_agent_partnership_firm_profiles = $wpdb->prefix . "wpja_agent_partnership_firm_profiles";
        require_once 'plugin-functions/agents_firm_page.php';
    }

    function wpja_agents_add_jobseeker()
    {
        global $wpdb;
        $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
        $table_countries = $wpdb->prefix . "wpja_countries";
        $table_education_levels = $wpdb->prefix . "wpja_education_levels";
        require_once 'frontend_files/agents_add_jobseeker.php';
        return $string;
    }

    function wpja_show_jobseekers()
    {
        global $wpdb;
        $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
        $table_countries = $wpdb->prefix . "wpja_countries";
        $table_education_levels = $wpdb->prefix . "wpja_education_levels";
        require_once 'frontend_files/show_jobseekers.php';
        return $string;
    }

    function wpja_show_employers()
    {
        global $wpdb;
        $table_employer_company_profiles = $wpdb->prefix . "wpja_employer_company_profiles";
        $table_employer_individual_profiles = $wpdb->prefix . "wpja_employer_individual_profiles";
        $table_countries = $wpdb->prefix . "wpja_countries";
        require_once 'frontend_files/show_employers.php';
        return $string;
    }

    function wpja_table_all()
    {
        global $wpdb;
        $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
        $table_education_levels = $wpdb->prefix . "wpja_education_levels";
        $table_countries = $wpdb->prefix . "wpja_countries";
        require_once 'frontend_files/table_all.php';
        return $string;
    }
    function wpja_table_single($id = 0)
    {
        global $wpdb;
        $table_applications = $wpdb->prefix . "job_applications";
        $table_positions = $wpdb->prefix . "job_applications_positions";
        $table_education_levels = $wpdb->prefix . "job_applications_education_levels";
        $table_countries = $wpdb->prefix . "job_applications_countries";
        $position_id = $id['id'];
        require_once 'frontend_files/table_single.php';
    }
    
    function wpja_signup()
    {
        require_once 'frontend_files/signup.php';
        return $string;
    }

    function wpja_login()
    {
        require_once 'frontend_files/login.php';
        return $string;
    }

    function wpja_submit_forms()
    {
        if(isset($_POST['submit-jobseeker']))
        {
            global $wpdb;
            $table_driving_licences = $wpdb->prefix . "wpja_driving_licences";
            $table_jobseeker_profile_driving_licence = $wpdb->prefix . "wpja_jobseeker_profile_driving_licence";
            $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
            require_once 'plugin-functions/submit_jobseeker_profile.php';
        }
        if(isset($_POST['submit-vehicle-deletion']))
        {
            global $wpdb;
            $table_jobseeker_profile_vehicle = $wpdb->prefix . "wpja_jobseeker_profile_vehicle";
            $vehicle_id = preg_replace('/[^0-9]/', '', $_POST['submit-vehicle-deletion']);
            $prepared_vars = array( $_POST['profile_id'], $vehicle_id );
            $wpdb->query( $wpdb->prepare( "DELETE FROM $table_jobseeker_profile_vehicle WHERE jobseeker_profile_id = %d AND vehicle_id = %d", $prepared_vars ) );
        }
        if(isset($_POST['submit-work-experience']))
        {
            global $wpdb;
            $table_work_experiences = $wpdb->prefix . "wpja_work_experiences";
            require_once 'plugin-functions/submit_work_experience.php';
        }
        if(isset($_POST['submit-work-experience-deletion']))
        {
            global $wpdb;
            $table_work_experiences = $wpdb->prefix . "wpja_work_experiences";
            $work_experiences_id = preg_replace('/[^0-9]/', '', $_POST['submit-work-experience-deletion']);
            $wpdb->query( $wpdb->prepare( "DELETE FROM $table_work_experiences WHERE id = %d", $work_experiences_id ) );
        }
        if(isset($_POST['submit-education-course']))
        {
            global $wpdb;
            $table_work_experiences = $wpdb->prefix . "wpja_education";
            require_once 'plugin-functions/submit_education_course.php';
        }
        if(isset($_POST['submit-education-course-deletion']))
        {
            global $wpdb;
            $table_education_courses = $wpdb->prefix . "wpja_education";
            $education_course_id = preg_replace('/[^0-9]/', '', $_POST['submit-education-course-deletion']);
            $wpdb->query( $wpdb->prepare( "DELETE FROM $table_education_courses WHERE id = %d", $education_course_id ) );
        }
        if(isset($_POST['submit-agent-individual']))
        {
            global $wpdb;
            $table_agent_individual_profiles = $wpdb->prefix . "wpja_agent_individual_profiles";
            require_once 'plugin-functions/submit_agent_individual_profile.php';
        }
        if(isset($_POST['submit-agent-company']))
        {
            global $wpdb;
            $table_agent_company_profiles = $wpdb->prefix . "wpja_agent_company_profiles";
            require_once 'plugin-functions/submit_agent_company_profile.php';
        }
        if(isset($_POST['submit-agent-partnership-firm']))
        {
            global $wpdb;
            $table_agent_partnership_firm_profiles = $wpdb->prefix . "wpja_agent_partnership_firm_profiles";
            require_once 'plugin-functions/submit_agent_partnership_firm_profile.php';
        }
        if(isset($_POST['submit-agent-family-member']))
        {
            global $wpdb;
            $table_agent_family_member_profiles = $wpdb->prefix . "wpja_agent_family_member_profiles";
            require_once 'plugin-functions/submit_agent_family_member_profile.php';
        }
        if(isset($_POST['submit-employer-individual']))
        {
            global $wpdb;
            $table_employer_individual_profiles = $wpdb->prefix . "wpja_employer_individual_profiles";
            require_once 'plugin-functions/submit_employer_individual_profile.php';
        }
        if(isset($_POST['submit-employer-company']))
        {
            global $wpdb;
            $table_employer_company_profiles = $wpdb->prefix . "wpja_employer_company_profiles";
            require_once 'plugin-functions/submit_employer_company_profile.php';
        }
        if(isset($_POST['submit-attachment']))
        {
            $plugin_url = plugin_dir_url(__FILE__);
            require_once 'plugin-functions/submit_attachment.php';
        }
        if(isset($_POST['submit-login']))
        {
            require_once 'plugin-functions/login.php';
        }
        if(isset($_POST['submit-signup']))
        {
            require_once 'plugin-functions/signup.php';
        }
    }

    function wpja_profile_determination()
    {
        if( is_user_logged_in() )
        {
            $user = wp_get_current_user();
            $role = ( array ) $user->roles;
            $role = $role[0];
            if ($role == 'jobseeker' || $role == 'agent' || $role == 'employer')
            {
                if($role == 'agent')
                {
                    global $wpdb;
                    $table_partners_profiles = $wpdb->prefix . "wpja_partners_profiles";
                    $table_ac_partners_profiles = $wpdb->prefix . "wpja_ac_partners_profiles";
                    $table_agent_profiles = $wpdb->prefix . "wpja_agent_profiles";
                    $table_agent_individual_profiles = $wpdb->prefix . "wpja_agent_individual_profiles";
                    $table_agent_company_profiles = $wpdb->prefix . "wpja_agent_company_profiles";
                    $table_agent_partnership_firm_profiles = $wpdb->prefix . "wpja_agent_partnership_firm_profiles";
                    $table_agent_family_member_profiles = $wpdb->prefix . "wpja_agent_family_member_profiles";
                    require_once 'plugin-functions/agent_profile.php';
                    return $string;
                }
                else if($role == 'employer')
                {
                    global $wpdb;
                    $table_director_profiles = $wpdb->prefix . "wpja_director_profiles";
                    $table_job_positions = $wpdb->prefix . "wpja_job_positions";
                    $table_job_preferences = $wpdb->prefix . "wpja_job_preferences";
                    $table_job_titles = $wpdb->prefix . "wpja_job_titles";
                    $table_employer_company_profile_job_preference = $wpdb->prefix . "wpja_employer_company_profile_job_preference";
                    $table_employer_individual_profile_job_preference = $wpdb->prefix . "wpja_employer_individual_profile_job_preference";
                    $table_countries = $wpdb->prefix . "wpja_countries";
                    $table_employer_profiles = $wpdb->prefix . "wpja_employer_profiles";
                    $table_employer_individual_profiles = $wpdb->prefix . "wpja_employer_individual_profiles";
                    $table_employer_company_profiles = $wpdb->prefix . "wpja_employer_company_profiles";
                    require_once 'plugin-functions/employer_profile.php';
                    return $string;
                }
                else if($role == 'jobseeker')
                {
                    global $wpdb;
                    $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
                    $table_vehicles = $wpdb->prefix . "wpja_vehicles";
                    $table_countries = $wpdb->prefix . "wpja_countries";
                    $table_education_levels = $wpdb->prefix . "wpja_education_levels";
                    require_once 'plugin-functions/jobseeker_profile.php';
                    return $string;
                }
            }
            else
            {
                return '<p>You are not logged in as a Jobseeker, Employer or an Agent.</p>';
            }
        }
        else
        {
            return '<p>Please Log In.</p>';
        }
    }
}

if(class_exists('wpja_JobApplications'))
{
    $jobApplications = new wpja_JobApplications();
    $jobApplications->wpja_register();
}

register_activation_hook(__FILE__,array($jobApplications,'wpja_activate'));

register_deactivation_hook(__FILE__,array($jobApplications,'wpja_deactivate'));

register_uninstall_hook( 'uninstall.php', 'wpja_uninstall' );
