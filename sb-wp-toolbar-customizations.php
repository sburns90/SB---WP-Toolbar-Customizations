<?php
	  /*
	  Plugin Name: SB - Toolbar Customizations
	  Plugin URI: http://www.StephenBurns.net
	  Description: Adds several links to the admin toolbar for logged in users to help them navigate a communal multisite environment. Required plugins SB - Proper MS Login Redirect, SB - Proper My Sites, and Peters Login Redirect.
	  Version: 1.0
	  Author: Stephen Burns
	  Author URI: http://www.StephenBurns.net/
	  License: GPL2
	  */
    
    /*  Copyright 2015 Stephen Burns  (email : Stephen@StephenBurns.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  	*/

	  /* TO DO: 
	  * UNFISHIED (4-18-16) Maybe add a ability to edit the toolbar menu similar to how someone would edit the frontend website menu. 
	  * NOTE: This is likely to never get done as I do not have the PHP / WordPress skills nor the time to add such a feature. 
	  * */
	  
?>

<?php
add_action('admin_bar_menu', 'back_to_my_sites', 999);

/* Load the style sheet that contains the icons*/

	function back_to_my_sites($wp_admin_bar) {
		if (!(is_user_logged_in())){
			//echo "NOT LOGGED IN";
			return;
		}
		elseif (current_user_can('administrator')){
			/* Load the style sheet that contains the icons*/
			function toolbar_load_styles() {
				wp_enqueue_style('', plugins_url('styles.css', __FILE__));
				/*wp_enqueue_style('', get_home_path('wp-includes/css/admin-bar.css', __FILE__));*/
			}
			add_action('wp_enqueue_scripts', 'toolbar_load_styles');
			
			/* Set title (with icon) to the help menu */
			$title = '<span class="ab-icon"></span><span class="ab-label">' . _x( 'help', 'admin bar menu group label' );

			$wp_admin_bar->add_menu( array(
			'id'    => 'help',
			'title' => $title,
			'href' => get_site_url(1,'/help/'),
			'title' => _x( 'Get Help', 'admin bar menu group label' ),
			) );
			$wp_admin_bar->add_menu( array(
			'parent' => 'help',
			'id' => 'sb-help-page',
			'title' => 'Main Help',
			'href' => get_site_url(1,'/help/'),
			) );
			$wp_admin_bar->add_menu( array(
			'parent' => 'help',
			'id' => 'getting-started',
			'title' => 'Getting Started',
			'href' => get_site_url(1,'/help/getting-started'),
			));
			$wp_admin_bar->add_menu( array(
			'parent' => 'help',
			'id' => 'sidekick-help',
			'title' => 'Sidekick Help',
			'href' => get_site_url(1,'/help/sidekick-help'),
			));
			$wp_admin_bar->add_menu( array(
			'parent' => 'help',
			'id' => 'guides',
			'title' => 'List of Guides',
			'href' => get_site_url(1,'/help/guides'),
			));		
		}
		else {
		$wp_admin_bar->add_menu( array(
			'id' => 'back-to-my-site',
			'title' => 'Back To My Site',
			'href' => site_url('/login/'),
			) );
		}
	}
?>
