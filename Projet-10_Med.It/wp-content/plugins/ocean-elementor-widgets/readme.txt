=== Ocean Elementor Widgets ===
Contributors: oceanwp, freemius, apprimit, wpfleek, abhikr781
Requires at least: 5.6
Tested up to: 6.1.1
Stable tag: 2.3.6
Elementor tested up to: 3.11.5
Elementor Pro tested up to: 3.11.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Add many new powerful and entirely customizable widgets to the popular free page builder - Elementor.
This plugin requires the [OceanWP](https://oceanwp.org/) theme to be installed.

== Installation ==

1. Upload `ocean-elementor-widgets` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with the [OceanWP](https://oceanwp.org/) theme.

== Changelog ==

= 2.3.6 - MAR 29 2023 =
- Fixed: News Bar widget: compatibility with Elementor swiper script changes.

= 2.3.5 - MAR 15 2023 =
- Fixed: Blog Grid widget: Uncaught TypeError: Unsupported operand types: int + string in .../ocean-elementor-widgets/modules/blog-grid/widgets/blog-grid.php:667

= 2.3.4 - MAR 8 2023 =
- Added: Magazine Hero widget: Select title tag option.
- Added: Magazine Hero Grid widget: Select title tag option.
- Added: Magazine List widget: Select title tag option.
- Added: Magazine Grid widget: Select title tag option.
- Added: Magazine Grid Simple widget: Select title tag option.
- Improved: Modal widget: Accessibility.
- Improved: Off Canvas widget: Accessibility.
- Improved: Clipboard widget: Accessibility.
- Improved: Switch widget: Accessibility.
- Improved: Ajax Search widget: Accessibility.
- Improved: Carousel / Slider widgets: Functionality with and without Upgrade Swiper Library Elementor experiment.

= 2.3.3 - FEB 28 2023 =
- Added: Prevent Elementor swiper script changes (3.11+ version) influencing carousel and slider scripts.
- Added: Newsletter widget: Accessibility improvements.
- Added: Ocean Elementor Widgets language strings.

= 2.3.2 - JAN 24 2023 =
- Fixed: Newsletter widget: PHP Notice: Undefined Array Key "hide_button_label_mobile".
- Fixed: Newsletter widget: PHP Notice: Undefined Index "hide_button_label".

= 2.3.1 - JAN 10 2023 =
- Added: Newsletter widget: New settings and styling options for the submit button, including responsiveness options.
- Fixed: Magazine Hero widget: z-index value.
- Fixed: Woo Product widgets: Query control.
- Fixed: Search widgets: Form flashing on click if widgets present on the page.

= 2.3.0 - NOV 9 2022 =
- NEW: Magazine Hero Grid widget.
- NEW: Magazine List widget.
- NEW: Magazine Hero widget.
- NEW: Magazine Grid widget.
- NEW: Magazine Grid Simple widget.
- NEW: Make Elementor column clickable.
- Fixed: Login Form: Redirecting to a 404 page after login.
- Fixed: Blog Grid: Pagination doesn't function.
- Fixed: Modal: When timer option is in use the scroll bar disappears.
- Fixed: Woo Slider: Excluding products query doesn't function.
- Fixed: Woo Cart Icon: Cart not displayed after product is added to the cart action.
- Fixed: Google reCAPTCHA v3 validation issue.

= 2.2.3 =
- Added: Blog Grid: Offset feature for posts exclusion.
- Added: Blog Carousel: Offset feature for posts exclusion.

= 2.2.2 =
- Fixed: Modal widgets: Modal popup is not opening when using Timer Ppopup and Exit Intent layout.

= 2.2.1 =
- New: Disable / Enable widgets from loading in the Elementor editor.
- Added: OceanWP Theme Panel changes.
- Fixed: Ocean Blog Carousel: Video post format thumbnail: Choose to display the featured image or video for post thumbnail.
- Fixed: Deprecated function _register_controls replaced with register_controls.
- Fixed: Ocean Woo-Slider: Swiper is not defined.
- Removed: Remove non-standard outdated CSS #349

= 2.2.0 =
- NEW: Twitter Embed.
- NEW: Twitter Timeline.
- NEW: Click to Tweet.
- NEW: Fluent Forms support.
- NEW: Formidable Forms support.
- Fixed: Alignment icons not displayed not displayed.

= 2.1.1 =
- Fixed: News Bar Widget: PHP 7.2 parse error.

= 2.1.0 =
- NEW: Coupon widget.
- NEW: Copy to Clipboard widget.
- NEW: Pricing Menu widget.
- NEW: News Bar widget.
- Added: Register Widget: reCaptcha v3 option.
- Added: Countdown Widget: recurring timer option.
- Fixed: Banner Widget: columns number issue.
- Fixed: Divider Widget: icon typography display issue when usage of Elementor fonts enabled in Elementor settings.
- Retired: Caldera Forms Widget: https://calderaforms.com/2021/03/the-future-of-caldera-forms/

= 2.0.9 =
- Fixed: Hotspots widget: display tooltip content.

= 2.0.8 =
- Added: Banner Widget: Option to choose title tag. H5 set as default per previous settings.
- Added: Blog Grid Widget: Option to choose title tag. H2 set as default per previous settings.
- Added: Blog Carousel Widget: Option to choose title tag. H2 set as default per previous settings.
- Fixed: Hotspots widget: removed HTML title attribute to avoid double tooltip display on hover.

= 2.0.7 =
- Fixed: Image Gallery: column numbers issue on responsive.
- Fixed: Pricing Table (new): border radius issue.
- Fixed: Pricing Table (new): features list border color issue.
- Fixed: Pricing Table (new): features list icons color issue.
- Fixed: Pricing Table (new): tooltip position.
- Fixed: Woo Products and Slider: displaying out of stock items on front end even if this option is disabled in WooCommerce settings.

= 2.0.6 =
- Fixed: Scripts: load issue.

= 2.0.5 =
- Fixed: Compatibility: WooCommerce Single Post Gallery: remove console.log from scripts.

= 2.0.4 =
- Fixed: Minor issues.

= 2.0.3 =
- Improved: Fade and Slide transition effects.
- Fixed: Slider: Swiper: bullet and arrow functionality when 2 or more sliders present on the same page.
- Fixed: HotSpots: extra tooltip displayed on longer hover.
- Fixed: Gallery: navigation arrows missing in Lightbox.
- Fixed: Newsletter Form: MailChimp subscription doesn't function.

= 2.0.2 =
- Fixed: Search Widget JS Error.

= 2.0.1 =
- Fixed: PHP Parse error: syntax error.

= 2.0.0 =
- Added: Vanila JS.

= 1.3.2 =
- Replaced: Elementor deprecated function _content_template with content_template.

= 1.3.1 =
- Added: OceanWP SVG icon support.
- Fixed: Ajax Search widget: search source option.
- Fixed: Newsletter Widget - MailChimp failed subscription issue.

= 1.3.0 =
- Added: Elementor 3.2.1 typography compatibility.
- Fixed: Sliders responsiveness issues.
- Fixed: Call to Action widget button link issue.
- Fixed: Call to Action widget missing image upon plugin update issue.
- Fixed: Recaptcha Display Fatal Error

= 1.2.9 =
- Fixed: Freemius plugin name issue.

= 1.2.8 =
- Fixed: Search widget icon issue.
- Fixed: Ajax Search widget icon issue.

= 1.2.7 =
- Added: New widget: Testimonial.
- Added: New widget: Testimonial Carousel.
- Added: New widget: Member Carousel.
- Added: New widget: Pricing Table.
- Added: New widget: Instagram.
- Tweak: Call to Action widget completely rewritten.
- Tweak: Blog Carousel widget completely rewritten.
- Tweak: Woo Slider widget updated.
- Tweak: Price List widget improved.
- Fixed: Search icon based on selected Theme Icons from the customizer.
- Fixed: Backend styling on some widgets.
- Fixed: Woo Cart Icon widget in italic.

= 1.2.6 =
- Fixed: Switch Widget issue.

= 1.2.5 =
- Added: Blog Carousel Widget - Meta Icon switch.
- Fixed: Newsletter Widget - MailChimp failed subscription issue.

= 1.2.4 =
- Added: Blog Grid Widget - Meta Icon switch.

= 1.2.3 =
- Fixed: Translation issue - translation not reflected on the front end: subtotal, view cart, checkout.
- Fixed: Video thumbnail in the blog grid widget
- Fixed: Video thumbnail in the blog carousel widget

= 1.2.2 =
- Fixed: Navigation widget issue.

= 1.2.1 =
- Fixed: Link Effect and Button Effect Widget issue.
- Fixed: PHP 7.4 compatibilty.

= 1.2.0 =
- Fixed: Widget icon issue - FA5 Integration.
- Added: New setting - Icon size to control the size of Fontawesome and svg icon
- Fixed: Advanced Heading widget link issue.
- Fixed: OEW Blog Carousel Widget - Meta Font Transform settings issue.

= 1.1.9 =
- Added: Codes for Freemius switch.

= 1.1.8 =
- Fixed: PHP warning message.

= 1.1.7 =
- Fixed: Issue with the latest version of Elementor.

= 1.1.6 =
- Fixed: Issue with the Image Comparaison widget on Firefox.
- Fixed: Issue with the Flip Box widget when an image was selected.

= 1.1.5 =
- Fixed: Issue with the WooCommerce page when you try to edit them with Elementor.

= 1.1.4 =
- Added: New widget, Woo Cart Icon.
- Added: New widget, Search Icon.
- Added: Dynamic field for the Banner Link field widget.

= 1.1.3 =
- Fixed: Translation issue with the Business Hours widget.
- Fixed: WPForms widget was not appearing anymore.

= 1.1.2 =
- Added: Dynamic content for the Image Gallery widget.
- Fixed: Google Map widget issue.

= 1.1.1 =
- Fixed: Small issue with the Circle Progress widget text.
- Fixed: Issue with the title of the Call To Action widget.

= 1.1.0 =
- Added: Accordions widget.
- Added: Advanced Custom Field widget, thanks to Bruno Tritsch for the help.
- Added: Advanced Heading widget.
- Added: Animated Heading widget.
- Added: Banner widget.
- Added: Brands widget.
- Added: Business Hours widget.
- Added: Button Effects widget.
- Added: Buttons widget.
- Added: Call To Action widget.
- Added: Circle Progress widget.
- Added: Countdown widget.
- Added: Divider widget, to add a text or an icon in the divider.
- Added: Flip Box widget.
- Added: Google Maps widget.
- Added: Hotspots widget.
- Added: Image Comparison widget.
- Added: Image Gallery widget.
- Added: Info Box widget.
- Added: Instagram Feed widget.
- Added: Link Effects widget.
- Added: Login widget.
- Added: Lost Password widget.
- Added: Register widget.
- Added: Modal widget.
- Added: Navbar widget.
- Added: Off Canvas widget.
- Added: Price List widget.
- Added: Recipe widget.
- Added: Scroll Up widget.
- Added: Switch widget.
- Added: Table widget.
- Added: Tabs widget.
- Added: Team Members widget.
- Added: Timeline widget.
- Added: Contact Form 7 widget.
- Added: Gravity Forms widget.
- Added: WPForms widget.
- Added: Caldera Forms widget.
- Added: Ninja Forms widget.
- Added: WooCommerce Products widget.
- Added: WooCommerce Categories widget.
- Added: WooCommerce Slider widget.
- Added: Dynamic option added, available if you use Elementor Pro.
- Added: Polish translation, thanks to Fin Fafarafiel.
- Tweak: New setting in the Blog Grid widget to accept custom post type.
- Tweak: Improved settings for the Blog Grid widget.
- Tweak: New setting in the Blog Carousel widget to accept custom post type.
- Tweak: Newsletter Form widget improved, you just need to add your MailChimp API Key and List ID in Theme Panel > Integration, and the form will don't redirect anymore.

= 1.0.16 =
- Added: Compatibility with WPML for each widgets.

= 1.0.15 =
- Fixed: Pagination issue with the blog Grid widget when Masonry is used.

= 1.0.14 =
- Deleted: Admin notice if OceanWP is not the theme used.

= 1.0.13 =
- Added: Pagination and Pagination Position fields for the Blog Grid widget.

= 1.0.12 =
- Fixed: Arrows color for the Blog Carousel widget.

= 1.0.11 =
- Tweak: Image size option for the Blog Grid and Blog Carousel widgets.

= 1.0.10 =
- Added: French translation, thanks to Jean of freepixel.net.

= 1.0.9 =
- Tweak: Now, you can add HTML or shortcodes in the Price Table widgets title.

= 1.0.8 =
- Tweak: Better positioning setting for the Logo widget.

= 1.0.7 =
- Added: Logo widget with some fields to use for the custom header style.
- Added: Navigation widget with several styling options to use for the custom header style.
- Added: Ajax Search widget, you will be able to make an ajax search (no page reload).
- Added: Logged In/Out widget, you will be able to display a menu, content or shortcode when a user is logged in or logged out on your site.
- Tweak: Improvement in all widgets classes.

= 1.0.6 =
- Tweak: Scripts loaded only is a widget is used.

= 1.0.5 =
- Added: Control color for the MailChimp widget input.
- Added: Border type for the MailChimp widget input.
- Tweak: Some widgets settings improved.

= 1.0.4.2 =
- Fixed: Issue with StylePress.

= 1.0.4.1 =
- Tweak: JS script, if the carousel or the isotope scripts is disabled, there will be no errors in the console.

= 1.0.4 =
- Tweak: OwlCarousel replaced by Slick script.

= 1.0.3 =
- Fixed: Icons issue.
- Added: Support OceanWP 1.1.

= 1.0.2 =
- Tweak: JS file improved.

= 1.0.1 =
- Added: New tab "Content" in Style to the blog carousel widget.

= 1.0.0 =
- Initial release.
