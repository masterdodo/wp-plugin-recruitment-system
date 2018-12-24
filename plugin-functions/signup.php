<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$table_employer_profiles = $wpdb->prefix . "wpja_employer_profiles";
$table_agent_profiles = $wpdb->prefix . "wpja_agent_profiles";
$table_agent_individual_profiles = $wpdb->prefix . "wpja_agent_individual_profiles";
$table_agent_company_profiles = $wpdb->prefix . "wpja_agent_company_profiles";
$table_agent_partnership_firm_profiles = $wpdb->prefix . "wpja_agent_partnership_firm_profiles";
$table_agent_family_member_profiles = $wpdb->prefix . "wpja_agent_family_member_profiles";
$table_employer_individual_profiles = $wpdb->prefix . "wpja_employer_individual_profiles";
$table_employer_company_profiles = $wpdb->prefix . "wpja_employer_company_profiles";
$table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";

if(isset($_POST['submit-signup']))
{
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['passwd']);
    $user_role = sanitize_text_field($_POST['role']);
    if(isset($_POST['category-agent']))
    {
        $agent_category = sanitize_text_field($_POST['category-agent']);
    }
    if(isset($_POST['category-employer']))
    {
        $employer_category = sanitize_text_field($_POST['category-employer']);
    }
    if(isset($_POST['mail']))
    {
        $email = sanitize_text_field($_POST['mail']);
    }
    else
    {
        $email = false;
    }

    if($username == '' || $password == '')
    {
        exit;
    }

    if($email == false)
    {
        $user = wp_create_user($username, $password);
        if(is_wp_error($user))
        {
            exit;
        }
        else
        {
            $u = new WP_User( $user );
            $u->set_role( $user_role );
            $u_id = $u->ID;
            if($user_role == 'agent')
            {
                $safe_vars = array($u_id, $agent_category);
                $sql = "INSERT INTO $table_agent_profiles VALUES(null,%d,%s)";
                $wpdb->query( $wpdb->prepare( $sql, $safe_vars ) );
                if($agent_category == 'individual')
                {
                    $sql = "INSERT INTO $table_agent_individual_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($agent_category == 'country')
                {
                    $sql = "INSERT INTO $table_agent_company_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($agent_category == 'partnership_firm')
                {
                    $sql = "INSERT INTO $table_agent_partnership_firm_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($agent_category == 'family_member')
                {
                    $sql = "INSERT INTO $table_agent_family_member_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
            }
            else if($user_role == 'employer')
            {
                $safe_vars = array($u_id, $employer_category);
                $sql = "INSERT INTO $table_employer_profiles VALUES(null,%d,%s)";
                $wpdb->query( $wpdb->prepare( $sql, $safe_vars ) );
                if($employer_category == 'individual')
                {
                    $sql = "INSERT INTO $table_employer_individual_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($employer_category == 'company')
                {
                    $sql = "INSERT INTO $table_employer_company_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
            }
        }
    }
    else
    {
        $user = wp_create_user($username, $password, $email);
        if(is_wp_error($user))
        {
            exit;
        }
        else
        {
            $u = new WP_User( $user );
            $u->set_role( $user_role );
            $u_id = $u->ID;
            if($user_role == 'agent')
            {
                $safe_vars = array($u_id, $agent_category);
                $sql = "INSERT INTO $table_agent_profiles VALUES(null,%d,%s)";
                $wpdb->query( $wpdb->prepare( $sql, $safe_vars ) );
                if($agent_category == 'individual')
                {
                    $sql = "INSERT INTO $table_agent_individual_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($agent_category == 'company')
                {
                    $sql = "INSERT INTO $table_agent_company_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($agent_category == 'partnership_firm')
                {
                    $sql = "INSERT INTO $table_agent_partnership_firm_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($agent_category == 'family_member')
                {
                    $sql = "INSERT INTO $table_agent_family_member_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
            }
            else if($user_role == 'employer')
            {
                $safe_vars = array($u_id, $employer_category);
                $sql = "INSERT INTO $table_employer_profiles VALUES(null,%d,%s)";
                $wpdb->query( $wpdb->prepare( $sql, $safe_vars ) );
                if($employer_category == 'individual')
                {
                    $sql = "INSERT INTO $table_employer_individual_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
                else if($employer_category == 'company')
                {
                    $sql = "INSERT INTO $table_employer_company_profiles(user_id) VALUES(%d)";
                    $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
                }
            }
            else if($user_role == 'jobseeker')
            {
                $sql = "INSERT INTO $table_jobseeker_profiles(user_id) VALUES(%d)";
                $wpdb->query( $wpdb->prepare( $sql, $u_id ) );
            }
        }
    }

    $auth = wp_authenticate($username, $password);
        if(is_wp_error($auth))
        {
            exit;
        }
        else
        {
            if(!is_user_logged_in())
            {
                if($user=get_user_by('login',$username))
                {
                    clean_user_cache($user->ID);
            
                    wp_clear_auth_cookie();
                    wp_set_current_user( $user->ID );
                    wp_set_auth_cookie( $user->ID , true, false);
            
                    update_user_caches($user);
            
                    if(is_user_logged_in())
                    {
                        $redirect_page = get_page_by_title('home');
                        wp_safe_redirect( get_permalink($redirect_page->ID) );
                        exit;
                    }
                }
            }
        }
}
