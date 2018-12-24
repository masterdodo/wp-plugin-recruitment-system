<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if(isset($_POST['submit-login']))
{
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['passwd']);
    if($username == '' || $password == '')
    {
        exit;
    }
    else
    {
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
                    clean_user_cache( $user->ID );
                    wp_clear_auth_cookie();
                    wp_set_current_user( $user->ID );
                    if (wp_validate_auth_cookie()==FALSE)
                    {
                        wp_set_auth_cookie( $user->ID, true, false );
                    }
                    update_user_caches($user);
            
                    if(is_user_logged_in())
                    {
                        $current_user = wp_get_current_user();
                        echo 'Username: ' . $current_user->user_login . '<br />';
                        $redirect_page = get_page_by_title('home');
                        wp_safe_redirect( get_permalink($redirect_page->ID) );
                        exit;
                    }
                }
            }
        }
    }
}