<?php
/**
 * Enqueue scripts.
 */
function twp_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'twp', twp_get_mix_compiled_asset_url( 'assets/css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'twp', twp_get_mix_compiled_asset_url( 'assets/js/app.js' ), array( 'jquery' ), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'twp_enqueue_scripts' );

/**
 * Get mix compiled asset.
 *
 * @param string $path The path to the asset.
 *
 * @return string
 */
function twp_get_mix_compiled_asset_url( $path ) {
	$path                = '/' . $path;
	$stylesheet_dir_uri  = get_stylesheet_directory_uri();
	$stylesheet_dir_path = get_stylesheet_directory();

	if ( ! file_exists( $stylesheet_dir_path . '/mix-manifest.json' ) ) {
		return $stylesheet_dir_uri . $path;
	}

	$mix_file_path = file_get_contents( $stylesheet_dir_path . '/mix-manifest.json' );
	$manifest      = json_decode( $mix_file_path, true );
	$asset_path    = ! empty( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return $stylesheet_dir_uri . $asset_path;
}