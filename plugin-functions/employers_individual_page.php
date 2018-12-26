<?php
echo '<table>
<thead>
<td>ID</td>
<td>Name</td>
<td>Surname</td>
<td>Email</td>
<td>Passport Number</td>
<td>Gender</td>
<td>Address</td>
<td>Town</td>
<td>Postcode</td>
<td>Country</td>
<td>Country of Origin</td>
<td>Tel Land Line</td>
<td>Tel Mobile</td>
<td>Date of Birth</td>
</thead>
<tbody>';
$sql_profiles = "SELECT * FROM $table_employer_individual_profiles";
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
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['surname'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['passport_number'] . '</td>';
    echo '<td>' . $row['gender'] . '</td>';
    echo '<td>' . $row['address'] . '</td>';
    echo '<td>' . $row['town'] . '</td>';
    echo '<td>' . $row['postcode'] . '</td>';
    echo '<td>' . $country_name . '</td>';
    echo '<td>' . $country_origin_name . '</td>';
    echo '<td>' . $row['tel_land_line'] . '</td>';
    echo '<td>' . $row['tel_mobile'] . '</td>';
    echo '<td>' . $row['date_of_birth'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';