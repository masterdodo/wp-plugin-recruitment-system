<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$string = '<form method="post">
               <input type="hidden" name="action" value="submit-login">
               <table border="0">
               <tr><td><label>Username</label></td>
               <td><input type="text" name="username" placeholder="Username" required></td></tr>
               <tr><td><label>Password</label></td>
               <td><input type="password" name="passwd" placeholder="Password" required></td></tr>
               </table>
               <input type="submit" name="submit-login" value="Log In">
           </form>';
