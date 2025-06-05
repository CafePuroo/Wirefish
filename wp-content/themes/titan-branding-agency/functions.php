<?php
/**
 * Titan Branding Agency functions
 */

if ( ! function_exists( 'titan_branding_agency_setup' ) ) :
function titan_branding_agency_setup() {

    load_theme_textdomain( 'titan-branding-agency', get_template_directory() . '/languages' );	

	// Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'titan_branding_agency_custom_background_args', array(
	    'default-color' => 'ffffff',
	    'default-image' => '',
    ) ) );

	/**
	 * About Theme Function
	 */
	require get_theme_file_path( '/about-theme/about-theme.php' );
	/**
	 * Customizer
	 */
	require get_template_directory() . '/inc/customizer.php';
}
endif; 
add_action( 'after_setup_theme', 'titan_branding_agency_setup' );

if ( ! function_exists( 'titan_branding_agency_styles' ) ) :
	function titan_branding_agency_styles() {
		// Register theme stylesheet.
		wp_register_style('titan-branding-agency-style',
			get_template_directory_uri() . '/style.css',array(),
			wp_get_theme()->get( 'Version' )
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'titan-branding-agency-style' );

		wp_style_add_data( 'titan-branding-agency-style', 'rtl', 'replace' );

		wp_enqueue_script( 'titan-branding-agency-custom-script', get_theme_file_uri( '/assets/js/custom-script.js' ), array( 'jquery' ), true );
	}
endif;
add_action( 'wp_enqueue_scripts', 'titan_branding_agency_styles' );