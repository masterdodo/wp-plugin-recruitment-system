<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$agent_id = get_current_user_id();
$sql = "INSERT INTO $table_jobseeker_profiles(agent_id) VALUES(%d)";
$wpdb->query( $wpdb->prepare( $sql, $agent_id ) );
$insertid = $wpdb->insert_id;
//$jobseeker_profile_front = ABSPATH . 'wp-content\plugins\job-applications\plugin-functions\jobseeker_profile.php';


$table_driving_licences = $wpdb->prefix . "wpja_driving_licences";
$table_jobseeker_profile_vehicle = $wpdb->prefix . "wpja_jobseeker_profile_vehicle";
$table_jobseeker_profile_driving_licence = $wpdb->prefix . "wpja_jobseeker_profile_driving_licence";
$string = '<div >
<form id="wpja-application-form" method="post">';
$string .= '<input type="hidden" name="profile_id" value="'. $insertid .'">';
$profile_type = $table_jobseeker_profiles;
$result_profile = $wpdb->get_row( "SELECT * FROM $table_jobseeker_profiles WHERE id = $insertid" );
$jobseeker_profile_id = (int)$result_profile->id;
$string .= '<input type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'"><div id="wpja-identification">
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
$string .= '"></td></tr>
<tr><td><label for="education">Highest education level:</label></td>
      <td><select class="wpja-input" id="education" name="education" class="dropdown-menu" maxlength="100">
      <option disabled selected value="">--choose education level--</option>';
global $wpdb;
$sql = "SELECT * FROM $table_education_levels ORDER BY id";
$result = $wpdb->get_results($sql, ARRAY_A);
foreach($result as $row)
{
$string .= '<option ';
if($row['id'] == $result_profile->education_level_id)
{
      $string .= 'selected';
}
$string .= ' value="'.esc_html($row['id']).'">'.esc_html($row['name']).'</option>';
}
$string .= '</select></td></tr>
</table>
</div>';
$string .= '<div id="wpja-driving_licence_div">
            <p><b>DRIVING LICENCES</b></p>
            <div id="vehicles"><ul>';
      $vehicles = $wpdb->get_results( $wpdb->prepare( "SELECT vehicle_id FROM $table_jobseeker_profile_vehicle WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($vehicles as $vehicle)
      {
            $vehicle_name = $wpdb->get_row( $wpdb->prepare( "SELECT name FROM $table_vehicles WHERE id = %d", $vehicle->vehicle_id ) );
            $string .= '<li>'.$vehicle_name->name.' <input type="submit" name="submit-vehicle-deletion" value="Remove #'.$vehicle->vehicle_id.'"></li><br />';
      }
$string .=  '</ul><br /><label for="vehicle">Driving Licence (vehicle): </label>
            <select class="wpja-input" id="vehicle" name="vehicle1a" class="dropdown-menu" maxlength="100">
            <option selected value="">--choose a vehicle licence--</option>';
      $sql = "SELECT * FROM $table_vehicles";
      $result = $wpdb->get_results($sql, ARRAY_A);
      foreach($result as $row)
      {
            $string .= '<option value="'.esc_html($row['id']).'">'.esc_html($row['name']).'</option>';
      }
      global $wpdb;
      $string .= '
      </select><br />
      </div>
      <div id="driving_categories">
      <button id="wpja-addVehicleButton" type="button" onclick="AddVehicle()">Add another vehicle</button><br />
      <label>Driving licence categories: </label><br />
      AM<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'AM'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence1a" value="1"> 
      A1<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'A1'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence2a" value="2"> 
      A2<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'A2'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence3a" value="3"> 
      A<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'A'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence4a" value="4"> 
      B<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'B'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= '  class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence5a" value="5"> 
      BE<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'BE'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence6a" value="6"> 
      B1<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'B1'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence7a" value="7"> <br />
      C1<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'C1'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence8a" value="8"> 
      C1E<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'C1E'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence9a" value="9"> 
      C<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'C'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence10a" value="10"> 
      CE<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'CE'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence11a" value="11"> 
      D1<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'D1'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence12a" value="12"> 
      D1E<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'D1E'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence13a" value="13"> 
      D<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'D'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence14a" value="14"> 
      DE<input ';
      $driving_licences = $wpdb->get_results( $wpdb->prepare( "SELECT driving_licence_id FROM $table_jobseeker_profile_driving_licence WHERE jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($driving_licences as $driving_licence)
      {
            $driving_licence = $driving_licence->driving_licence_id;
            $driving_licence_id = $wpdb->get_row( "SELECT id FROM $table_driving_licences WHERE name = 'DE'" );
            $driving_licence_id = $driving_licence_id->id;
            if((int)$driving_licence == (int)$driving_licence_id)
            {
                  $string .= 'checked';
            }
      }
      $string .= ' class="wpja-width-reset wpja-driving-categories" type="checkbox" name="driving_licence15a" value="15"> 
      </div>
      </div>
      <input type="submit" name="submit-jobseeker" value="Edit Profile"></form><br />';
      $string .= '<form method="post"><div id="work_experiences"></div>
      <br /><div><p>Work Experience</p>
      <div id="work_experiences_table">
      <table><thead><td>Job Type</td><td>Start Date</td><td>Finish Date</td><td>Position Held</td><td>Company Name</td></thead><tbody>';
      $table_work_experiences = $wpdb->prefix . "wpja_work_experiences";
      $table_job_types = $wpdb->prefix . "wpja_job_types";
      $work_experiences = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_work_experiences WHERE  jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($work_experiences as $work_experience)
      {
            $job_type_name = $wpdb->get_row( $wpdb->prepare( "SELECT name FROM $table_job_types WHERE id = %d", $work_experience->job_type ) );
            $date_start = new DateTime($work_experience->date_start);
            $date_start = $date_start->format('d.m.Y');
            $date_end = new DateTime($work_experience->date_finish);
            $date_end = $date_end->format('d.m.Y');
            $string .= '<tr><td>'.$job_type_name->name.'</td><td>'.$date_start.'</td><td>'.$date_end.'</td><td>'.$work_experience->position_held.'</td><td>'.$work_experience->company_name.'</td><td><input type="submit" name="submit-work-experience-deletion" value="Remove #'.$work_experience->id.'"></td></tr>';
      }
      $string .= '</tbody></table><hr>
      </div>
      <table>
      <tr><td><label for="job_type">Job type:</label></td>
      <td><select id="job_type" name="job_type"><option value="" selected disabled>--choose a job type--</option>';
      $job_types = $wpdb->get_results( "SELECT * FROM $table_job_types" );
      foreach($job_types as $job_type)
      {
            $string .= '<option value="'.$job_type->id.'">'.$job_type->name.'</option>';
      }
      $string .= '</select></td></tr>
      <tr><td><label for="position_held">Position held:</label></td>
      <td><input type="text" id="position_held" name="position_held"></td></tr>
      <tr><td><label for="date_start">Start date:</label></td>
      <td><input type="date" id="date_start" name="date_start"></td></tr>
      <tr><td><label for="date_end">End date:</label></td>
      <td><input type="date" id="date_end" name="date_end"></td></tr>
      <tr><td><label for="company_name">Company name:</label></td>
      <td><input type="text" id="company_name" name="company_name"></td></tr>
      </table>
      <input type="submit" name="submit-work-experience" value="Submit Work Experience">
      </div></form><br />';
      $string .= '<form method="post"><div id="education_courses"></div>
      <br /><div><p>Education Courses</p>
      <div id="work_experiences_table">
      <table><thead><td>Job Type</td><td>Start Date</td><td>Finish Date</td><td>Position Held</td><td>Company Name</td></thead><tbody>';
      $table_education_courses = $wpdb->prefix . "wpja_education";
      $education_courses = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_education_courses WHERE  jobseeker_profile_id = %d", $jobseeker_profile_id ) );
      foreach($education_courses as $education_course)
      {
            $date_start = new DateTime($education_course->date_start);
            $date_start = $date_start->format('d.m.Y');
            $date_end = new DateTime($education_course->date_finish);
            $date_end = $date_end->format('d.m.Y');
            $string .= '<tr><td>'.$education_course->course_name.'</td><td>'.$date_start.'</td><td>'.$date_end.'</td><td>'.$education_course->institution_name.'</td><td><input type="submit" name="submit-education-course-deletion" value="Remove #'.$education_course->id.'"></td></tr>';
      }
      $string .= '</tbody></table><hr>
      </div>
      <table>
      <tr><td><label for="course_name">Course name:</label></td>
      <td><input type="text" id="course_name" name="course_name"></td></tr>
      <tr><td><label for="date_start">Start date:</label></td>
      <td><input type="date" id="date_start" name="date_start"></td></tr>
      <tr><td><label for="date_end">End date:</label></td>
      <td><input type="date" id="date_end" name="date_end"></td></tr>
      <tr><td><label for="institution_name">Institution name:</label></td>
      <td><input type="text" id="institution_name" name="institution_name"></td></tr>
      </table>
      <input type="submit" name="submit-education-course" value="Submit Education Course">
      </div></form><br />';
      $string .= '
      <div id="wpja-attachments">
      <p><b>ATTACHMENTS</b></p>
      <div id="wpja-attach-identification">
      <p><b>IDENTIFICATION</b></p>
      <form method="post" enctype="multipart/form-data">
      <label for="cv_resume"><b>CV/Resume</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT cv_resume_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="cv_resume_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="photo_id"><b>Identity Card</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT identity_card_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="identity_card_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="passport"><b>Passport</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT passport_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="passport_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      </div>
      <div id="wpja-driving">
      <p><b>DRIVING</b></p>
      <form method="post" enctype="multipart/form-data">
      <label for="driving_licence">Driving licence</label><br>';
      $attachment_set = $wpdb->get_row("SELECT driving_licence_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="driving_licence_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="international_driving_permit">International Driving Permit</label><br>';
      $attachment_set = $wpdb->get_row("SELECT international_driving_permit_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="international_driving_permit_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="driving_licence_part2">Driving Licence 2nd Part</label><br>';
      $attachment_set = $wpdb->get_row("SELECT driving_licence_2nd_part_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="driving_licence_2nd_part_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      </div>
      <div id="wpja-education_certs">
      <p><b>EDUCATION CERTIFICATES</b></p>
      <form method="post" enctype="multipart/form-data">
      <label for="certificate1"><b>Certificate 1</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT education_certificate1_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="education_certificate1_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="certificate2"><b>Certificate 2</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT education_certificate2_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="education_certificate2_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="certificate3">Certificate 3</label><br>';
      $attachment_set = $wpdb->get_row("SELECT education_certificate3_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment"><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="education_certificate3_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      </div>
      <div id="wpja-work_certs">
      <p><b>WORK CERTIFICATES</b></p>
      <form method="post" enctype="multipart/form-data">
      <label for="certificate1"><b>Certificate 1</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT work_certificate1_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="work_certificate1_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="certificate2"><b>Certificate 2</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT work_certificate2_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="work_certificate2_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      <form method="post" enctype="multipart/form-data">
      <label for="certificate2">Certificate 3</label><br>';
      $attachment_set = $wpdb->get_row("SELECT work_certificate3_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="work_certificate3_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      </div>
      <div id="wpja-police_cert">
      <p><b>CRIMINAL RECORD</b></p>
      <form method="post" enctype="multipart/form-data">
      <label for="police_conduct"><b>Police Conduct</b></label><br>';
      $attachment_set = $wpdb->get_row("SELECT police_conduct_url as attachment_url FROM $profile_type WHERE id = $jobseeker_profile_id", ARRAY_A);
      if($attachment_set['attachment_url'])
      {
            $string .= '<div class="wpja-attachment-set">
            <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
            </div>';
      }
      $string .= '
      <input class="wpja-input" type="file" name="attachment" required><br />
      <input class="wpja-input" type="hidden" name="profile_id" value="'.$jobseeker_profile_id.'">
      <input class="wpja-input" type="hidden" name="attachment_name" value="police_conduct_url">
      <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
      <button type="submit" name="submit-attachment">Edit Attachment</button>
      </form><br />
      </div>
      </div>
      </div>';