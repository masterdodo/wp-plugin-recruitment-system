<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$user_id = get_current_user_id();
$result_profile = $wpdb->get_row( "SELECT * FROM $table_employer_company_profiles WHERE user_id = $user_id" );
$string = '<form method="post">
<div id="wpja-identification">
<p><b>IDENTIFICATION</b></p>
        <table>
        <tr><td><label for="business_name">Business Name</label></td>
        <td><input class="wpja-input" id="business_name" type="text" name="business_name" maxlength="100" value="'; 
        $string .= $result_profile->business_name;
        $string .= '"></td></tr>
        <tr><td><label for="full_business_address">Full Business Address</label></td>
        <td><input class="wpja-input" id="full_business_address" type="text" name="full_business_address" maxlength="100" value="'; 
        $string .= $result_profile->full_business_address;
        $string .= '"></td></tr>
        <tr><td><label for="postcode">Postcode</label></td>
        <td><input class="wpja-input" id="postcode" type="text" name="postcode" maxlength="100" value="'; 
        $string .= $result_profile->postcode;
        $string .= '"></td></tr>
        <tr><td><label for="commission_address">Commission Address</label></td>
        <td><input class="wpja-input" id="commission_address" type="text" name="commission_address" maxlength="100" value="'; 
        $string .= $result_profile->commission_address;
        $string .= '"></td></tr>
        <tr><td><label for="phone">Phone</label></td>
        <td><input class="wpja-input" id="phone" type="text" name="phone" maxlength="100" value="'; 
        $string .= $result_profile->phone;
        $string .= '"></td></tr>
        <tr><td><label for="fax">Fax</label></td>
        <td><input class="wpja-input" id="fax" type="text" name="fax" maxlength="100" value="'; 
        $string .= $result_profile->fax;
        $string .= '"></td></tr>
        <tr><td><label for="email">Email</label></td>
        <td><input class="wpja-input" id="email" type="email" name="email" maxlength="100" value="'; 
        $string .= $result_profile->email;
        $string .= '"></td></tr>
        <tr><td><label for="web">Web</label></td>
        <td><input class="wpja-input" id="web" type="text" name="web" maxlength="100" value="'; 
        $string .= $result_profile->web;
        $string .= '"></td></tr>
        <tr><td><label for="company_registration_number">Company Registration Number</label></td>
        <td><input class="wpja-input" id="company_registration_number" type="text" name="company_registration_number" maxlength="100" value="'; 
        $string .= $result_profile->company_registration_number;
        $string .= '"></td></tr>
        <tr><td><label for="service_provider_details">Service Provider Details</label></td>
        <td><input class="wpja-input" id="service_provider_details" type="text" name="service_provider_details" maxlength="100" value="'; 
        $string .= $result_profile->service_provider_details;
        $string .= '"></td></tr>
        <tr><td><label for="bank_name">Bank Name</label></td>
        <td><input class="wpja-input" id="bank_name" type="text" name="bank_name" maxlength="100" value="'; 
        $string .= $result_profile->bank_name;
        $string .= '"></td></tr>
        <tr><td><label for="bank_address">Bank Address</label></td>
        <td><input class="wpja-input" id="bank_address" type="text" name="bank_address" maxlength="100" value="'; 
        $string .= $result_profile->bank_address;
        $string .= '"></td></tr>
        <tr><td><label for="bank_postcode">Bank Postcode</label></td>
        <td><input class="wpja-input" id="bank_postcode" type="text" name="bank_postcode" maxlength="100" value="'; 
        $string .= $result_profile->bank_postcode;
        $string .= '"></td></tr>
        <tr><td><label for="country">Country</label></td>
        <td><select class="wpja-input" id="country" name="country" class="dropdown-menu" maxlength="74">
        <option disabled selected value="">--choose country--</option>';
        global $wpdb;
        $sql = "SELECT * FROM $table_countries";
        $result = $wpdb->get_results($sql, ARRAY_A);
        foreach($result as $row)
        {
        $string .= '<option ';
        if($row['id'] == $result_profile->country_id)
        {
              $string .= 'selected';
        }
        $string .= ' value="'.esc_html($row['id']).'">'.esc_html($row['country_name']).'</option>';
        }
        $string .= '</select></td></tr>
        <tr><td><label for="sort_code">Sort Code</label></td>
        <td><input class="wpja-input" id="sort_code" type="text" name="sort_code" maxlength="100" value="'; 
        $string .= $result_profile->sort_code;
        $string .= '"></td></tr>
        <tr><td><label for="iban_number">IBAN Number</label></td>
        <td><input class="wpja-input" id="iban_number" type="text" name="iban_number" maxlength="100" value="'; 
        $string .= $result_profile->IBAN_number;
        $string .= '"></td></tr>
        <tr><td><label for="account_name">Account Name</label></td>
        <td><input class="wpja-input" id="account_name" type="text" name="account_name" maxlength="100" value="'; 
        $string .= $result_profile->account_name;
        $string .= '"></td></tr>
        </table>
        <input type="submit" name="submit-employer-company" value="Edit Profile">
        </div>
        </form>';