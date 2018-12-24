<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$user_id = get_current_user_id();
$profile_type = $table_agent_partnership_firm_profiles;
$result_profile = $wpdb->get_row( "SELECT * FROM $table_agent_partnership_firm_profiles WHERE user_id = $user_id" );
$agent_partnership_firm_profile_id = (int)$result_profile->id;
$string = '<form method="post">
<div id="wpja-identification">
<p><b>IDENTIFICATION</b></p>
        <table>
        <tr><td><label for="firm_name">Firm Name</label></td>
        <td><input class="wpja-input" id="firm_name" type="text" name="firm_name" maxlength="100" value="'; 
        $string .= $result_profile->firm_name;
        $string .= '"></td></tr>
        <tr><td><label for="full_firm_address">Full Firm Address</label></td>
        <td><input class="wpja-input" id="full_firm_address" type="text" name="full_firm_address" maxlength="100" value="'; 
        $string .= $result_profile->full_firm_address;
        $string .= '"></td></tr>
        <tr><td><label for="postcode">Postcode</label></td>
        <td><input class="wpja-input" id="postcode" type="text" name="postcode" maxlength="100" value="'; 
        $string .= $result_profile->postcode;
        $string .= '"></td></tr>
        <tr><td><label for="commission_address">Commission Address</label></td>
        <td><input class="wpja-input" id="commission_address" type="text" name="commission_address" maxlength="100" value="'; 
        $string .= $result_profile->commission_address;
        $string .= '"></td></tr>
        <tr><td><label for="phone">Phone</label></td>
        <td><input class="wpja-input" id="phone" type="text" name="phone" maxlength="100" value="'; 
        $string .= $result_profile->phone;
        $string .= '"></td></tr>
        <tr><td><label for="fax">Fax</label></td>
        <td><input class="wpja-input" id="fax" type="text" name="fax" maxlength="100" value="'; 
        $string .= $result_profile->fax;
        $string .= '"></td></tr>
        <tr><td><label for="email">Email</label></td>
        <td><input class="wpja-input" id="email" type="email" name="email" maxlength="100" value="'; 
        $string .= $result_profile->email;
        $string .= '"></td></tr>
        <tr><td><label for="web">Web</label></td>
        <td><input class="wpja-input" id="web" type="text" name="web" maxlength="100" value="'; 
        $string .= $result_profile->web;
        $string .= '"></td></tr>
        <tr><td><label for="firm_registration_number">Firm Registration Number</label></td>
        <td><input class="wpja-input" id="firm_registration_number" type="text" name="firm_registration_number" maxlength="100" value="'; 
        $string .= $result_profile->firm_registration_number;
        $string .= '"></td></tr>
        </table>
        <input type="submit" name="submit-agent-partnership-firm" value="Edit Profile">
        </div>
        </form>
        <div id="wpja-attachments">
        <form method="post" enctype="multipart/form-data">
        <label for="identify_partner_holding_power_of_attorney"><b>Identify Partner Holding Power of Attorney</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT identify_partner_holding_power_of_attorney_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="identify_partner_holding_power_of_attorney_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="partnership_deed"><b>Partnership Deed</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT partnership_deed_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="partnership_deed_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="transact_business_on_attorneys_behalf"><b>Transact Business on Attorneys Behalf</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT transact_business_on_attorneys_behalf_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="transact_business_on_attorneys_behalf_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="vat_registration_certificate"><b>VAT Registration Certificate</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT vat_registration_certificate_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="vat_registration_certificate_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="telephone_bill"><b>Telephone Bill</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT telephone_bill_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="telephone_bill_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="bank_account_statement"><b>Bank Account Statement</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT bank_account_statement_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="bank_account_statement_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="electricity_bill"><b>Electricity Bill</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT electricity_bill_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="electricity_bill_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="telephone_bill1"><b>Telephone Bill 1</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT telephone_bill1_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="telephone_bill1_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="lease_rent_agreement"><b>Lease Rent Agreement</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT lease_rent_agreement_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="lease_rent_agreement_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="police_conduct_for_directors"><b>Police Conduct for Directors</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT police_conduct_for_directors_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="police_conduct_for_directors_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        <form method="post" enctype="multipart/form-data">
        <label for="all_directors_passports"><b>All Directors Passports</b></label><br>';
        $attachment_set = $wpdb->get_row("SELECT all_directors_passports_url as attachment_url FROM $profile_type WHERE id = $agent_partnership_firm_profile_id", ARRAY_A);
        if($attachment_set['attachment_url'])
        {
              $string .= '<div class="wpja-attachment-set">
              <p><a href="'.$attachment_set['attachment_url'].'"><b>Attachment file</b></a><br /><b>This attachment is already set.</b> Change it below.</p>
              </div>';
        }
        $string .= '
        <input class="wpja-input" type="file" name="attachment" required><br />
        <input class="wpja-input" type="hidden" name="profile_id" value="'.$agent_partnership_firm_profile_id.'">
        <input class="wpja-input" type="hidden" name="attachment_name" value="all_directors_passports_url">
        <input class="wpja-input" type="hidden" name="profile_type" value="'.$profile_type.'">
        <button type="submit" name="submit-attachment">Edit Attachment</button>
        </form><br />
        </div>';

$string .= '<input type="submit" name="submit-agent-individual" value="Edit Profile"></form>';