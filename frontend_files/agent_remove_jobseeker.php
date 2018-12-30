<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$sql = "DELETE FROM $table_jobseeker_profiles WHERE id = %d";
$wpdb->query( $wpdb->prepare( $sql, $_POST['profile_id'] ) );

echo "<script type='text/javascript'>
        window.location=document.location.href;
        </script>";