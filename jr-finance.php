<?php
/*
Plugin Name: JR_Finance
Plugin URI: http://www.jakeruston.co.uk/2010/02/wordpress-plugin-jr-finance/
Description: This plugin allows you to show the latest finance news as a widget.
Version: 1.0.2
Author: Jake Ruston
Author URI: http://www.jakeruston.co.uk
*/

/*  Copyright 2009 Jake Ruston - the.escapist22@gmail.com

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

// Hook for adding admin menus
add_action('admin_menu', 'jr_Finance_add_pages');

// action function for above hook
function jr_Finance_add_pages() {
    add_options_page('JR Finance', 'JR Finance', 'administrator', 'jr_Finance', 'jr_Finance_options_page');
}
if (!defined("ch"))
{
function setupch()
{
$ch = curl_init();
$c = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
return($ch);
}

define("ch", setupch());

function curl_get_contents($url)
{
$c = curl_setopt(ch, CURLOPT_URL, $url);
return(curl_exec(ch));
}
}
register_activation_hook(__FILE__,'Finance_choice');

function Finance_choice () {
if (get_option("jr_Finance_links_choice")=="") {


$content = curl_get_contents("http://www.jakeruston.co.uk/pluginslink4.php");

update_option("jr_Finance_links_choice", $content);
}
}

// jr_Finance_options_page() displays the page content for the Test Options submenu
function jr_Finance_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_Finance_header';
	$opt_name_2 = 'mt_Finance_color';    $opt_name_3 = 'mt_Finance_topic';
	$opt_name_4 = 'mt_Finance_number';
    $opt_name_6 = 'mt_Finance_plugin_support';
    $hidden_field_name = 'mt_quotes_submit_hidden';
    $data_field_name = 'mt_Finance_header';
	$data_field_name_2 = 'mt_Finance_color';
    $data_field_name_3 = 'mt_Finance_topic';
	$data_field_name_4 = 'mt_Finance_number';
    $data_field_name_6 = 'mt_Finance_plugin_support';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_2 = get_option( $opt_name_2 );
    $opt_val_3 = get_option( $opt_name_3 );
	$opt_val_4 = get_option( $opt_name_4 );
    $opt_val_6 = get_option($opt_name_6);
    
if (!$_POST['feedback']=='') {
$my_email1="the.escapist22@gmail.com";
$plugin_name="JR Finance";
$blog_url_feedback=get_bloginfo('url');
$user_email=$_POST['email'];
$subject=$_POST['subject'];
$name=$_POST['name'];
$response=$_POST['response'];
if ($response=="Yes") {
$response="REQUIRED: ";
}
$feedback_feedback=$_POST['feedback'];
$feedback_feedback=stripslashes($feedback_feedback);
$headers1 = "From: feedback@jakeruston.co.uk";
$emailsubject1=$response.$plugin_name." - ".$subject;
$emailmessage1="Blog: $blog_url_feedback\n\nUser Name: $name\n\nUser E-Mail: $user_email\n\nMessage: $feedback_feedback";
mail($my_email1,$emailsubject1,$emailmessage1,$headers1);
?>
<div class="updated"><p><strong><?php _e('Feedback Sent!', 'mt_trans_domain' ); ?></strong></p></div>
<?php
}

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_2 = $_POST[ $data_field_name_2 ];
        $opt_val_3 = $_POST[ $data_field_name_3 ];
		$opt_val_4 = $_POST[ $data_field_name_4 ];
        $opt_val_6 = $_POST[$data_field_name_6];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_3, $opt_val_3 );
		update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_6, $opt_val_6 );  

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'JR Finance Plugin Options', 'mt_trans_domain' ) . "</h2>";
	?>
	<div class="updated"><p><strong><?php _e('Please consider donating to help support the development of my plugins!', 'mt_trans_domain' ); ?></strong><br /><br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ULRRFEPGZ6PSJ">
<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form></p></div>
<?php

    // options form
    
    $change4 = get_option("mt_Finance_plugin_support");

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Finance Widget Title", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="50">
</p><hr />

<p><?php _e("Company Stock Symbol (<a href='http://finance.yahoo.com/lookup'>Find</a>): ", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_3; ?>" value="<?php echo $opt_val_3; ?>" size="50">
</p><hr />

<p><?php _e("Number of Finance items", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_4; ?>" value="<?php echo $opt_val_4; ?>" size="3">
</p><hr />

<p><?php _e("Hex Colour Code:", 'mt_trans_domain' ); ?> 
#<input size="7" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>">
(For help, go to <a href="http://html-color-codes.com/">HTML Color Codes</a>).
</p><hr />

<p><?php _e("Show Plugin Support?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="Yes" <?php echo $change4; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="No" <?php echo $change41; ?> id="Please do not disable plugin support - This is the only thing I get from creating this free plugin!" onClick="alert(id)">No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<h3>Feedback Form!</h3>
<p><b>Note: Only send feedback in english, I cannot understand other languages!</b></p>
<form name="form2" method="post" action="">
<p><?php _e("Name (Optional):", 'mt_trans_domain' ); ?> 
<input type="text" name="email" /></p>
<p><?php _e("E-Mail (Optional):", 'mt_trans_domain' ); ?> 
<input type="text" name="email" /></p>
<p><?php _e("Subject:", 'mt_trans_domain' ); ?>
<input type="text" name="subject" /></p>
<input type="checkbox" name="response" value="Yes" /> I want e-mailing back about this feedback</p>
<p><?php _e("Comment:", 'mt_trans_domain' ); ?> 
<textarea name="feedback"></textarea>
</p>
<p class="submit">
<input type="submit" name="Send" value="<?php _e('Send', 'mt_trans_domain' ) ?>" />
</p><hr />
</form>
</div>
<?php
}

if (get_option("jr_Finance_links_choice")=="") {
Finance_choice();
}

function show_Finance($args) {

extract($args);

  $Finance_header = get_option("mt_Finance_header"); 
  $plugin_support2 = get_option("mt_Finance_plugin_support");
  $Finance_type = get_option("mt_Finance_topic");
  $Finance_number = get_option("mt_Finance_number");
  $Financecolor = get_option("mt_Finance_color");


if ($Finance_header=="") {
$Finance_header="Latest Finance News";
}

if ($Finance_number=="") {
$Finance_number=5;
}

if ($Finance_type=="") {
$Finance_type="goog";
}

$i=1;

echo $before_title.$Finance_header.$after_title.$before_widget; 

$doc = new DOMDocument();

$doc->load('http://finance.yahoo.com/rss/headline?s='.$Finance_type) or die("Error!");

foreach ($doc->getElementsByTagName('item') as $node) {
$t_Finance = $node->getElementsByTagName('title')->item(0);
$t_Financelink = $node->getElementsByTagName('link')->item(0);
$Finance = $t_Finance->nodeValue;
$Financelink = $t_Financelink->nodeValue;

echo "<li style='color:#".$Financecolor."'><a href='".$Financelink."' rel='nofollow'>".$Finance."</a></li>";
if($i++ >= $Finance_number) break;

}

if ($plugin_support2=="Yes" || $plugin_support2=="") {
echo "<p style='color: #".$Financecolor."; font-size:x-small'>Finance Plugin created by <a href='http://www.jakeruston.co.uk'>Jake</a> Ruston - ".get_option('jr_Finance_links_choice')."</p>";
}

echo $after_widget;

}

function init_Finance_widget() {
register_sidebar_widget("JR Finance", "show_Finance");
}

add_action("plugins_loaded", "init_Finance_widget");

?>
