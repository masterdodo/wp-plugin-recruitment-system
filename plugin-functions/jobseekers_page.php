<?php
echo '<table>
<thead>
<td>ID</td>
<td>Name</td>
<td>Surname</td>
<td>Passport Number</td>
<td>Email</td>
<td>Gender</td>
<td>Address</td>
<td>Town</td>
<td>Postcode</td>
<td>Country</td>
<td>Country of Origin</td>
<td>Tel Land Line</td>
<td>Tel Mobile</td>
<td>Date of Birth</td>
<td>Education Level</td>
<td>CV/Resume</td>
<td>Identity Card</td>
<td>Passport</td>
<td>Driving Licence</td>
<td>International Driving Permit</td>
<td>Driving Licence Part 2</td>
<td>Education Certificate 1</td>
<td>Education Certificate 2</td>
<td>Education Certificate 3</td>
<td>Work Certificate 1</td>
<td>Work Certificate 2</td>
<td>Work Certificate 3</td>
<td>Police Conduct</td>
</thead>
<tbody>';
$sql_profiles = "SELECT * FROM $table_jobseeker_profiles";
$result_profiles = $wpdb->get_results($sql_profiles, ARRAY_A);
foreach($result_profiles as $row)
{
    $sql_countries = "SELECT * FROM $table_countries";
    $result_countries = $wpdb->get_results($sql_countries, ARRAY_A);
    $country_name = 'Error!';
    $country_origin_name = 'Error!';
    foreach($result_countries as $country)
    {
        if($country['id'] == $row['country_id'])
        {
            $country_name = $country['country_name'];
        }
        if($country['id'] == $row['country_origin_id'])
        {
            $country_origin_name = $country['country_name'];
        }
    }
    $sql_education_levels = "SELECT * FROM $table_education_levels";
    $result_education_levels = $wpdb->get_results($sql_education_levels, ARRAY_A);
    $education_level_name = 'Error!';
    foreach($result_education_levels as $education_level)
    {
        if($education_level['id'] == $row['education_level_id'])
        {
            $education_level_name = $education_level['name'];
        }
    }
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['surname'] . '</td>';
    echo '<td>' . $row['passport_number'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['gender'] . '</td>';
    echo '<td>' . $row['address'] . '</td>';
    echo '<td>' . $row['town'] . '</td>';
    echo '<td>' . $row['postcode'] . '</td>';
    echo '<td>' . $country_name . '</td>';
    echo '<td>' . $country_origin_name . '</td>';
    echo '<td>' . $row['tel_land_line'] . '</td>';
    echo '<td>' . $row['tel_mobile'] . '</td>';
    echo '<td>' . $row['date_of_birth'] . '</td>';
    echo '<td>' . $education_level_name . '</td>';
    echo '<td><a href="' . $row['cv_resume_url'] . '">CV/Resume</a></td>';
    echo '<td><a href="' . $row['identity_card_url'] . '">Identity Card</a></td>';
    echo '<td><a href="' . $row['passport_url'] . '">Passport</a></td>';
    echo '<td><a href="' . $row['driving_licence_url'] . '">Driving Licence</a></td>';
    echo '<td><a href="' . $row['international_driving_permit_url'] . '">International Driving Permit</a></td>';
    echo '<td><a href="' . $row['driving_licence_2nd_part_url'] . '">Driving Licence Part 2</a></td>';
    echo '<td><a href="' . $row['education_certificate1_url'] . '">Education Certificate 1</a></td>';
    echo '<td><a href="' . $row['education_certificate2_url'] . '">Education Certificate 2</a></td>';
    echo '<td><a href="' . $row['education_certificate3_url'] . '">Education Certificate 3</a></td>';
    echo '<td><a href="' . $row['work_certificate1_url'] . '">Work Certificate 1</a></td>';
    echo '<td><a href="' . $row['work_certificate2_url'] . '">Work Certificate 2</a></td>';
    echo '<td><a href="' . $row['work_certificate3_url'] . '">Work Certificate 3</a></td>';
    echo '<td><a href="' . $row['police_conduct_url'] . '">Police Conduct</a></td>';
    echo '</tr>';
}
echo '</tbody></table>';