<?php

add_theme_support( 'title-tag' );

// CSS
function theme_styles() {
    // fonts
  // wp_enqueue_style('theme_fonts', 'https://use.typekit.net/wjp7asp.css', null, null);
  // local styles
  wp_enqueue_style('theme_css', get_template_directory_uri() . '/css/styles.min.css', null, null);
}
add_action( 'wp_enqueue_scripts', 'theme_styles');

// JavaScript
function theme_js() {

	wp_deregister_script('jquery');
  wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
  wp_enqueue_script( 'jquery' );

  // Conditionals for legacy IE browsers
  global $wp_scripts;

  wp_register_script('html5_shiv', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', false, null, false);
  wp_register_script('respond_js', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', false, null, false);

  $wp_scripts->add_data('html5_shiv', 'conditional', 'lt IE 9');
  $wp_scripts->add_data('respond_js', 'conditional', 'lt IE 9');

  // Theme JS and jQuery
  wp_enqueue_script('footer-js', get_template_directory_uri() . '/js/footer-scripts.min.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'theme_js');


// Additional menus
add_theme_support('menus');

function register_theme_menus() {
  register_nav_menus(
    array(
      'header-menu' => __('Header Menu'),
      'footer-menu' => __('Footer Menu')
    )
  );
}
add_action('init', 'register_theme_menus');


// Turns on featured image option in custom post types
function theme_images() {
  add_theme_support( 'post-thumbnails' );
  // Custom image sizes
  add_image_size( 'banner-full', 1440, 980, true );
  add_image_size( 'banner', 1440, 650, true );
  add_image_size( 'column-image', 635, 425, true );
  add_image_size( 'testimonial', 540, 540, true );
  add_image_size( 'leadership-bio', 1440, 600, true );
  add_image_size( 'post-card', 530, 400, false );
}
add_action( 'after_setup_theme', 'theme_images' );


if ( ! is_admin() ) {
  // disable srcset on frontend
  add_filter('max_srcset_image_width', create_function('', 'return 1;'));

  // Convert thumbnail images to lazyload format
  add_filter( 'wp_get_attachment_image_attributes', 'wpse8170_add_lazyload_to_attachment_image', 10, 2 );
  function wpse8170_add_lazyload_to_attachment_image( $attr, $attachment ) {
      $attr['data-src'] = $attr['src'];
      $attr['src'] = get_template_directory_uri().'/img/x.gif';
      $attr['class'] = 'lazy';
      return $attr;
  }
}

// Global options (ACF)
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(
		array(
		'page_title' 	=> 'Company Details',
			)
		);
}


// Remove emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


// Allow uploading svg
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// Custom Gutenberg block category
function custom_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'gaf',
				'title' => __( 'GAF Custom Elements', 'gaf' ),
			),
		)
	);
}
add_filter( 'block_categories', 'custom_block_category', 10, 2);


// ACF Gutenberg Blocks
function register_acf_block_types() {

    // banner block.
    acf_register_block_type(array(
        'name'              => 'banner',
        'title'             => __('Hero Image'),
        'description'       => __('A custom hero image block.'),
        'render_template'   => 'template-parts/blocks/banner.php',
        'category'          => 'gaf',
        'icon'              => 'format-image',
        'keywords'          => array( 'banner', 'hero' ),
    ));

    // key stat block.
    acf_register_block_type(array(
        'name'              => 'key-stat',
        'title'             => __('Key Statistics'),
        'description'       => __('A custom block for showing some stats.'),
        'render_template'   => 'template-parts/blocks/key-stats.php',
        'category'          => 'gaf',
        'icon'              => 'chart-bar',
        'keywords'          => array( 'statistics', 'figures' ),
    ));

    // text and image block.
    acf_register_block_type(array(
        'name'              => 'text-image',
        'title'             => __('Text and Image Columns'),
        'description'       => __('A custom block for a text column with an image column.'),
        'render_template'   => 'template-parts/blocks/text-image.php',
        'category'          => 'gaf',
        'icon'              => 'translation',
        'keywords'          => array( 'image', 'text', 'column' ),
    ));

    // image and testimonial block.
    acf_register_block_type(array(
        'name'              => 'image-testimonial',
        'title'             => __('Image and Testimonial Columns'),
        'description'       => __('A custom block for an image column with a testimonial.'),
        'render_template'   => 'template-parts/blocks/image-testimonial.php',
        'category'          => 'gaf',
        'icon'              => 'format-chat',
        'keywords'          => array( 'image', 'testimonial', 'column' ),
    ));

    // featured articles block.
    acf_register_block_type(array(
        'name'              => 'featured-articles',
        'title'             => __('Featured Articles'),
        'description'       => __('A custom block for displaying 2 featured articles'),
        'render_template'   => 'template-parts/blocks/featured-articles.php',
        'category'          => 'gaf',
        'icon'              => 'excerpt-view',
        'keywords'          => array( 'blog', 'articles', 'featured' ),
    ));

    // contact form block.
    acf_register_block_type(array(
        'name'              => 'contact-form',
        'title'             => __('Contact Form'),
        'description'       => __('A custom block for displaying an image and a contact form'),
        'render_template'   => 'template-parts/blocks/contact-form.php',
        'category'          => 'gaf',
        'icon'              => 'email',
        'keywords'          => array( 'contact', 'callback', 'form' ),
    ));

    // intro block.
    acf_register_block_type(array(
        'name'              => 'intro',
        'title'             => __('Introduction'),
        'description'       => __('A custom block for displaying a the introduction at the top of a page'),
        'render_template'   => 'template-parts/blocks/intro.php',
        'category'          => 'gaf',
        'icon'              => 'align-left',
        'keywords'          => array( 'intro', 'introduction' ),
    ));

    // post cards block.
    acf_register_block_type(array(
        'name'              => 'post-cards',
        'title'             => __('Post Cards'),
        'description'       => __('A custom block for displaying a list of posts as columns'),
        'render_template'   => 'template-parts/blocks/post-cards.php',
        'category'          => 'gaf',
        'icon'              => 'screenoptions',
        'keywords'          => array( 'posts', 'cards' ),
    ));

    // image grid block.
    acf_register_block_type(array(
        'name'              => 'image-grid',
        'title'             => __('Image Grid'),
        'description'       => __('A custom block for displaying a row of images (such as logos)'),
        'render_template'   => 'template-parts/blocks/image-grid.php',
        'category'          => 'gaf',
        'icon'              => 'editor-insertmore',
        'keywords'          => array( 'image', 'grid', 'logos' ),
    ));

    // Call to action block.
    acf_register_block_type(array(
        'name'              => 'call-to-action',
        'title'             => __('Call to Action'),
        'description'       => __('A custom block for displaying a call to action banner with a button'),
        'render_template'   => 'template-parts/blocks/call-to-action.php',
        'category'          => 'gaf',
        'icon'              => 'megaphone',
        'keywords'          => array( 'cta', 'call', 'action' ),
    ));

    // Footnotes block.
    acf_register_block_type(array(
        'name'              => 'footnotes',
        'title'             => __('Footnotes'),
        'description'       => __('A custom block for displaying footnotes'),
        'render_template'   => 'template-parts/blocks/footnotes.php',
        'category'          => 'gaf',
        'icon'              => 'editor-ol',
        'keywords'          => array( 'footnote', 'footnotes', 'reference' ),
    ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}



// Custom post types function
function create_post_type() {

    // Team
    register_post_type( 'team',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Leadership Team' ),
                'singular_name' => __( 'Leadership Team' )
            ),
            'menu_icon'           => 'dashicons-groups',
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'team'),
            //'show_in_rest' => true,
            'supports' => array('title','editor','thumbnail')
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_post_type' );




// Pagination

function articles_paginate($query = '') {

    global $wp_query;
    if(isset($query)) {
        $total = $query->max_num_pages;
    } else {
        $total = $wp_query->max_num_pages;
    }
      $big = 999999999; // need an unlikely integer
      echo paginate_links( array(
              'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $total,
              'prev_next' => true,
              'type' => 'list'
      ) );

}


// REMOVE ALL THE comments
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');



// Remove wp-embed js
function my_deregister_scripts(){
 wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );
