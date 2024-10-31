<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
Plugin Name: OXSN Exclude From Search
Plugin URI: https://wordpress.org/plugins/oxsn-exclude-from-search/
Description: This plugin adds helpful hover reveal shortcodes with quicktags!
Author: oxsn
Author URI: https://oxsn.com/
Version: 0.0.3
*/


define( 'oxsn_exclude_from_search_plugin_basename', plugin_basename( __FILE__ ) );
define( 'oxsn_exclude_from_search_plugin_dir_path', plugin_dir_path( __FILE__ ) );
define( 'oxsn_exclude_from_search_plugin_dir_url', plugin_dir_url( __FILE__ ) );

if ( ! function_exists ( 'oxsn_exclude_from_search_settings_link' ) ) {

	add_filter( 'plugin_action_links', 'oxsn_exclude_from_search_settings_link', 10, 2 );
	function oxsn_exclude_from_search_settings_link( $links, $file ) {

		if ( $file != oxsn_exclude_from_search_plugin_basename )
		return $links;
		$settings_page = '<a href="' . menu_page_url( 'oxsn-exclude-from-search', false ) . '">' . esc_html( __( 'Settings', 'oxsn-exclude-from-search' ) ) . '</a>';
		array_unshift( $links, $settings_page );
		return $links;

	}

}


?><?php


/* OXSN Dashboard Tab */

if ( !function_exists('oxsn_dashboard_tab_nav_item') ) {

	add_action('admin_menu', 'oxsn_dashboard_tab_nav_item');
	function oxsn_dashboard_tab_nav_item() {

		add_menu_page('OXSN', 'OXSN', 'manage_options', 'oxsn-dashboard', 'oxsn_dashboard_tab' );

	}

}

if ( !function_exists('oxsn_dashboard_tab') ) {

	function oxsn_dashboard_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap">
		
			<h2>OXSN / Digital Agency</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Coming Soon</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Exclude From Search Customizer */

if ( ! function_exists ( 'oxsn_exclude_from_search_customizer' ) ) {

	add_action( 'customize_register', 'oxsn_exclude_from_search_customizer' );
	function oxsn_exclude_from_search_customizer( $wp_customize ) {
	   
	   $wp_customize->add_panel( 'oxsn_plugin_panel', array(
			'priority'       => '',
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => 'OXSN Plugins',
			'description'    => '',
		) );

	   		// exclude_from_search

		   $wp_customize->add_section( 'oxsn_exclude_from_search_section' , array(
				'priority'       => '',
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Exclude From Search',
				'description'    => '',
				'panel'  => 'oxsn_plugin_panel',
			) );

				// exclude_from_search_page_ids

				$exclude_from_search_page_ids = '';
				$wp_customize->add_setting( 'oxsn_exclude_from_search_page_ids_control', array(
					'type' => 'option',
					'default' => $exclude_from_search_page_ids,
				) );

				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'oxsn_exclude_from_search_page_ids_control', array(
					'type'     => '',
					'priority' => '',
					'section'  => 'oxsn_exclude_from_search_section',
					'label'    => 'Page Ids',
					'description' => __( 'Seperate the page ids with a comma.' ),
				) ) );

				// exclude_from_search_post_types

				$exclude_from_search_post_types = '';
				$wp_customize->add_setting( 'oxsn_exclude_from_search_post_types_control', array(
					'type' => 'option',
					'default' => $exclude_from_search_post_types,
				) );

				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'oxsn_exclude_from_search_post_types_control', array(
					'type'     => '',
					'priority' => '',
					'section'  => 'oxsn_exclude_from_search_section',
					'label'    => 'Post Types',
					'description' => __( 'Seperate the post types with a comma. Also, be sure to use the post type slugs.' ),
				) ) );

	}

}


?><?php


/* OXSN Plugin Tab */

if ( ! function_exists ( 'oxsn_exclude_from_search_plugin_tab_nav_item' ) ) {

	add_action('admin_menu', 'oxsn_exclude_from_search_plugin_tab_nav_item', 99);
	function oxsn_exclude_from_search_plugin_tab_nav_item() {

		add_submenu_page('oxsn-dashboard', 'OXSN Exclude From Search', 'Exclude From Search', 'manage_options', 'oxsn-exclude-from-search', 'oxsn_exclude_from_search_plugin_tab');

	}

}

if ( !function_exists('oxsn_exclude_from_search_plugin_tab') ) {

	function oxsn_exclude_from_search_plugin_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap oxsn_settings_page">
		
			<h2>OXSN / Exclude From Search Plugin</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p>Coming soon.</p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Custom Project</h3>

							<div class="inside">

								<p>Want us to build you a custom project?</p>

								<p><a href="mailto:brief@oxsn.com?Subject=Custom%20Project%20Request%21&Body=Please%20answer%20the%20following%20questions%20to%20help%20us%20better%20understand%20your%20needs..%0A%0A1.%20What%20is%20the%20name%20of%20your%20company%3F%0A%0A2.%20What%20are%20the%20concepts%20and%20goals%20of%20your%20project%3F%0A%0A3.%20What%20is%20the%20proposed%20budget%20of%20this%20project%3F" class="button button-primary button-large">Email Us</a></p>

							</div>
							
						</div>

						<div class="postbox">

							<h3 class="hndle cursor_initial">Support</h3>

							<div class="inside">

								<p>Need help with this plugin? Visit the Wordpress plugin page for support..</p>

								<p><a href="https://wordpress.org/support/plugin/oxsn-exclude-from-search" target="_blank" class="button button-primary button-large">Support</a></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Exclude by Post Type */

if ( ! function_exists ( 'oxsn_exclude_from_search_post_types' ) ) {

	add_action('init', 'oxsn_exclude_from_search_post_types');
	function oxsn_exclude_from_search_post_types() {
		
		global $wp_post_types;

		if (get_option('oxsn_exclude_from_search_post_types_control') != '') {
			$oxsn_exclude_from_search_post_types = get_option( 'oxsn_exclude_from_search_post_types_control' );
		} else {
			$oxsn_exclude_from_search_post_types = '';
		}
		
		if ($oxsn_exclude_from_search_post_types != '') {

			$oxsn_exclude_from_search_post_types_variables = str_replace(' ', '', $oxsn_exclude_from_search_post_types);
			$oxsn_exclude_from_search_post_types_variables = explode(',', $oxsn_exclude_from_search_post_types_variables);

			foreach($oxsn_exclude_from_search_post_types_variables as $oxsn_exclude_from_search_post_types_variable) {

				$wp_post_types[$oxsn_exclude_from_search_post_types_variable]->exclude_from_search = true;

			}

		}

	}

}


?><?php


/* OXSN Exclude by Page ID */

if ( ! function_exists ( 'oxsn_exclude_from_search_page_ids' ) ) {

	add_action('pre_get_posts', 'oxsn_exclude_from_search_page_ids');
	function oxsn_exclude_from_search_page_ids($query) {
		
		if (get_option('oxsn_exclude_from_search_page_ids_control') != '') {
			$oxsn_exclude_from_search_page_ids = get_option( 'oxsn_exclude_from_search_page_ids_control' );
		} else {
			$oxsn_exclude_from_search_page_ids = '';
		}

		if ($oxsn_exclude_from_search_page_ids != '') {

			$oxsn_exclude_from_search_page_ids_variables = str_replace(' ', '', $oxsn_exclude_from_search_page_ids);
			$oxsn_exclude_from_search_page_ids_variables = explode(',', $oxsn_exclude_from_search_page_ids_variables);

			$oxsn_exclude_from_search_page_ids_array = array();

			foreach($oxsn_exclude_from_search_page_ids_variables as $oxsn_exclude_from_search_page_ids_variable) {

				$oxsn_exclude_from_search_page_ids_array[] = $oxsn_exclude_from_search_page_ids_variable;

			}

			if ( $query->is_search && $query->is_main_query() ) {

				$query->set('post__not_in', $oxsn_exclude_from_search_page_ids_array);

			}

		}

	}

}


?>