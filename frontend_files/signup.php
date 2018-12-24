<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$string = '<form method="post">
               <table border="0">
               <tr><td><label>Username</label></td>
               <td><input type="text" name="username" placeholder="Username" required></td></tr>
               <tr><td><label>Email</label></td>
               <td><input type="email" name="mail" placeholder="Email" required></td></tr>
               <tr><td><label>Password</label></td>
               <td><input type="password" name="passwd" placeholder="Password" required></td></tr>
               <tr><td colspan="2"><label>Type of user you want to register as:</label></td></tr>
               <tr><td colspan="2"><input type="radio" name="role" value="jobseeker"> Jobseeker</td></tr>
               <tr><td><input type="radio" name="role" value="employer"> Employer</td><td><input type="radio" name="category-employer" value="individual"> Individual&nbsp&nbsp&nbsp <input type="radio" name="category-employer" value="company"> Company</td></tr>
               <tr><td><input type="radio" name="role" value="agent"> Agent</td><td><input type="radio" name="category-agent" value="individual"> Individual&nbsp&nbsp&nbsp <input type="radio" name="category-agent" value="company"> Company&nbsp&nbsp&nbsp <input type="radio" name="category-agent" value="partnership_firm"> Partnership firm&nbsp&nbsp&nbsp <input type="radio" name="category-agent" value="family_member"> Family member</td></tr>
               </table>
               <input type="submit" name="submit-signup" value="Sign Up">
           </form>';