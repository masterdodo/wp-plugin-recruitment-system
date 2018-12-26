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
<td>Articles of Association</td>
<td>Certificate of Incorporation</td>
<td>Memorandum of Association</td>
<td>Telephone Bill</td>
<td>Bank Account Statement</td>
<td>Electricity Bill</td>
<td>Telephone Bill 1</td>
<td>Lease Rent Agreement</td>
<td>Other Document</td>
<td>Police Conduct for Directors</td>
<td>All Directors Passports</td>
</thead>
<tbody>';
$sql_profiles = "SELECT * FROM $table_agent_company_profiles";
$result_profiles = $wpdb->get_results($sql_profiles, ARRAY_A);
foreach($result_profiles as $row)
{
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['business_name'] . '</td>';
    echo '<td>' . $row['full_business_address'] . '</td>';
    echo '<td>' . $row['postcode'] . '</td>';
    echo '<td>' . $row['commission_address'] . '</td>';
    echo '<td>' . $row['phone'] . '</td>';
    echo '<td>' . $row['fax'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['web'] . '</td>';
    echo '<td>' . $row['company_registration_number'] . '</td>';
    echo '<td><a href="' . $row['articles_of_association_url'] . '">Articles of Association</a></td>';
    echo '<td><a href="' . $row['certificate_of_incorporation_url'] . '">Certificate of Incorporation</a></td>';
    echo '<td><a href="' . $row['memorandum_of_association_url'] . '">Memorandum of Association</a></td>';
    echo '<td><a href="' . $row['telephone_bill_url'] . '">Telephone Bill</a></td>';
    echo '<td><a href="' . $row['bank_account_statement_url'] . '">Bank Account Statement</a></td>';
    echo '<td><a href="' . $row['electricity_bill_url'] . '">Electricity Bill</a></td>';
    echo '<td><a href="' . $row['telephone_bill1_url'] . '">Telephone Bill 1</a></td>';
    echo '<td><a href="' . $row['lease_rent_agreement_url'] . '">Lease Rent Agreement</a></td>';
    echo '<td><a href="' . $row['other_document_url'] . '">Other Document</a></td>';
    echo '<td><a href="' . $row['police_conduct_for_directors_url'] . '">Police Conduct for Directors</a></td>';
    echo '<td><a href="' . $row['all_directors_passports_url'] . '">All Directors Passports</a></td>';
    echo '</tr>';
}
echo '</tbody></table>';