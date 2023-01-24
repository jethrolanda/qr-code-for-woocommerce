<?php
/**
 * Metabox class
 * 
 * @since   1.0
 */

defined('ABSPATH') || exit;

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;
use PHPUnit\Util\Color;

require_once dirname(QCFW_PLUGIN_FILE) .'/vendor/autoload.php';

/**
 * Main Class.
 */
class QCFW_Metabox
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

      add_action( 'add_meta_boxes', array($this, 'create_meta_boxes') );
      
      
    }

    public function create_meta_boxes() {

      add_meta_box( 'qcfw-qr-code', __( 'Qr Code', 'qr-code-for-woocommerce' ), array($this, 'display_qr_code'), 'product', 'side', 'low' );

    }

    public function display_qr_code() {

      try{

        global $post;

        $data = get_permalink($post->ID);

        // quick and simple:
        echo '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';

      } catch ( Exception  $e ){

        error_log(print_r($e));

      }
      
    }
    
}

new QCFW_Metabox();