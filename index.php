<?php
#####################
#      My DATA      #
#####################

# Please keep Copyrights

# Explains & source from App Pebble My Data v2.3.3 by Ivan Strokanev 
# Source : https://github.com/bahbka/pebble-my-data
# Script PHP v1.06 by Cyril Lopez (Twitter : @CyrilLopez)
# Source : https://github.com/cyrillopez/pebble-mydata/
# V1.07 Fix Function read_content_from_url (adding type option in setting file)
# V1.06 Fix Do Not Disturb Mode
# V1.05 Add Shake pebble action 
# V1.04 Add Security Token & Auth 
# V1.03 Add Do Not Disturb Mode 
# V1.02 Add Settings from url


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
	if ($setting['error']['type'] == 'text') $message = $setting['error']['content'];
	else if ($setting['error']['type'] == 'url') $message = read_content_from_url($setting['error']['content']); 
}

# When shake pebble
else if ($shake == 1) {  
	if ($setting['shake']['refresh'] != '') $refresh = $setting['shake']['refresh'];
	if ($setting['shake']['blink'] != '') $blink = $setting['shake']['blink'];
	if ($setting['shake']['vibrate'] != '') $vibrate = $setting['shake']['vibrate'];
	if ($setting['shake']['type'] == 'text') $message = $setting['shake']['content'];
	else if ($setting['shake']['type'] == 'url') $message = read_content_from_url($setting['shake']['content']); 
}

# When button select short press
else if ($select == 1) {  
	if ($setting['select_short']['refresh'] != '') $refresh = $setting['select_short']['refresh'];
	if ($setting['select_short']['blink'] != '') $blink = $setting['select_short']['blink'];
	if ($setting['select_short']['vibrate'] != '') $vibrate = $setting['select_short']['vibrate'];
	if ($setting['select_short']['type'] == 'text') $message = $setting['select_short']['content'];
	else if ($setting['select_short']['type'] == 'url') $message = read_content_from_url($setting['select_short']['content']); 
}

# When button select long press
else if ($select == 2) 
{ 
	if ($setting['select_long']['refresh'] != '') $refresh = $setting['select_long']['refresh'];
	if ($setting['select_long']['blink'] != '') $blink = $setting['select_long']['blink'];
	if ($setting['select_long']['vibrate'] != '') $vibrate = $setting['select_long']['vibrate'];
	if ($setting['select_long']['type'] == 'text') $message = $setting['select_long']['content'];
	else if ($setting['select_long']['type'] == 'url') $message = read_content_from_url($setting['select_long']['content']); 
}

# When button up short press
else if ($up == 1) 
{  
	if ($setting['up_short']['refresh'] != '') $refresh = $setting['up_short']['refresh'];
	if ($setting['up_short']['blink'] != '') $blink = $setting['up_short']['blink'];
	if ($setting['up_short']['vibrate'] != '') $vibrate = $setting['up_short']['vibrate'];
	if ($setting['up_short']['type'] == 'text') $message = $setting['up_short']['content'];
	else if ($setting['up_short']['type'] == 'url') $message = read_content_from_url($setting['up_short']['content']); 
}

# When button up long press
else if ($up == 2) 
{  
	if ($setting['up_long']['refresh'] != '') $refresh = $setting['up_long']['refresh'];
	if ($setting['up_long']['blink'] != '') $blink = $setting['up_long']['blink'];
	if ($setting['up_long']['vibrate'] != '') $vibrate = $setting['up_long']['vibrate'];
	if ($setting['up_long']['type'] == 'text') $message = $setting['up_long']['content'];
	else if ($setting['up_long']['type'] == 'url') $message = read_content_from_url($setting['up_long']['content']); 
}

# When button down short press
else if ($down == 1) 
{  
	if ($setting['down_short']['refresh'] != '') $refresh = $setting['down_short']['refresh'];
	if ($setting['down_short']['blink'] != '') $blink = $setting['down_short']['blink'];
	if ($setting['down_short']['vibrate'] != '') $vibrate = $setting['down_short']['vibrate'];
	if ($setting['down_short']['type'] == 'text') $message = $setting['down_short']['content'];
	else if ($setting['down_short']['type'] == 'url') $message = read_content_from_url($setting['down_short']['content']); 
}

# When button down long press
else if ($down == 2) 
{  
	if ($setting['down_long']['refresh'] != '') $refresh = $setting['down_long']['refresh'];
	if ($setting['down_long']['blink'] != '') $blink = $setting['down_long']['blink'];
	if ($setting['down_long']['vibrate'] != '') $vibrate = $setting['down_long']['vibrate'];
	if ($setting['down_long']['type'] == 'text') $message = $setting['down_long']['content'];
	else if ($setting['down_long']['type'] == 'url') $message = read_content_from_url($setting['down_long']['content']); 
}

# Default display
else { 
	if ($setting['default']['type'] == 'text') $message = $setting['default']['content'];
	else if ($setting['default']['type'] == 'url') $message = read_content_from_url($setting['default']['content']); 
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
