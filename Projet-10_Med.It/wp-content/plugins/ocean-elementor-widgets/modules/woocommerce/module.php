<?php
namespace owpElementor\Modules\Woocommerce;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Woo_Add_To_Cart',
			'Woo_CartIcon',
			'Woo_Products',
			'Woo_Categories',
			'Woo_Slider'
		];
	}

	public function get_name() {
		return 'oew-woocommerce';
	}

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	public function fix_query_offset( &$query ) {
		if ( ! empty( $query->query_vars['offset_to_fix'] ) ) {
			if ( $query->is_paged ) {
				$query->query_vars['offset'] = $query->query_vars['offset_to_fix'] + ( ( $query->query_vars['paged'] - 1 ) * $query->query_vars['posts_per_page'] );
			} else {
				$query->query_vars['offset'] = $query->query_vars['offset_to_fix'];
			}
		}
	}

	public function fix_query_found_posts( $found_posts, $query ) {
		$offset_to_fix = $query->get( 'offset_to_fix' );

		if ( $offset_to_fix ) {
			$found_posts -= $offset_to_fix;
		}

		return $found_posts;
	}

	public function add_to_cart_product_ajax() {
		$product_id   = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : 0;
		$variation_id = isset( $_POST['variation_id'] ) ? sanitize_text_field( $_POST['variation_id'] ) : 0;
		$quantity     = isset( $_POST['quantity'] ) ? sanitize_text_field( $_POST['quantity'] ) : 0;

		if ( $variation_id ) {
			WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
		} else {
			WC()->cart->add_to_cart( $product_id, $quantity );
		}
		die();
	}

	private static function render_cart_content( $cart_items, $sub_total ) {
		if ( empty( $cart_items ) ) {
			self::render_cart_empty();
			return;
		}

		do_action( 'woocommerce_before_mini_cart' ); ?>

		<ul class="oew-cart-products woocommerce-mini-cart cart">
			<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( $cart_items as $cart_item_key => $cart_item ) {
				self::render_cart_item( $cart_item_key, $cart_item );
			}

			do_action( 'woocommerce_mini_cart_contents' );
			?>
		</ul>

		<div class="oew-cart-subtotal">
			<strong><?php esc_html_e( 'Subtotal', 'ocean-elementor-widgets' ); ?>:</strong> <?php echo $sub_total; ?>
		</div>
		<div class="oew-cart-footer-buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="oew-cart-view-cart oew-button"><?php esc_html_e( 'View cart', 'ocean-elementor-widgets' ); ?></a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="oew-cart-checkout oew-button"><?php esc_html_e( 'Checkout', 'ocean-elementor-widgets' ); ?></a>
		</div>

		<?php
		do_action( 'woocommerce_after_mini_cart' );
	}

	private static function render_cart_empty() { ?>
		<p class="oew-mini-cart-empty-message"><?php _e( 'No products in the cart.', 'ocean-elementor-widgets' ); ?></p>
	<?php
	}

	private static function render_cart_item( $cart_item_key, $cart_item ) {
		$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
			$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
			$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ); ?>

			<li class="oew-mini-cart-item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
				<div class="oew-grid-wrap">
					<div class="oew-grid thumbnail">
						<?php
						if ( ! $product_permalink ) :
							echo wp_kses_post( $thumbnail );
						else :
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
						endif; ?>
					</div>

					<div class="oew-grid content">
						<div>
							<?php if ( empty( $product_permalink ) ) : ?>
								<h3>
									<?php echo $product_name; ?>
								</h3>
							<?php else : ?>
								<h3>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo $product_name; ?>
									</a>
								</h3>
							<?php endif; ?>

							<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>

							<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $cart_item_key ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key ); ?>
						</div>
					</div>
				</div>
			</li>
		<?php
		}

	}

	public static function render_menu_cart() {
		$cart_is_hidden = apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() );
		$cart_count = WC()->cart->get_cart_contents_count();
		$sub_total 	= WC()->cart->get_cart_subtotal();
		$cart_items = WC()->cart->get_cart();

		// If cart or checkout page
		if ( ! $cart_is_hidden ) {
			$cart_link = wc_get_cart_url();
		} else {
			$cart_link = '#';
		} ?>

		<div class="oew-toggle-cart">
			<a href="<?php echo esc_attr( $cart_link ); ?>" class="oew-cart-link">
				<?php
				if ( 'svg' === oceanwp_theme_icon_class() ) {
					ocean_svg( 'cart-menu-1' );
				} else {
					?> <i class="oew-cart-icon"></i> <?php
				}
				?>
				<span class="oew-cart-count"><?php echo $cart_count; ?></span>
				<span class="oew-cart-total"><?php echo $sub_total; ?></span>
			</a>

			<?php
			if ( ! $cart_is_hidden ) { ?>
				<div class="oew-cart-dropdown oew-mini-cart clr">
					<?php self::render_cart_content( $cart_items, $sub_total ); ?>
				</div>
			<?php
			} ?>
		</div>
	<?php
	}

	public function menu_cart_fragments( $fragments ) {
		ob_start();
		self::render_menu_cart();
		$cart_html = ob_get_clean();

		if ( ! empty( $cart_html ) ) {
			$fragments['body:not(.elementor-editor-active) .elementor-widget-oew-woo-cart-icon .oew-toggle-cart'] = $cart_html;
		}

		return $fragments;
	}

	public function maybe_init_cart() {
		$has_cart = is_a( WC()->cart, 'WC_Cart' );

		if ( ! $has_cart ) {
			$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
			WC()->session = new $session_class();
			WC()->session->init();
			WC()->cart = new \WC_Cart();
			WC()->customer = new \WC_Customer( get_current_user_id(), true );
		}
	}

	public function __construct() {
		parent::__construct();

		add_action( 'pre_get_posts', [ $this, 'fix_query_offset' ], 1 );
		add_filter( 'found_posts', [ $this, 'fix_query_found_posts' ], 1, 2 );

		add_action( 'wp_ajax_oew_add_to_cart_product', array( $this, 'add_to_cart_product_ajax' ) );
		add_action( 'wp_ajax_nopriv_oew_add_to_cart_product', array( $this, 'add_to_cart_product_ajax' ) );

		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'maybe_init_cart' ] );
		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'menu_cart_fragments' ] );

		// On Editor - Register WooCommerce frontend hooks before the Editor init.
		// Priority = 5, in order to allow plugins remove/add their wc hooks on init.
		if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
			add_action( 'init', [ $this, 'register_wc_hooks' ], 5 );
		}

	}
}
