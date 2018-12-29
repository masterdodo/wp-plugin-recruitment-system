<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$sql = "SELECT * FROM $table_jobseeker_profiles ORDER BY surname, name";
$result = $wpdb->get_results($sql, ARRAY_A);
$count = $wpdb->num_rows;
if ($count < 0)
{
  exit;
}

$string = "<table id=\"database\" style=\"table-layout: auto;\">";
$string .= "<thead>";
$string .= "<td>ID</td>";
$string .= "<td>NAME</td>";
$string .= "<td>SURNAME</td>";
$string .= "<td>GENDER</td>";
$string .= "<td>COUNTRY OF ORIGIN</td>";
$string .= "<td>PASSPORT</td>";
$string .= "<td>EDUCATION</td>";
$string .= "</thead>";
$string .= "<tbody>";
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
	if (isset ($row['country_origin_id']))
	{
		$sql3 = "SELECT country_name FROM $table_countries WHERE id= %d";
		$result3 = $wpdb->get_results($wpdb->prepare($sql3, $row['country_origin_id']), ARRAY_A);
		foreach($result3 as $row3)
		{
            $country_origin = $row3['country_name'];
        }
	}
	$string .= "<tr>";
	$string .= "<td>".esc_html($row['id'])."</td>";
	$string .= "<td>".esc_html($row['name'])."</td>";
	$string .= "<td>".esc_html($row['surname'])."</td>";
	$string .= "<td>".esc_html($row['gender'])."</td>";
	$string .= "<td>".esc_html($country_origin)."</td>";
	$string .= "<td>".esc_html($row['passport_number'])."</td>";
	$string .= "<td>".esc_html($education)."</td>";
	$string .= "</tr>";
}
$string .= "</tbody>";
$string .= "</table>";