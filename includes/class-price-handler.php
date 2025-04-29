<?php
class Price_Handler {
    private static $instance = null;

    public static function get_instance() {
        if ( self::$instance == null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_filter( 'woocommerce_get_price_html', array( $this, 'adjust_price_based_on_country' ), 10, 2 );
    }

    public function adjust_price_based_on_country( $price_html, $product ) {
        // Get the country from session
        $user_country = WC()->session->get( 'user_country' );

        // Get product pricing based on country
        $price = $this->get_price_for_country( $product, $user_country );

        // Return the modified price
        return wc_price( $price );
    }

    public function get_price_for_country( $product, $country ) {
        // Here you can add logic for fetching prices based on country
        // For example, a manual price entry or automatic conversion using an API

        $manual_price = get_post_meta( $product->get_id(), '_manual_price_' . $country, true );
        if ( $manual_price ) {
            return $manual_price;  // Return manual price if available
        }

        // Otherwise, apply exchange rate logic
        $exchange_rate = Exchange_Rate::get_exchange_rate( $country );
        return $product->get_regular_price() * $exchange_rate;
    }
}
