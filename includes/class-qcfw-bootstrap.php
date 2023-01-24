<?php
/**
 * Main plugin bootstrap class
 * 
 * @since   1.0
 */

defined('ABSPATH') || exit;

/**
 * Main Class.
 */
final class QCFW_Bootstrap
{

    /**
     * Version.
     */
    public $version = '1.0';

    /**
     * The single instance of the class.
     *
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * Main Instance.
     *
     * @since 1.0
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Define all constains here
     *
     * @since 1.0
     * @access public
     */
    private function define_constants()
    {

        $this->define('QCFW_VERSION', $this->version);
        $this->define('QCFW_ABSPATH', dirname(QCFW_PLUGIN_FILE) . '/');
        $this->define('QCFW_PLUGIN_BASENAME', plugin_basename(QCFW_PLUGIN_FILE));
        $this->define('QCFW_PLUGIN_URL', plugins_url() . '/qr-code-for-woocommerce/' );
        $this->define('QCFW_CSS_URL', QCFW_PLUGIN_URL . 'css/' );
        $this->define('QCFW_NOTICE_MIN_PHP_VERSION', '7.2');
        $this->define('QCFW_NOTICE_MIN_WP_VERSION', '5.2');

    }

    /**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param string|bool $value Constant value.
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Include all plugin class
     *
     * @since 1.0
     * @access public
     */
    public function includes()
    {

        include_once QCFW_ABSPATH . 'includes/class-qcfw-scripts.php';
        include_once QCFW_ABSPATH . 'includes/class-qcfw-settings.php';
        include_once QCFW_ABSPATH . 'includes/class-qcfw-shortcode.php';
        include_once QCFW_ABSPATH . 'includes/class-qcfw-metabox.php';

    }

    /**
     * Initialize hooks
     *
     * @since 1.0
     * @access public
     */
    private function init_hooks()
    {

        // Load Plugin Text Domain
        add_action('plugins_loaded', array($this, 'load_plugin_text_domain'));

        // Activate / Deactivate plugin
        register_activation_hook(QCFW_PLUGIN_FILE, array($this, 'activated_plugin'));
        register_deactivation_hook(QCFW_PLUGIN_FILE, array($this, 'deactivated_plugin'));

    }

    /**
     * Load plugin text domain.
     *
     * @since 1.0
     * @access public
     */
    public function load_plugin_text_domain()
    {

        load_plugin_textdomain('wp-spoiler', false, QCFW_ABSPATH . 'languages/');

    }

    /**
     * Ran when any plugin is activated.
     *
     * @since 1.0
     * @param string $filename The filename of the activated plugin.
     */
    public function activated_plugin($filename)
    {

    }

    /**
     * Ran when any plugin is deactivated.
     *
     * @since 1.0
     * @param string $filename The filename of the deactivated plugin.
     */
    public function deactivated_plugin($filename)
    {

    }
}
