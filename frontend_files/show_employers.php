<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$sql = "SELECT * FROM $table_employer_company_profiles ORDER BY business_name";
$result = $wpdb->get_results($sql, ARRAY_A);
$count = $wpdb->num_rows;
if ($count < 0)
{
  exit;
}
$sql1 = "SELECT * FROM $table_employer_individual_profiles ORDER BY surname, name";
$result1 = $wpdb->get_results($sql1, ARRAY_A);
$count1 = $wpdb->num_rows;
if ($count1 < 0)
{
  exit;
}
$string = '<p>* C - company, IND - individual</p>';
$string .= '<table>
           <thead>
           <td>TYPE</td>
           <td>NAME</td>
           <td>EMAIL</td>
           <td>COUNTRY</td>
           <td>PHONE</td>
           </thead>
           <tbody>';
foreach($result as $row)
{
    $country = '/';
    if (isset ($row['country_id']))
    {
        $sql3 = "SELECT country_name FROM $table_countries WHERE id= %d";
        $result3 = $wpdb->get_results($wpdb->prepare($sql3, $row['country_id']), ARRAY_A);
        foreach($result3 as $row3)
        {
            $country = $row3['country_name'];
        }
    }
    $string .= "<tr>";
    $string .= "<td>C</td>";
    $string .= "<td>".(esc_html($row['business_name']) == '' ? '/' : esc_html($row['business_name']))."</td>";
    $string .= "<td>".(esc_html($row['email']) == '' ? '/' : esc_html($row['email']))."</td>";
    $string .= "<td>".esc_html($country)."</td>";
    $string .= "<td>".(esc_html($row['phone']) == '' ? '/' : esc_html($row['phone']))."</td>";
    $string .= "</tr>";
}

foreach($result1 as $row)
{
    $country = '/';
    if (isset ($row['country_id']))
    {
        $sql3 = "SELECT country_name FROM $table_countries WHERE id= %d";
        $result3 = $wpdb->get_results($wpdb->prepare($sql3, $row['country_id']), ARRAY_A);
        foreach($result3 as $row3)
        {
            $country = $row3['country_name'];
        }
    }
    $string .= "<tr>";
    $string .= "<td>IND</td>";
    $string .= "<td>".(esc_html($row['name']) == '' ? '/' : esc_html($row['name'])). " " . (esc_html($row['surname']) == '' ? '/' : esc_html($row['surname'])) . "</td>";
    $string .= "<td>".(esc_html($row['email']) == '' ? '/' : esc_html($row['email']))."</td>";
    $string .= "<td>".esc_html($country)."</td>";
    $string .= "<td>".(esc_html($row['tel_mobile']) == '' ? '/' : esc_html($row['tel_mobile']))."</td>";
    $string .= "</tr>";
}
$string .= '</tbody>
            </table>';