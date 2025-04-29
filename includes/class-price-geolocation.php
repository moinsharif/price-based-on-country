<?php
class Price_Geolocation {
    private static $instance = null;

    public static function get_instance() {
        if ( self::$instance == null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action( 'init', array( $this, 'detect_user_country' ) );
    }

    public function detect_user_country() {
        // Using WooCommerce built-in geolocation
        $geolocation = WC_Geolocation::geolocate_ip();
        $country = $geolocation['country'];
        echo $country;
    

        // Set the user's country as a session variable
        WC()->session->set( 'user_country', $country );
    }
}


// Change product price based on shipping country

function custom_price_based_on_shipping_country( $price, $product ) {

    // Get the shipping country

    $shipping_country = WC()->session->get( 'shipping_country' );
 
    // Check if a shipping country is available

    if ( ! empty( $shipping_country ) ) {

        // Example: Apply different price if shipping country is 'US'

        if ( $shipping_country === 'US' ) {

            // Modify the price for users in the US

            // Example: Apply a 10% discount

            $price = $price * 0.9;

        } elseif ( $shipping_country === 'CA' ) {

            // Modify the price for users in Canada

            // Example: Apply a 15% increase

            $price = $price * 1.15;

        }

        // Add more conditions for other countries as needed

    }
 
    return $price; // Return the modified price

}
 
add_filter( 'woocommerce_product_get_price', 'custom_price_based_on_shipping_country', 10, 2 );

add_filter( 'woocommerce_product_get_regular_price', 'custom_price_based_on_shipping_country', 10, 2 );

add_filter( 'woocommerce_product_get_sale_price', 'custom_price_based_on_shipping_country', 10, 2 );

 
?>

<!-- <script>
    console.log('Price Geolocation script loaded' , <?=$country?>);
</script> -->
