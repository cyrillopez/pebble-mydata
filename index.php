<?php
#####################
#      My DATA      #
#####################

# Please keep Copyrights

# Explains & source from App Pebble My Data v2.2.0 by Ivan Strokanev 
# Source : https://github.com/bahbka/pebble-my-data
# Script PHP v1.03 by Cyril Lopez (Twitter : @CyrilLopez)
# Source : https://github.com/cyrillopez/pebble-mydata/
# + Security Token & Auth + Do Not Disturb Mode + Settings from url


# Include settings (Please use this file to setup script)
include ('settings.php');

###############################################################

# Get variables from url or settings

$refresh = isset($_GET['refresh']) ? $_GET['refresh'] : $setting['refresh']; 
$font = isset($_GET['font']) ? $_GET['font'] : $setting['font']; 
$theme = isset($_GET['theme']) ? $_GET['theme'] : $setting['theme']; 
$scroll = isset($_GET['scroll']) ? $_GET['scroll'] : $setting['scroll']; 
$light = isset($_GET['light']) ? $_GET['light'] : $setting['light'];
$blink = isset($_GET['blink']) ? $_GET['blink'] : $setting['blink'];
$vibrate = isset($_GET['vibrate']) ? $_GET['vibrate'] : $setting['vibrate'];
$updown = isset($_GET['updown']) ? $_GET['updown'] : $setting['updown'];
$auth = isset($_GET['auth']) ? $_GET['auth'] : $setting['auth']; 


# Verify parameters from url 

$select = isset($_GET['select']) ? $_GET['select'] : 0;
$up = isset($_GET['up']) ? $_GET['up'] : 0;
$down = isset($_GET['down']) ? $_GET['down'] : 0;

# Set pebble auth

$pebble_auth = md5(md5($setting['password_auth']).$auth);
	
# Check Security

$error = false;
if ($setting['check_security'] == true) 
	if ($_SERVER['HTTP_PEBBLE_TOKEN'] != $setting['pebble_token'])
		if ($_SERVER['HTTP_PEBBLE_AUTH'] != $pebble_auth)
		$error = true; 
		
# Set content to display with buttons conditions

if ($error == true) { 
	if ($setting['error']['refresh'] != '') $refresh = $setting['error']['refresh'];
	if ($setting['error']['blink'] != '') $blink = $setting['error']['blink'];
	if ($setting['error']['vibrate'] != '') $vibrate = $setting['error']['vibrate'];
	$message = $setting['error']['content'];
}

# When button select short press
else if ($select == 1) {  
	if ($setting['select_short']['refresh'] != '') $refresh = $setting['select_short']['refresh'];
	if ($setting['select_short']['blink'] != '') $blink = $setting['select_short']['blink'];
	if ($setting['select_short']['vibrate'] != '') $vibrate = $setting['select_short']['vibrate'];
	$message = $setting['select_short']['content']; 
}

# When button select long press
else if ($select == 2) 
{ 
	if ($setting['select_long']['refresh'] != '') $refresh = $setting['select_long']['refresh'];
	if ($setting['select_long']['blink'] != '') $blink = $setting['select_long']['blink'];
	if ($setting['select_long']['vibrate'] != '') $vibrate = $setting['select_long']['vibrate'];
	$message = $setting['select_long']['content'];
}

# When button up short press
else if ($up == 1) 
{  
	if ($setting['up_short']['refresh'] != '') $refresh = $setting['up_short']['refresh'];
	if ($setting['up_short']['blink'] != '') $blink = $setting['up_short']['blink'];
	if ($setting['up_short']['vibrate'] != '') $vibrate = $setting['up_short']['vibrate'];
	$message = $setting['up_short']['content'];
}

# When button up long press
else if ($up == 2) 
{  
	if ($setting['up_long']['refresh'] != '') $refresh = $setting['up_long']['refresh'];
	if ($setting['up_long']['blink'] != '') $blink = $setting['up_long']['blink'];
	if ($setting['up_long']['vibrate'] != '') $vibrate = $setting['up_long']['vibrate'];
	$message = $setting['up_long']['content'];
}

# When button down short press
else if ($down == 1) 
{  
	if ($setting['down_short']['refresh'] != '') $refresh = $setting['down_short']['refresh'];
	if ($setting['down_short']['blink'] != '') $blink = $setting['down_short']['blink'];
	if ($setting['down_short']['vibrate'] != '') $vibrate = $setting['down_short']['vibrate'];
	$message = $setting['down_short']['content'];  
}

# When button down long press
else if ($down == 2) 
{  
	if ($setting['down_long']['refresh'] != '') $refresh = $setting['down_long']['refresh'];
	if ($setting['down_long']['blink'] != '') $blink = $setting['down_long']['blink'];
	if ($setting['down_long']['vibrate'] != '') $vibrate = $setting['down_long']['vibrate'];
	$message = $setting['down_long']['content']; 
}

# Default display
else { 
	$message = $setting['default']['content'];
}

# Do Not Disturb mode 

if (($setting['DoNotDisturb']['active'] == true) AND ($setting['DoNotDisturb']['start'] > $setting['DoNotDisturb']['stop']) AND ((date("H") >= $setting['DoNotDisturb']['start']) OR (date("H") < $setting['DoNotDisturb']['stop']))) $DoNotDisturb_mode = true;
else if (($setting['DoNotDisturb']['active'] == true) AND ($setting['DoNotDisturb']['start'] < $setting['DoNotDisturb']['stop']) AND (date("H") >= $setting['DoNotDisturb']['start']) AND (date("H") < $setting['DoNotDisturb']['stop'])) $DoNotDisturb_mode = true;
else $DoNotDisturb_mode = false;
if ($DoNotDisturb_mode == true) { 
	$refresh = $setting['DoNotDisturb']['refresh'];
	$vibrate = $setting['DoNotDisturb']['vibrate'];
	$blink = $setting['DoNotDisturb']['blink'];
}

# Display of content in Json format

echo '{
  "content": "'.$message.'",
  "refresh": '.$refresh.',
  "vibrate": '.$vibrate.',
  "font": '.$font.',
  "theme": '.$theme.',
  "scroll": '.$scroll.',
  "light": '.$light.',
  "blink": '.$blink.',
  "updown": '.$updown.',
  "auth": "randomsalt"
}';

# Function to read json content from url if you need

function read_content_from_url($url) {
	$contents = file_get_contents($url); 
	$contents = utf8_encode($contents); 
	$results = json_decode($contents, true); 
	$message = str_replace("\n",'\n',$results['content']);
	return $message;
}
?>
