<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$string = '<div >
<form id="wpja-application-form" method="post">';
$user_id = get_current_user_id();
$result_profile = $wpdb->get_row( "SELECT * FROM $table_employer_individual_profiles WHERE user_id = $user_id" );
$string .= '<div id="wpja-identification">
<p><b>IDENTIFICATION</b></p>
<table>
<tr><td><label for="sname">Name</label></td>
<td><input class="wpja-input" id="sname" type="text" name="sname" maxlength="100" value="'; 
$string .= $result_profile->name;
$string .= '"></td></tr>
<tr><td><label for="surname">Surname</label></td>
<td><input class="wpja-input" id="surname" type="text" name="surname" maxlength="100" value="'; 
$string .= $result_profile->surname;
$string .= '"></td></tr>
<tr><td><label for="passport_number">Passport number</label></td>
<td><input class="wpja-input" id="passport_number" type="text" name="passport_number" maxlength="100" value="'; 
$string .= $result_profile->passport_number;
$string .= '"></td></tr>
<tr><td><label for="email">Email</label></td>
<td><input class="wpja-input" id="email" type="email" name="email" maxlength="100" value="'; 
$string .= $result_profile->email;
$string .= '"></td></tr>
</table>
</div>
<div id="wpja-personal">
<p><b>PERSONAL INFORMATION</b></p>
<table>
<tr><td><label>Gender</label></td>
<td><input class="wpja-width-reset" ';
if($result_profile->gender == 'male')
{
      $string .= 'checked';
}
$string .= ' type="radio" name="gender" value="male"> Male <input class="wpja-width-reset" ';
if($result_profile->gender == 'female')
{
      $string .= 'checked';
}
$string .= ' type="radio" name="gender" value="female"> Female</td></tr>
<tr><td><label for="address">Address</label></td>
<td><input class="wpja-input" id="address" type="text" name="address" maxlength="100" value="'; 
$string .= $result_profile->address;
$string .= '"></td></tr>
<tr><td><label for="town">Town</label></td>
<td><input class="wpja-input" id="town" type="text" name="town" maxlength="100" value="'; 
$string .= $result_profile->town;
$string .= '"></td></tr>
<tr><td><label for="postcode">Postcode</label></td>
<td><input class="wpja-input" id="postcode" type="text" name="postcode" maxlength="16" value="'; 
$string .= $result_profile->postcode;
$string .= '"></td></tr>
<tr><td><label for="country">Country</label></td>
<td><select class="wpja-input" id="country" name="country" class="dropdown-menu">
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
<tr><td><label for="country_origin">Country of Origin</label></td>
<td><select class="wpja-input" id="country_origin" name="country_origin" class="dropdown-menu" maxlength="74">
<option disabled selected value="">--choose country of origin--</option>';
global $wpdb;
$sql = "SELECT * FROM $table_countries";
$result = $wpdb->get_results($sql, ARRAY_A);
foreach($result as $row)
{
$string .= '<option ';
if($row['id'] == $result_profile->country_origin_id)
{
      $string .= 'selected';
}
$string .= ' value="'.esc_html($row['id']).'">'.esc_html($row['country_name']).'</option>';
}
$string .= '</select></td></tr>
<tr><td><label for="tel_land_line">Tel Land Line</label></td>
<td><input class="wpja-input" id="tel_land_line" type="number" name="tel_land_line" placeholder="example" maxlength="20" value="'; 
$string .= $result_profile->tel_land_line;
$string .= '"></td></tr>
<tr><td><label for="tel_mobile">Tel Mobile</label></td>
<td><input class="wpja-input" id="tel_mobile" type="number" name="tel_mobile" placeholder="0038641285906" maxlength="20" value="'; 
$string .= $result_profile->tel_mobile;
$string .= '"></td></tr>
<tr><td><label for="date_of_birth">Date of Birth</label></td>
<td><input class="wpja-input" id="date_of_birth" type="date" name="date_of_birth" maxlength="10" value="'; 
$date = $result_profile->date_of_birth;
$date = new DateTime($date);
$date = $date->format('Y-m-d');
$string .= $date;
$string .= '"></td></tr></table>
<input name="submit-employer-individual" type="submit" value="Edit Profile">
</form></div>';