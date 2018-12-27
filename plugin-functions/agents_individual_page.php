<?php
if ( ! defined( 'ABSPATH' ) ) exit;
echo '<table>
<thead>
<td>ID</td>
<td>Name</td>
<td>Surname</td>
<td>Email</td>
<td>Passport</td>
<td>Driving Licence</td>
<td>Ration Card with Photo</td>
<td>Bank AC Pass Book with Photo</td>
<td>Bank Account Statement</td>
<td>Birth Certificate</td>
<td>Electricity Bill</td>
<td>Rent Agreement</td>
<td>Police Conduct</td>
</thead>
<tbody>';
$sql_profiles = "SELECT * FROM $table_agent_individual_profiles";
$result_profiles = $wpdb->get_results($sql_profiles, ARRAY_A);
foreach($result_profiles as $row)
{
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['surname'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td><a href="' . $row['passport_url'] . '">Passport</a></td>';
    echo '<td><a href="' . $row['driving_licence_url'] . '">Driving Licence</a></td>';
    echo '<td><a href="' . $row['ration_card_with_photo_url'] . '">Ration Card with Photo</a></td>';
    echo '<td><a href="' . $row['bank_ac_pass_book_with_photo_url'] . '">Bank AC Pass Book with Photo</a></td>';
    echo '<td><a href="' . $row['bank_account_statement_url'] . '">Bank Account Statement</a></td>';
    echo '<td><a href="' . $row['birth_certificate_url'] . '">Birth Certificate</a></td>';
    echo '<td><a href="' . $row['electricity_bill_url'] . '">Electricity Bill</a></td>';
    echo '<td><a href="' . $row['rent_agreement_url'] . '">Rent Agreement</a></td>';
    echo '<td><a href="' . $row['police_conduct_url'] . '">Police Conduct</a></td>';
    echo '</tr>';
}
echo '</tbody></table>';