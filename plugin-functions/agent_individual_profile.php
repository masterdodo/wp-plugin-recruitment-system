<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$user_id = get_current_user_id();
$profile_type = $table_agent_individual_profiles;
$result_profile = $wpdb->get_row( "SELECT * FROM $table_agent_individual_profiles WHERE user_id = $user_id" );
$agent_individual_profile_id = (int)$result_profile->id;
$string = '<form method="post">
<div id="wpja-identification">
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
        <tr><td><label for="email">Email</label></td>
        <td><input class="wpja-input" id="email" type="email" name="email" maxlength="100" value="'; 
        $string .= $result_profile->email;
        $string .= '"></td></tr>
        </table>
        <input type="submit" name="submit-agent-individual" value="Edit Profile">
        </div>
        </form>
        <div id="wpja-attachments">
        <form method="post" enctype="multipart/form-data">
        <label for="passport"><b>Passport</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT passport_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="passport_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="driving_licence"><b>Driving licence</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT driving_licence_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="driving_licence_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="ration_card_with_photo"><b>Ration Card with Photo</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT ration_card_with_photo_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="ration_card_with_photo_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="bank_ac_pass_book_with_photo"><b>Bank AC Pass Book with Photo</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT bank_ac_pass_book_with_photo_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="bank_ac_pass_book_with_photo_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="bank_account_statement"><b>Bank Account Statement</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT bank_account_statement_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="bank_account_statement_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="birth_certificate"><b>Birth Certificate</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT birth_certificate_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="birth_certificate_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="electricity_bill"><b>Electricity Bill</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT electricity_bill_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="electricity_bill_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="rent_agreement"><b>Rent Agreement</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT rent_agreement_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="rent_agreement_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="police_conduct"><b>Police Conduct</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT police_conduct_url as attachment_url FROM $profile_type WHERE id = $agent_individual_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_individual_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="police_conduct_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        </div>';