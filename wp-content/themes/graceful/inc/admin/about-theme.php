<?php
/**
 * About Graceful Page Dashboard
 *
 * @package Graceful
 */

function graceful_about_page_dashboard() {
	add_theme_page( esc_html__( 'About Graceful Theme', 'graceful' ), esc_html__( 'Graceful Theme', 'graceful' ), 'edit_theme_options', 'about-theme', 'display_graceful_about_page', 1 );
}
add_action( 'admin_menu', 'graceful_about_page_dashboard' );

// Display About Graceful page
function display_graceful_about_page() {
?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Welcome to Graceful!', 'graceful' ); ?></h1>
		<p class="welcome-text">
			<?php esc_html_e( 'Graceful is a free multi-purpose WordPress Blog theme. Its perfect for any kind of blog or website: personal, professional, tech, fashion, travel, health, lifestyle, food, blogging etc. Its fully Responsive and Retina Display ready, clean, modern and minimal design. Graceful is WooCommerce compatible, SEO friendly and also has RTL support.', 'graceful' ); ?>
		</p>

		<!-- Tabs -->
		<?php $active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_text_field( wp_unslash($_GET[ 'tab' ]) ) : 'graceful_tab_1'; ?>  
	
		<div class="nav-tab-wrapper">
			<a href="?page=about-theme&tab=graceful_tab_1" class="nav-tab <?php echo $active_tab == 'graceful_tab_1' ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Getting Started', 'graceful' ); ?>
			</a>
			<a href="?page=about-theme&tab=graceful_tab_2" class="nav-tab <?php echo $active_tab == 'graceful_tab_2' ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Graceful Pro', 'graceful' ); ?>
			</a>
		</div>

		<!-- Tab Content -->
		<?php if ( $active_tab == 'graceful_tab_1' ) : ?>

			<div class="three-columns-wrap">

				<br>

				<div class="column-width-3">
					<h3><?php esc_html_e( 'Theme Customizer', 'graceful' ); ?></h3>
					<p>
					<?php esc_html_e( 'Find all theme options conveniently located here. Once you have reviewed the Theme Documentation, we suggest opening the Theme Customizer to experiment with various settings. It will be an enjoyable experience!', 'graceful' ); ?>
					</p>
					<a target="_blank" href="<?php echo esc_url( wp_customize_url() );?>" class="button button-primary"><?php esc_html_e( 'Customize Your Site', 'graceful' ); ?></a>
				</div>

				<div class="column-width-3">
					<h3><?php esc_html_e( 'Recommended Plugins', 'graceful' ); ?></h3>
					<p><?php esc_html_e( 'Graceful theme provides full support for Recommended Plugins, styling them to seamlessly blend with the themes design and ensure optimal performance. Optional, yet advantageous.', 'graceful' ); ?></p>
					<?php
					echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ) ) .'" class="button button-primary">'. esc_html__( 'Install Recommended Plugins', 'graceful' ) .'</a></p>';
					?>
				</div>

				<div class="column-width-3">
					<h3>
						<span class="dashicons dashicons-book"></span>
						<?php esc_html_e( 'Documentation', 'graceful' ); ?>
					</h3>
					<p>
						<?php esc_html_e( 'Require additional information? Explore our documentation for guidance on utilizing Graceful to its fullest potential.', 'graceful' ); ?>
						<hr>
						<a target="_blank" href="<?php echo esc_url('http://optimathemes.com/themes/graceful/docs/?ref=graceful-about-docs-btn/'); ?>"><?php esc_html_e( 'Read Full Documentation', 'graceful' ); ?></a>
					</p>
				</div>

			</div>

		<?php elseif ( $active_tab == 'graceful_tab_2' ) : ?>

			<div class="graceful-table-wrap">

			<table class="free-vs-pro form-table">
				<thead>
					<tr>
						<th>
							<a href="<?php echo esc_url('http://optimathemes.com/themes/graceful-pro/?ref=about-get-pro-top'); ?>" target="_blank" class="button button-primary button-hero">
								<?php esc_html_e( 'Get Graceful Pro', 'graceful' ); ?>
							</a>
						</th>
						<th><?php esc_html_e( 'Graceful Free', 'graceful' ); ?></th>
						<th><?php esc_html_e( 'Graceful Pro', 'graceful' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Responsive and Retina Ready', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Enjoy a fully responsive design that adapts seamlessly to any device screen, including high-resolution Retina displays.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Translation Ready', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Easily translate every element of the theme, as it comes with language support and includes an "graceful.pot" file for effortless translation.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'RTL Support', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Catering to languages that are read from right to left, such as Arabic and Hebrew, the theme provides an RTL stylesheet for proper content adaptation.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'WooCommerce Integration', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Seamlessly integrate the best eCommerce solution for WordPress websites, allowing you to create your own shop and sell a wide range of products, from digital goods to books.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Contact Form 7 Support', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Enjoy compatibility with the popular Contact Form 7 plugin, enabling you to create versatile and customizable contact forms easily.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Image & Text Logos', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Personalize your websites branding by either uploading a custom logo image (with adjustable size) or using a text-based logo.', 'graceful' ); ?><br>
								<strong class="only-pro"><?php esc_html_e( 'Pro Version:', 'graceful' ); ?></strong> <?php esc_html_e( 'Adjust position of Logo to fit custom header design.', 'graceful' ); ?> 
							</p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Posts Slider', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Display up to 3 random blog posts in the header area with a visually appealing slider.', 'graceful' ); ?>
								<br>
								<strong class="only-pro"><?php esc_html_e( 'Pro Version:', 'graceful' ); ?></strong> <?php esc_html_e( 'Unlimited Slides. Feature specific posts and order by date or random. Set as Autoplay and enable or disable elements with more control.', 'graceful' ); ?>  
							</p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Background Image/Color', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Customize the body background by either setting a custom image or choosing a specific color.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Classic Layout', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Opt for the standard one-column blog feed layout for a clean and timeless look.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Multi-level Sub Menu Support', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Create submenus with multiple levels to accommodate complex navigation structures.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Left & Right Sidebars', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Widgetized areas on the left and right sides, which can be enabled or disabled globally.', 'graceful' ); ?>
							</p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Sidebar Slide Menu', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'An alternative widgetized sidebar that remains hidden by default and appears upon clicking.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					
					<!-- Only Pro -->
					<tr>
						<td>
							<h3><?php esc_html_e( 'Special Links (Feature Boxes)', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Display up to 5 eye-catching linked images beneath the header, serving as custom page links or banners/ads.', 'graceful' ); ?> 
								<br>
								<strong class="only-pro"><?php esc_html_e( 'Pro Version:', 'graceful' ); ?></strong> <?php esc_html_e( 'Upto 5 Special Links.', 'graceful' ); ?>
							</p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'One-Click Demo Import', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'With just a single click, you can import the exact content displayed on our demo website. This includes menus, posts, pages, widgets, and more.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Customizable Colors', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Unlimited color options to personalize your header, content, and footer independently, allowing you to create a unique look and feel.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Extensive Google Fonts Collection', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Choose from over 300 Google Fonts, giving you a wide range of typography options. Adjust font size, font weight etc. to achieve the perfect style.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Social Media Sharing Icons', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Options to share your blog posts on popular social media platforms such as Twitter, Facebook, Pinterest, Linkedin, etc.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Sticky Navigation', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Keep your main navigation fixed at the top of the page for easy access and enhanced user experience.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Instagram Widget Area', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Display your Instagram Images in a dedicated widget area located in the footer of your website, to showcase recent photos.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'JetPack Integration', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Take advantage of the comprehensive toolkit provided by Jetpack for WordPress. Secure and grow your site using this all-in-one bundle.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Gracefulg Pro Widgets', 'graceful' ); ?></h3>
							<p><?php esc_html_e( 'Benefit from a range of professional widgets including Graceful Author, Ads, and Social Icons, enhancing the functionality and appearance of your website.', 'graceful' ); ?></p>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>


					<tr>
						<td></td>
						<td colspan="2">
							<a href="<?php echo esc_url('http://optimathemes.com/themes/graceful-pro/?ref=about-get-pro-bottom'); ?>" target="_blank" class="button button-primary button-hero">
								<?php esc_html_e( 'Get Graceful Pro', 'graceful' ); ?>
							</a>
							<br>
						</td>
					</tr>
				</tbody>
			</table>
			</div> <!-- .graceful-table-wrap -->

	    <?php endif; ?>

	</div><!-- /.wrap -->
<?php
} // end display_graceful_about_page

// Check if plugin is installed
function graceful_check_installed_plugin( $slug, $filename ) {
	return file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php' ) ? true : false;
}

// Generate Recommended Plugin HTML
function graceful_recommended_plugin( $slug, $filename, $name, $description) {

	if ( $slug === 'facebook-pagelike-widget' ) {
		$size = '128x128';
	} else {
		$size = '256x256';
	}

?>

	<div class="plugin-card">
		<div class="name column-name">
			<h3>
				<?php echo esc_html( $name ); ?>
				<img src="<?php echo esc_url('https://ps.w.org/'. $slug .'/assets/icon-'. $size .'.png') ?>" class="plugin-icon" alt="">
			</h3>
		</div>
		<div class="action-links">
			<?php if ( graceful_check_installed_plugin( $slug, $filename ) ) : ?>
			<button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e( 'Installed', 'graceful' ); ?></button>
			<?php else : ?>
			<a class="install-now button-primary" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='. $slug ), 'install-plugin_'. $slug ) ); ?>" >
				<?php esc_html_e( 'Install Now', 'graceful' ); ?>
			</a>							
			<?php endif; ?>
		</div>
		<div class="desc column-description">
			<p><?php echo esc_html( $description ); ?></p>
		</div>
	</div>

<?php
}

// enqueue ui CSS/JS
function enqueue_about_graceful_page_scripts($hook) {

	if ( 'appearance_page_about-theme' != $hook ) {
		return;
	}

	// enqueue CSS
	wp_enqueue_style( 'about-theme-css', get_theme_file_uri( '/inc/admin/css/about-theme.css' ) );

}
add_action( 'admin_enqueue_scripts', 'enqueue_about_graceful_page_scripts' );