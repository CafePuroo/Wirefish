<?php
/**
 * Titan Notice Handler
 */

defined( 'ABSPATH' ) || exit;

define('TITAN_BRANDING_AGENCY_FREE_URL',__('https://www.titanthemes.net/products/free-branding-wordpress-theme','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_PREMIUM_DOCUMENTATION',__('https://preview.titanthemes.net/documentation/titan-branding-agency-pro/','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_SUPPORT',__('https://wordpress.org/support/theme/titan-branding-agency/','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_REVIEW',__('https://wordpress.org/support/theme/titan-branding-agency/reviews/#new-post','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_BUY_NOW',__('https://www.titanthemes.net/products/branding-agency-wordpress-theme','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_DOC_URL',__('https://preview.titanthemes.net/documentation/titan-branding-agency/','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_LIVE_DEMO',__('https://preview.titanthemes.net/titan-branding-agency/','titan-branding-agency'));
define('TITAN_BRANDING_AGENCY_BUNDLE',__('https://www.titanthemes.net/products/wordpress-theme-bundle','titan-branding-agency'));

/**
 * Admin Hook
 */
function titan_branding_agency_admin_menu_page() {
    $titan_branding_agency_theme = wp_get_theme( get_template() );

    add_theme_page(
        $titan_branding_agency_theme->display( 'Name' ),
        $titan_branding_agency_theme->display( 'Name' ),
        'manage_options',
        'titan-branding-agency',
        'titan_branding_agency_do_admin_page'
    );
}
add_action( 'admin_menu', 'titan_branding_agency_admin_menu_page' );

/**
 * Enqueue getting started styles and scripts
 */
function titan_widgets_backend_enqueue() {
    wp_enqueue_style( 'titan-getting-started', get_template_directory_uri() . '/about-theme/about-theme.css' );
}
add_action( 'admin_enqueue_scripts', 'titan_widgets_backend_enqueue' );

/**
 * Class Titan_Notice_Handler
 */
class Titan_Notice_Handler {

    public static $nonce;

    /**
     * Empty Constructor
     */
    public function __construct() {
        // Activation notice
        add_action( 'switch_theme', array( $this, 'flush_dismiss_status' ) );
        add_action( 'admin_init', array( $this, 'getting_started_notice_dismissed' ) );
        add_action( 'admin_notices', array( $this, 'titan_theme_info_welcome_admin_notice' ), 3 );
        add_action( 'wp_ajax_titan_getting_started', array( $this, 'titan_getting_started' ) );
    }

    /**
     * Display an admin notice linking to the about page
     */
    public function titan_theme_info_welcome_admin_notice() {

    $current_screen = get_current_screen();

    $titan_branding_agency_theme = wp_get_theme();
    if ( is_admin() && ! get_user_meta( get_current_user_id(), 'gs_notice_dismissed' ) && $current_screen->base != 'appearance_page_titan-branding-agency' ) {
        echo '<div class="updated notice notice-success is-dismissible getting-started">';
        echo '<p><strong>' . sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s.', 'titan-branding-agency' ), esc_html( $titan_branding_agency_theme->get( 'Name' ) ) ) . '</strong></p>';
        echo '<p class="plugin-notice">' . esc_html__( 'By clicking "Get Started," you can access our theme features.', 'titan-branding-agency' ) . '</p>';
        echo '<div class="titan-buttons">';
        echo '<p><a href="' . esc_url(admin_url('themes.php?page=titan-branding-agency')) . '" class="titan-install-plugins button button-primary">' . sprintf( esc_html__( 'Get started with %s', 'titan-branding-agency' ), esc_html( $titan_branding_agency_theme->get( 'Name' ) ) ) . '</a></p>';
        echo '<p><a href="' . esc_url( TITAN_BRANDING_AGENCY_BUY_NOW ) . '" class="button button-secondary" target="_blank">' . esc_html__( 'GO FOR PREMIUM', 'titan-branding-agency' ) . '</a></p>';
        echo '</div>';
        echo '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'gs-notice-dismissed', 'dismiss_admin_notices' ) ) ) . '" class="getting-started-notice-dismiss">Dismiss</a>';
        echo '</div>';
    }
}

    /**
     * Register dismissal of the getting started notification.
     * Acts on the dismiss link.
     * If clicked, the admin notice disappears and will no longer be visible to this user.
     */
    public function getting_started_notice_dismissed() {
        if ( isset( $_GET['gs-notice-dismissed'] ) ) {
            add_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
        }
    }

    /**
     * Deletes the getting started notice's dismiss status upon theme switch.
     */
    public function flush_dismiss_status() {
        delete_user_meta( get_current_user_id(), 'gs_notice_dismissed' );
    }
}
new Titan_Notice_Handler();

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function titan_branding_agency_do_admin_page() { 
    $titan_branding_agency_theme = wp_get_theme(); ?>
    <div class="titan-branding-agency-themeinfo-page--wrapper">
        <div class="free&pro">
            <div id="titan-branding-agency-admin-about-page-1">
                <div class="theme-detail">
                   <div class="titan-branding-agency-admin-card-header-1">
                    <div class="titan-branding-agency-header-left">
                        <h2>
                            <?php echo esc_html( $titan_branding_agency_theme->Name ); ?> <span><?php echo esc_html($titan_branding_agency_theme['Version']);?></span>
                        </h2>
                        <p>
                            <?php
                            echo wp_kses_post( apply_filters( 'titan_theme_description', esc_html( $titan_branding_agency_theme->get( 'Description' ) ) ) );
                        ?>
                        </p>
                    </div>
                    <div class="titan-branding-agency-header-right">
                        <div class="titan-branding-agency-pro-button">
                            <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_BUY_NOW ); ?>" class="titan-branding-agency-button button-primary" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'UPGRADE TO PREMIUM', 'titan-branding-agency' ); ?>
                            </a>
                        </div>
                    </div>
                </div>   
                </div>   
                <div class="titan-branding-agency-features">
                    <div class="titan-branding-agency-features-box">
                        <h3><?php esc_html_e( 'PREMIUM DEMONSTRATION', 'titan-branding-agency' ); ?></h3>
                        <p><?php esc_html_e( 'Effortlessly create and customize your website by arranging text, images, and other elements using the Gutenberg editor, making web design easy and accessible for all skill levels.', 'titan-branding-agency' ); ?></p>
                        <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_LIVE_DEMO ); ?>" class="titan-branding-agency-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DEMONSTRATION', 'titan-branding-agency' ); ?>
                            </a>
                    </div>
                    <div class="titan-branding-agency-features-box">
                        <h3><?php esc_html_e( 'REVIEWS', 'titan-branding-agency' ); ?></h3>
                        <p><?php esc_html_e( 'We would be happy to hear your thoughts and value your evaluation.', 'titan-branding-agency' ); ?></p>
                        <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_REVIEW ); ?>" class="titan-branding-agency-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'REVIEWS', 'titan-branding-agency' ); ?>
                            </a>
                    </div>
                    <div class="titan-branding-agency-features-box">
                        <h3><?php esc_html_e( '24/7 SUPPORT', 'titan-branding-agency' ); ?></h3>
                        <p><?php esc_html_e( 'Please do not hesitate to contact us at support if you need help installing our lite theme. We are prepared to assist you!', 'titan-branding-agency' ); ?></p>
                        <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_SUPPORT ); ?>" class="titan-branding-agency-button button-secondary-1" target="_blank" rel="noreferrer">
                            <?php esc_html_e( 'SUPPORT', 'titan-branding-agency' ); ?>
                        </a>
                    </div>
                    <div class="titan-branding-agency-features-box">
                        <h3><?php esc_html_e( 'THEME INSTRUCTION', 'titan-branding-agency' ); ?></h3>
                        <p><?php esc_html_e( 'If you need assistance configuring and setting up the theme, our tutorial is available. A fast and simple method for setting up the theme.', 'titan-branding-agency' ); ?></p>
                        <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_DOC_URL ); ?>" class="titan-branding-agency-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DOCUMENTATION', 'titan-branding-agency' ); ?>
                            </a>
                    </div>
                </div>   
            </div>
            <div id="titan-branding-agency-admin-about-page-2">
                <div class="theme-detail">
                   <div class="titan-branding-agency-admin-card-header-1">
                        <div class="titan-branding-agency-header-left-pro"> 
                            <h2><?php esc_html_e( 'The premium version of this theme will be available for you to enhance or unlock our premium features.', 'titan-branding-agency' ); ?></h2>
                        </div>
                        <div class="titan-branding-agency-header-right-2">
                            <div class="titan-branding-agency-pro-button">
                                <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_BUY_NOW ); ?>" class="titan-branding-agency-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'GO TO PREMIUM', 'titan-branding-agency' ); ?>
                                </a>
                            </div>
                            <div class="titan-branding-agency-pro-button">
                                <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_LIVE_DEMO ); ?>" class="titan-branding-agency-button button-primary-1 pro-demo" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PREMIUM DEMO', 'titan-branding-agency' ); ?>
                                </a>
                            </div>
                             <div class="titan-branding-agency-pro-button">
                                <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_PREMIUM_DOCUMENTATION ); ?>" class="titan-branding-agency-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PRO DOCUMENTATION', 'titan-branding-agency' ); ?>
                                </a>
                            </div>  
                        </div>
                    </div>
                    <div class="titan-branding-agency-admin-card-header-2">
                        <img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $titan_branding_agency_theme->get_screenshot() ); ?>" />
                    </div>
                    <div class="titan-branding-agency-pro-button bundle">
                        <a href="<?php echo esc_url( TITAN_BRANDING_AGENCY_BUNDLE ); ?>" class="titan-branding-agency-button button-primary-1 bundle" target="_blank" rel="noreferrer">
                            <?php esc_html_e( 'BUY THEME BUNDLE', 'titan-branding-agency' ); ?>
                        </a>
                    </div>  
                </div>    
            </div>
        </div>
    </div>
<?php } ?>