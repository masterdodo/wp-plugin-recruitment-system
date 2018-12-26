<?php
echo '<table>
<thead>
<td>ID</td>
<td>Firm Name</td>
<td>Full Firm Address</td>
<td>Postcode</td>
<td>Commission Address</td>
<td>Phone</td>
<td>Fax</td>
<td>Email</td>
<td>Web</td>
<td>Firm Registration Number</td>
<td>Identity Partner Holding Power of Attorney</td>
<td>Partnership Deed</td>
<td>Transact Business on Attorneys Behalf</td>
<td>VAT Registration Certificate</td>
<td>Telephone Bill</td>
<td>Bank Account Statement</td>
<td>Electricity Bill</td>
<td>Telephone Bill 1</td>
<td>Lease Rent Agreement</td>
<td>Police Conduct for Directors</td>
<td>All Directors Passports</td>
</thead>
<tbody>';
$sql_profiles = "SELECT * FROM $table_agent_partnership_firm_profiles";
$result_profiles = $wpdb->get_results($sql_profiles, ARRAY_A);
foreach($result_profiles as $row)
{
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['firm_name'] . '</td>';
    echo '<td>' . $row['full_firm_address'] . '</td>';
    echo '<td>' . $row['postcode'] . '</td>';
    echo '<td>' . $row['commission_address'] . '</td>';
    echo '<td>' . $row['phone'] . '</td>';
    echo '<td>' . $row['fax'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['web'] . '</td>';
    echo '<td>' . $row['firm_registration_number'] . '</td>';
    echo '<td><a href="' . $row['identify_partner_holding_power_of_attorney_url'] . '">Identify Partner Holding Power of Attorney</a></td>';
    echo '<td><a href="' . $row['partnership_deed_url'] . '">Partnership Deed</a></td>';
    echo '<td><a href="' . $row['transact_business_on_attorneys_behalf_url'] . '">Transact Business on Attorneys Behalf</a></td>';
    echo '<td><a href="' . $row['vat_registration_certificate_url'] . '">VAT Registration Certificate</a></td>';
    echo '<td><a href="' . $row['telephone_bill_url'] . '">Telephone Bill</a></td>';
    echo '<td><a href="' . $row['bank_account_statement_url'] . '">Bank Account Statement</a></td>';
    echo '<td><a href="' . $row['electricity_bill_url'] . '">Electricity Bill</a></td>';
    echo '<td><a href="' . $row['telephone_bill1_url'] . '">Telephone Bill 1</a></td>';
    echo '<td><a href="' . $row['lease_rent_agreement_url'] . '">Lease Rent Agreement</a></td>';
    echo '<td><a href="' . $row['police_conduct_for_directors_url'] . '">Police Conduct for Directors</a></td>';
    echo '<td><a href="' . $row['all_directors_passports_url'] . '">All Directors Passports</a></td>';
    echo '</tr>';
}
echo '</tbody></table>';