<?php
echo '<table>
<thead>
<td>ID</td>
<td>Bussiness Name</td>
<td>Full Bussiness Address</td>
<td>Postcode</td>
<td>Commission Address</td>
<td>Phone</td>
<td>Fax</td>
<td>Email</td>
<td>Web</td>
<td>Company Registration Number</td>
<td>Service Provider Details</td>
<td>Bank Name</td>
<td>Bank Address</td>
<td>Bank Postcode</td>
<td>Country</td>
<td>Sort Code</td>
<td>IBAN Number</td>
<td>Account Name</td>
</thead>
<tbody>';
$sql_profiles = "SELECT * FROM $table_employer_company_profiles";
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
    }
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['business_name'] . '</td>';
    echo '<td>' . $row['full_bussiness_address'] . '</td>';
    echo '<td>' . $row['postcode'] . '</td>';
    echo '<td>' . $row['commission_address'] . '</td>';
    echo '<td>' . $row['phone'] . '</td>';
    echo '<td>' . $row['fax'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['web'] . '</td>';
    echo '<td>' . $row['company_registration_number'] . '</td>';
    echo '<td>' . $row['service_provider_details'] . '</td>';
    echo '<td>' . $row['bank_name'] . '</td>';
    echo '<td>' . $row['bank_address'] . '</td>';
    echo '<td>' . $row['bank_postcode'] . '</td>';
    echo '<td>' . $country_name . '</td>';
    echo '<td>' . $row['sort_code'] . '</td>';
    echo '<td>' . $row['IBAN_number'] . '</td>';
    echo '<td>' . $row['account_name'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';