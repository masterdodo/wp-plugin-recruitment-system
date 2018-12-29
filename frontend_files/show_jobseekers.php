<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$sql = "SELECT * FROM $table_jobseeker_profiles ORDER BY surname, name";
$result = $wpdb->get_results($sql, ARRAY_A);
$count = $wpdb->num_rows;
if ($count < 0)
{
  exit;
}

$string = '<table>
           <thead>
           <td>NAME</td>
           <td>SURNAME</td>
           <td>PASSPORT</td>
           <td>EMAIL</td>
           <td>GENDER</td>
           <td>COUNTRY</td>
           <td>DOB</td>
           <td>EDUCATION</td>
           </thead>
           <tbody>';
foreach($result as $row)
{
    if (isset($row['education_level_id']))
    {
        $sql2 = "SELECT name FROM $table_education_levels WHERE id= %d";
        $result2 = $wpdb->get_results($wpdb->prepare($sql2, $row['education_level_id']), ARRAY_A);
        foreach($result2 as $row2)
        {
            $education = $row2['name'];
        }
    }
    if (isset ($row['country_id']))
    {
        $sql3 = "SELECT country_name FROM $table_countries WHERE id= %d";
        $result3 = $wpdb->get_results($wpdb->prepare($sql3, $row['country_origin_id']), ARRAY_A);
        foreach($result3 as $row3)
        {
            $country = $row3['country_name'];
        }
    }
    $dob = strtotime($row['date_of_birth']);
    $string .= "<tr>";
    $string .= "<td>".esc_html($row['name'])."</td>";
    $string .= "<td>".esc_html($row['surname'])."</td>";
    $string .= "<td>".esc_html($row['passport_number'])."</td>";
    $string .= "<td>".esc_html($row['email'])."</td>";
    $string .= "<td>".esc_html($row['gender'])."</td>";
    $string .= "<td>".esc_html($country)."</td>";
    $string .= "<td>".esc_html(date('d. m. Y', $dob))."</td>";
    $string .= "<td>".esc_html($education)."</td>";
    $string .= "</tr>";
}
$string .= '</tbody>
            </table>';