<?php
/**
 * Plugin Name: Resoto Companion
 * Description: A companion plugin for Resoto WordPress Theme.
 * Plugin URI:  https://mysticalthemes.com/
 * Version:     1.0.0
 * Author:      Elementor
 * Author URI:  https://mysticalthemes.com/
 * Text Domain: resoto-companion
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** Some pre define value for easy use **/
define( 'RESOTO_VER', '1.0.0' );
define( 'RESOTO__FILE__', __FILE__ );
define( 'RESOTO_PNAME', basename( dirname(RESOTO__FILE__)) );
define( 'RESOTO_PBNAME', plugin_basename(RESOTO__FILE__) );
define( 'RESOTO_PATH', plugin_dir_path( RESOTO__FILE__ ) );
define( 'RESOTO_MODULES_PATH', RESOTO_PATH . 'widgets/' );
define( 'RESOTO_URL', plugins_url( '/', RESOTO__FILE__ ) );
define( 'RESOTO_ASSETS_URL', RESOTO_URL . 'assets/' );
define( 'RESOTO_VENDORS_URL', RESOTO_URL . 'vendors/' );
define( 'RESOTO_MODULES_URL', RESOTO_URL . 'modules/' );

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Resoto_Companion {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Resoto_Companion The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Resoto_Companion An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'resoto-companion' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		/** Add Image Sizes **/
		add_image_size( 'resoto-room-carousel', 640, 700, true );
		add_image_size( 'resoto-blogs-carousel', 400, 280, true );
		add_image_size( 'resoto-testimonial-carousel', 80, 80, true );

		/** WP Hotel Booking Extra Options Meta **/
		add_action('add_meta_boxes', [ $this, 'add_metabox' ] );
		add_action('save_post', [ $this, 'save_eo_icon_cb' ] );

		/** Enqueue Styles and Scripts in Post Page only **/
		add_action('admin_print_styles-post.php', [ $this, 'add_metabox_scripts' ] );
		add_action('admin_print_styles-post-new.php', [ $this, 'add_metabox_scripts' ] );

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		/** Include Helper File **/
		require_once( __DIR__ . '/inc/helper.php' );

		/** Register Widget Styles **/
		add_action( 'elementor/frontend/before_register_styles', [ $this, 'enqueue_widget_styles' ] );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'enqueue_site_scripts' ] );

		/** Add Widget Categories **/
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		/** Add Widgets **/
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		/** Add Control **/
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
	}

	/** Enqueue Metabox Scripts **/
	function add_metabox_scripts() {
		/** Lineicons Styles **/
		wp_enqueue_style( 'lineicons', RESOTO_VENDORS_URL . 'line-icons/LineIcons.min.css' );

		/** Custom Styles **/
		wp_enqueue_style( 'resoto-companion-styles', RESOTO_ASSETS_URL . 'css/custom-styles.css' );

		/** Resoto Companion Custom Scripts **/
		wp_enqueue_script( 'resoto-companion-scripts', RESOTO_ASSETS_URL . 'js/custom-scripts.js', array('jquery') );
	}

	/** Add Extra Option Metabox **/
	public function add_metabox() {
		add_meta_box(
			'resoto_eo_icon',
			esc_html__( 'Feature Icon', 'resoto' ),
			array( $this, 'eo_icon_cb' ),
			'hb_extra_room',
			'side',
			'high'
		);
	}

	/** resoto_eo_icon_cb Callback function **/
	public function eo_icon_cb() {
		global $post;

		$lineicons = array (
			'lni-bi-cycle',
			'lni-dinner',
			'lni-signal',
			'lni-surfboard',
			'lni-wheelchair',
			'lni-calendar',
			'lni-apartment',
			'lni-island',
			'lni-service',
			'lni-gift',
		);

		wp_nonce_field( basename( __FILE__ ), 'resoto_eo_icon_nonce' );
		$resoto_eo_icon = get_post_meta( $post->ID, 'resoto_eo_icon', true );
		?>
		<div class="resoto_extra_feat_icon">
			<?php if( !empty( $lineicons ) ) : ?>
				<ul class="resoto_eo_iconlist">
					<?php foreach( $lineicons as $icon ) : ?>
						<?php $class = ( $resoto_eo_icon == $icon ) ? 'active' : ''; ?>
						<li class="<?php echo esc_attr($class); ?>">
							<span class="<?php echo esc_attr( $icon ); ?>" ></span>
						</li>
					<?php endforeach; ?>
				</ul>
				<input name="resoto_eo_icon" id="resoto_eo_icon" type="hidden" value="" />
			<?php endif; ?>
		</div>
		<?php
	}

	/** Resoto Save Extra Option feature icons **/
	public function save_eo_icon_cb( $post_id ) {
	    global $post; 
	    // Verify the nonce before proceeding.
	    if ( !isset( $_POST[ 'resoto_eo_icon_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ 'resoto_eo_icon_nonce' ] ) ), basename( __FILE__ ) ) ) {
	        return;
	    }

	    // Stop WP from clearing custom fields on autosave
	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE){
	        return;
	    }

	    if ( isset( $_POST['post_type'] ) && 'hb_extra_room' == $_POST['post_type']) {  
	        if (!current_user_can( 'edit_page', $post_id ) )  
	        return $post_id;  
	    }

	    $resoto_eo_icon = isset( $_POST['resoto_eo_icon'] ) ? sanitize_text_field( wp_unslash($_POST['resoto_eo_icon']) ) : '';

    	update_post_meta($post_id, 'resoto_eo_icon', $resoto_eo_icon);  
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'resoto-companion' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'resoto-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'resoto-companion' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'resoto-companion' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'resoto-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'resoto-companion' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'resoto-companion' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'resoto-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'resoto-companion' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/** Enqueue Widget Styles **/
	public function enqueue_widget_styles() {

		/** Vendor Styles **/
		wp_enqueue_style( 'owl-carousel', RESOTO_VENDORS_URL . 'owl-carousel/owl.carousel.min.css' ); // Owl Carousel

		/** Custom Styles **/
		wp_enqueue_style( 'resoto-companion', RESOTO_ASSETS_URL . 'css/resoto-companion.css' );

	}

	/** Enqueue Widget Scripts **/
	public function enqueue_site_scripts() {

		/** Vendor Scripts **/
		wp_register_script( 'owl-carousel',  RESOTO_VENDORS_URL . 'owl-carousel/owl.carousel.min.js', [ 'jquery' ] ); // Owl Carousel

	}

	/** Register Widget Category **/
	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'resoto-elements',
			[
				'title' => esc_html__( 'Resoto Elements', 'resoto-companion' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/resoto-counter-widget.php' );
		require_once( __DIR__ . '/widgets/resoto-rooms-carousel-widget.php' );
		require_once( __DIR__ . '/widgets/resoto-testimonial-carousel-widget.php' );
		require_once( __DIR__ . '/widgets/resoto-blogs-carousel-widget.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Resoto_Counter_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Resoto_Rooms_Carousel_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Resoto_Testimonial_Carousel_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Resoto_Blogs_Carousel_Widget() );

	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		// Include Control files
		require_once( __DIR__ . '/controls/resoto-icons-control.php' );

		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'resotoicon', new \Resoto_Icons_Control() );

	}

}

Resoto_Companion::instance();

/** Remove After All the task is done **/
function ppr( $data ) {
	echo "<pre>";
	print_r( $data );
	echo "</pre>";
}

function vvr( $data ) {
	echo "<pre>";
	var_dump( $data );
	echo "</pre>";
}