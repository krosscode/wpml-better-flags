<?php
/**
 * Plugin Name:  WPML Better Flags
 * Plugin URI:   https://krosscode.dk/
 * Description:  Replaces the default WPML flags with flat, better quality ones.
 * Version:      1.0
 * Author:       KrossCode
 * Author URI:   https://krosscode.dk/
 * License:      MIT
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  wpml-better-flags
 * Domain Path:  /languages
 */

/**
 * Replaces WPML Default Flags with flat, better quality ones.
 * This is overridden, if the user has uploaded their own flag.
 */
function wpml_better_flags( $languages ) {
	foreach ( $languages as $language_code => $language ) {
		if ( strpos( $language[ 'country_flag_url' ], 'plugins/sitepress-multilingual-cms/res/flags/' ) !== false ) {
			/**
			 * If the wpml-better-flags/flags/flag.png exists,
			 * replace the default one, otherwise do nothing.
			 */
			$flag_file     = substr( $language[ 'country_flag_url' ], strrpos( $language[ 'country_flag_url' ], '/' ) + 1 );
			$new_flag_file = plugin_dir_path( __FILE__ ) . 'flags/' . $flag_file;
			$new_flag_url  = plugin_dir_url( __FILE__ ) . 'flags/' . $flag_file;

			if ( file_exists( $new_flag_file ) ) {
				$languages[ $language_code ][ 'country_flag_url' ] = $new_flag_url;
			}
		}
	}

	return $languages;
}
add_filter( 'icl_ls_languages', 'wpml_better_flags', 10, 1 );
add_filter( 'icl_get_languages', 'wpml_better_flags', 10, 1 );
// Add more filters, if any are missing