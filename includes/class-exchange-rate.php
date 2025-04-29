<?php
class Exchange_Rate {
    public static function get_exchange_rate( $country ) {
        // Fetch exchange rate data from a source like an API
        // Example: https://api.exchangerate-api.com/v4/latest/USD
        $api_url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response = wp_remote_get( $api_url );
        if ( is_wp_error( $response ) ) {
            return 1;  // Return 1 if error (no conversion)
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( isset( $data['rates'][ $country ] ) ) {
            return $data['rates'][ $country ];
        }

        return 1;  // Default exchange rate if not found
    }
}
