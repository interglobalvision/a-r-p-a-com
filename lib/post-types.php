<?php
// Menu icons for Custom Post Types
function add_menu_icons_styles(){
?>

<style>
#adminmenu .menu-icon-project div.wp-menu-image:before {
    content: '\f498';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

// REGISTER CLIENTS
add_action( 'init', 'register_cpt_clients' );

function register_cpt_clients() {

    $labels = array(
        'name' => _x( 'Clients', 'clients' ),
        'singular_name' => _x( 'Client', 'clients' ),
        'add_new' => _x( 'Add New', 'clients' ),
        'add_new_item' => _x( 'Add New Client', 'clients' ),
        'edit_item' => _x( 'Edit Client', 'clients' ),
        'new_item' => _x( 'New Client', 'clients' ),
        'view_item' => _x( 'View Client', 'clients' ),
        'search_items' => _x( 'Search Clients', 'clients' ),
        'not_found' => _x( 'No clients found', 'clients' ),
        'not_found_in_trash' => _x( 'No clients found in Trash', 'clients' ),
        'parent_item_colon' => _x( 'Parent Client:', 'clients' ),
        'menu_name' => _x( 'Clients', 'clients' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'clients', $args );
}

// ARCHIVE POST TYPE FOR ADMIN REASONS
add_action( 'init', 'register_cpt_projects' );

function register_cpt_projects() {

    $labels = array(
        'name' => _x( 'Projects', 'projects' ),
        'singular_name' => _x( 'Project', 'projects' ),
        'add_new' => _x( 'Add New', 'projects' ),
        'add_new_item' => _x( 'Add New Project', 'projects' ),
        'edit_item' => _x( 'Edit Project', 'projects' ),
        'new_item' => _x( 'New Project', 'projects' ),
        'view_item' => _x( 'View Project', 'projects' ),
        'search_items' => _x( 'Search Projects', 'projects' ),
        'not_found' => _x( 'No projects found', 'projects' ),
        'not_found_in_trash' => _x( 'No projects found in Trash', 'projects' ),
        'parent_item_colon' => _x( 'Parent Project:', 'projects' ),
        'menu_name' => _x( 'Projects', 'projects' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'projects', $args );
}