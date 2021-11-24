<?php

/**
 * Plugin Name:       adrianpajares.com - WooCommerce Cart
 * Plugin URI:        https://adrianpajares.com/
 * Description:       Plugin to show a WooCommerce resume cart. Use this shortcode to show it [ap_wc_cart].
 * Version:           1.0
 * Author:            adrianpajares.com
 * License:           MIT
*/

add_action( 'wp_enqueue_scripts', 'ap_wc_cart_enqueue_styles' );

function ap_wc_cart_enqueue_styles() {	
	
	$file_url = plugins_url(
		'stylesheet.css', __FILE__
	);

	wp_enqueue_style( 
		'ap_wc_cart_sp_sytlesheet', $file_url
	);
}

function ap_wc_cart() {

    global $woocommerce;
        $items = $woocommerce->cart->get_cart();

            foreach($items as $item => $values) { 
                $_product =  wc_get_product( $values['data']->get_id() );
                $symbol= " €";
                $price = get_post_meta($values['product_id'] , '_price', true);
                ?><div class="ap-wc-cart-item row"><?php
                    //product image
                    ?><div class="ap-wc-cart-image"><?php
                        $getProductDetail = wc_get_product( $values['product_id'] );
                        echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )
                    ?></div><?php

                    ?><div class="ap-wc-cart-text"><?php
                        echo "<b>".$_product->get_title() .'</b>  <br> Qty: '.$values['quantity'] .' ('. $price. $symbol .') '.'<br>'; 
                        //echo $price."<br>";
                        /*Regular Price and Sale Price*/
                        //echo "Regular Price: ".get_post_meta($values['product_id'] , '_regular_price', true)."<br>";
                        //echo "Sale Price: ".get_post_meta($values['product_id'] , '_sale_price', true)."<br>";
                        $qty=$values['quantity'];
                        $total = $qty * $price;
                        echo $total . $symbol;
                    ?></div><?php
                ?></div><hr class="ap-wc-cart"><?php
            }

}
add_shortcode('ap_wc_cart', 'ap_wc_cart');