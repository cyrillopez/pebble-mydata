<?php

# Set parameters by default

$setting['refresh'] = 900; // refresh setting in seconds (ex : 900 -> 5 minutes)
$setting['font'] = 7; // font setting (1-8)
$setting['theme'] = 0; // theme setting (0-1)
$setting['scroll'] = 1; // scroll setting (0-1)
$setting['light'] = 1; // light setting (0-1)
$setting['blink'] = 3; // blink setting (1-10)
$setting['vibrate'] = 1; // vibrate setting (0 - 3)
$setting['updown'] = 1; // Up/Down Scrolling mode (0) or Up/Down button mode (1)
$setting['auth'] = "randomsalt"; //salt

// More information of options in source : https://github.com/bahbka/pebble-my-data


# Settings for Pebble Token Security

$setting['check_security'] = false; // Activate (True) or Disable (False) the check Security
$setting['pebble_token'] = ""; // Set your Pebble Token (you can set it in Pebble app > My Data > Server auth settings)
$setting['password_auth'] = ""; // Set your password

# Settings Do Not Disturb Mode -> stop vibrations & blinks between stop and start hours (like night for example)

$setting['DoNotDisturb']['active'] = false; //active (true) ou inactive (false)
$setting['DoNotDisturb']['start'] = 23; // Hour to start Do Not Disturb mode
$setting['DoNotDisturb']['stop'] = 7; // Hour to stop Do Not Disturb mode
$setting['DoNotDisturb']['refresh'] = 1800; // Refresh all 30 minutes
$setting['DoNotDisturb']['vibrate'] = 0; // Vibrate off
$setting['DoNotDisturb']['blink'] = 0; // Blink off

# Settings content

// For each button, you can set content and refresh/blink/vibrate options

$setting['default']['content'] = 'Hello World !';
$setting['up_short']['content'] = 'Up Short'; 
$setting['up_short']['refresh'] = 15;  
$setting['up_short']['blink'] = 0; 
$setting['up_short']['vibrate'] = ''; 
$setting['up_long']['content'] = 'Up Long'; 
$setting['up_long']['refresh'] = 5; 
$setting['up_long']['blink'] = 0; 
$setting['up_long']['vibrate'] = ''; 
$setting['down_short']['content'] = 'Down Short'; 
$setting['down_short']['refresh'] = 30; 
$setting['down_short']['blink'] = 0; 
$setting['down_short']['vibrate'] = '';  
$setting['down_long']['content'] = 'Down Long'; 
$setting['down_long']['refresh'] = 15; 
$setting['down_long']['blink'] = 0;  
$setting['down_long']['vibrate'] = ''; 
$setting['select_short']['content'] = 'Select Short'; 
$setting['select_short']['refresh'] = '';  
$setting['select_short']['blink'] = 0; 
$setting['select_short']['vibrate'] = '';  
$setting['select_long']['content'] = 'Select Long'; 
$setting['select_long']['refresh'] = 5; 
$setting['select_long']['blink'] = 0; 
$setting['select_long']['vibrate'] = ''; 
$setting['error']['content'] = 'Error ! Access denied !'; 
$setting['error']['refresh'] = 900; 
$setting['error']['blink'] = 5; 
$setting['error']['vibrate'] = 3; 

// You can use function read_content_from_url to get content from json url like read_content_from_url(url_json_content) 

?>
