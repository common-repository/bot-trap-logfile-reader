<?php

/*
Plugin Name: Bot-Trap log reader
Plugin URI: http://www.webregard.de
Description: Plugin to read the logfile from Bot-Trap
Author: Webregard.de
Version: 0.1
Author URI: http://www.webregard.de
Generated with help from: www.wp-fun.co.uk;
*/ 

/*  Copyright 2007  Webregard.de  (email: mailme@webregard.de)

 -> Please do not share this file, post a link to the newest version to the Website: http://www.webregard.de/2007/12/11/bot-trap-reader-plugin-fur-wordpress/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_option('bot_trap_reader', $defaultdata, 'Reads the logfile of Bot-Trap');

add_action('admin_menu', 'add_bot_trap_reader');

function add_bot_trap_reader()
{
	if (function_exists('add_options_page'))
	{
		add_submenu_page('index.php', 'Bot-Trap Log', 'Bot-Trap Log', 5, __FILE__, 'bot_trap_read_subpanel');
	}
}

function bot_trap_read_subpanel()
{
	?>
	
	<div class="wrap">
	<h2>Bot-Trap Logreader</h2>
	
	<? 
				$bt_pfad="../"; 
				$bt_file="page.restrictor.log";
				$bt_file = $bt_pfad.$bt_file;
				if(file_exists($bt_file))
				{
				$bt_inhalt = file($bt_file);
				$bt_anzahl = count($bt_inhalt);
				$bt_inhalt = array_reverse($bt_inhalt);
				?>
				<div style="overflow:scroll;width:100%;height:600px">
				<table width="100px" border="0" cellpadding="0" cellspacing="5">
					  <tr>
						<td>					<h3>Date</h3></td>
						<td bgcolor="#C4EBB8">	<h3>Host-IP / Name</h3></td>
						<td>					<h3>Useragent</h3></td>
						<td bgcolor="#C4EBB8">	<h3>Client Referral</h3></td>
						<td>					<h3>Destination</h3></td>
						<td bgcolor="#C4EBB8">	<h3>Reason</h3></td>
						<td>					<h3>Data</h3></td>
					  </tr>
				<?
					for($bt_i = 0; $bt_i < $bt_anzahl; $bt_i++) 
					{
				# Inhalt zerteilen
						$bt_eintrag = explode(" - ",$bt_inhalt[$bt_i]); 
				# Variabeln defenieren
						$bt_log_datum = $bt_eintrag[0];
						$bt_log_clientipuhost = $bt_eintrag[1];
						$bt_log_useragent = $bt_eintrag[2];
						$bt_log_clientref = $bt_eintrag[3];
						$bt_log_ziel = $bt_eintrag[4];
						$bt_log_reason = $bt_eintrag[5];
						$bt_log_data = $bt_eintrag[6];
						
						$bt_limit = 25;
						$bt_immer = "true";
						$bt_trimmer = " ";
				# Daten ausgeben
						?>
					  <tr>
						<td>					<? echo wordwrap($bt_log_datum, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
						<td bgcolor="#C4EBB8">	<? echo wordwrap($bt_log_clientipuhost, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
						<td>					<? echo wordwrap($bt_log_useragent, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
						<td bgcolor="#C4EBB8">	<? echo wordwrap($bt_log_clientref, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
						<td>					<? echo wordwrap($bt_log_ziel, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
						<td bgcolor="#C4EBB8">	<? echo wordwrap($bt_log_reason, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
						<td>					<? echo wordwrap($bt_log_data, $bt_limit, $bt_trimmer, $bt_immer ); ?></td>
					  </tr><td height="1" colspan="7" bgcolor="#C6FFA4"></td>
						<?
					}
					
					?>
				  </table></div>
					<?
				} 
				else echo "You have to create the file at root: \"page.restrictor.log\"";?>
				<p>&nbsp;</p>
				<h2>Page-Restrictor Configuration</h2>
				<p><a href="../page.restrictor.php?pres=check" target="_blank">Page-Restrictor Check</a></p>
				<p><a href="../page.restrictor.php?pres=update" target="_blank">Page-Restrictor Update</a></p>
	
	</div>
	
	<?
}

?>
