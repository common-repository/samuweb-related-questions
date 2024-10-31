<?php
/*
Plugin Name: Samuweb Related Questions
Plugin URI: http://samuweb.info/samuweb-related-questions-wordpress-plugin
Description: <strong>Boost your SEO!</strong> Create a box for related questions so you can contextually fill those keywords and help people find your information without the need to write crappy copy
Author: Samuel Nasta
Author URI: http://samuweb.info/
License: GPLv2 or later
Version: 1.0
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/



// Register Script
function samuweb_related_questions_script() {
	wp_register_script('samuweb-related-questions-script', plugins_url('/samuweb-related-questions/samuweb-related-questions.js'), array('jquery'), '1.0', true);
	wp_enqueue_script('samuweb-related-questions-script');
}



// Register Style
function samuweb_related_questions_style() {
	wp_register_style('samuweb-related-questions-style', plugins_url('/samuweb-related-questions/samuweb-related-questions-style.css'), false, '1.0');
	wp_enqueue_style('samuweb-related-questions-style');
}



// Admin page
function samuweb_related_questions_admin_actions() {
	add_options_page('Settings for Samuweb Related Questions', 'Samuweb Related Questions', 'manage_options', 'samuweb-related-questions-settings', 'samuweb_related_questions_admin_page');
}
function samuweb_related_questions_admin_page() {
	include('samuweb-related-questions-admin.php');
}

/*
function samuweb_related_questions_header_config() {
?>
<script type="text/javascript">
var samuweb_related_questions_scroll_speed = <?php echo get_option('samuweb_related_questions_scroll_speed') ? get_option('samuweb_related_questions_scroll_speed') : 2500; ?>;
var samuweb_related_questions_primary_element = '<?php echo get_option('samuweb_related_questions_primary_element') ?>';
var samuweb_related_questions_secondary_element = '<?php echo get_option('samuweb_related_questions_secondary_element') ?>';
</script>
<?php
}
*/

function samuweb_related_questions_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=samuweb-related-questions-settings">Settings</a>';
  	array_unshift($links, $settings_link);
  	return $links;
}



// Include the Samuweb Related Questions button in the visual editor for posts and pages
function samuweb_related_questions_tiny_mce_button($buttons_array) {
   array_push($buttons_array, '|', 'samuweb_related_questions_tiny_mce');
   return $buttons_array;
}

function samuweb_related_questions_tiny_mce_plugin($plugin_array) {
   $plugin_array['samuweb_related_questions_tiny_mce'] = plugins_url('/samuweb-related-questions/samuweb-related-questions-admin.js');
   return $plugin_array;
}

function samuweb_related_questions_tiny_mce() {
   if (!current_user_can('edit_posts') && ! current_user_can('edit_pages')) { return; }
   if ( get_user_option('rich_editing') == 'true') {
      add_filter('mce_external_plugins', 'samuweb_related_questions_tiny_mce_plugin');
      add_filter('mce_buttons', 'samuweb_related_questions_tiny_mce_button');
   }
}




// Adds the shortcode functionality
function samuweb_related_questions_shortcode($attributes, $content = null) {
	extract(shortcode_atts(array('title' => null), $attributes));
	return '<span class="samuweb-related-questions-anchor" id="' . sanitize_title($title) . '" data-title="' . $title . '">' . $content . '</span>';
}

function samuweb_related_questions_register_shortcode(){
	add_shortcode('related-questions', 'samuweb_related_questions_shortcode');
}




add_action('init', 'samuweb_related_questions_register_shortcode');
add_action('init', 'samuweb_related_questions_tiny_mce');
add_action('admin_menu', 'samuweb_related_questions_admin_actions');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'samuweb_related_questions_settings_link');
add_action('wp_enqueue_scripts', 'samuweb_related_questions_script');
add_action('wp_enqueue_scripts', 'samuweb_related_questions_style');