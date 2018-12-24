<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_POST['submit-attachment']))
{
    global $wpdb;
    $profile_id = sanitize_text_field($_POST['profile_id']);
    $attachment_name = sanitize_text_field($_POST['attachment_name']);
    $profile_type = sanitize_text_field($_POST['profile_type']);

    if($profile_id > 0)
    {}
    else
    {
        $profile_id = false;
    }

    $my_plugin = WP_PLUGIN_DIR . '/job-applications/';
    $dir = $my_plugin . "attachments/" . $profile_type . "/" . $profile_id . "/";
    $url = $plugin_url . "attachments/" . $profile_type . "/" . $profile_id . "/";
    if (!file_exists($dir))
    {
    	mkdir($dir, 0777, true);
    }

    if($profile_id)
    {
        if (isset ($_FILES['attachment']))
        {
            $attachment_path = $wpdb->get_row("SELECT $attachment_name as attachment_url FROM $profile_type WHERE id = $profile_id", ARRAY_A);
            if($attachment_path['attachment_url'])
            {
                $attachment_path = $attachment_path['attachment_url'];
                $ext = explode('.', $attachment_path);
                $ext = $ext[count($ext) - 1];
                $wpdb->query("UPDATE $profile_type SET $attachment_name = NULL WHERE id = $profile_id");
                $delete_target_file = $dir . $attachment_name . "." . $ext;
                chmod($delete_target_file, 0777);
                unlink($delete_target_file);
            }
            $target_file = $dir . $attachment_name . "." . pathinfo($_FILES['attachment']['name'],PATHINFO_EXTENSION);
            $target_url = $url . $attachment_name . "." . pathinfo($_FILES['attachment']['name'],PATHINFO_EXTENSION);
            $sql_prepare_values = array($target_url, $profile_id);
            $sqlfiles = "UPDATE $profile_type SET $attachment_name = %s WHERE id = %d";
            $resultfiles = $wpdb->query($wpdb->prepare($sqlfiles, $sql_prepare_values));
            $attachment_result = move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
        }
    }
}
