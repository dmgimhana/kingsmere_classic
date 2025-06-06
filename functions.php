<?php

function university_files()
{
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style("custom-google-fonts", '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style("font-awesome", '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
    // Experimentational dynamic menu code
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'university_features');

// function university_post_types()
// {
//     register_post_type('event', array(
//         'public' => true,
//         'labels' => array(
//             'name' => 'Events'
//         ),
//         'menu_icon' => 'dashicons-calendar'
//     ));
// }


// add_action('init', 'university_post_types');

function university_adjust_queries($query)
{

    if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1); // Show all programs
    }


    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
}

add_action('pre_get_posts', 'university_adjust_queries');


// Creating Program Post Type
// 1. Register the post type in mu-plugins folder
// 2. Create some programs in the admin
// 3. Update permalink structure(Settings -> Permalinks -> Save Changes)
// 4. Test viewing a newly created program post in step 2. At this time the view is powered by single.php and we need to change it by creating a dedicated template file
// 5. Create single-program.php in the theme folder
// 6. As a starting point, copy the contents from single-event.php to single-program.php
// 7. Update the template file in necessary places. Change the texts and permalink function to get_post_type_archive_link('program')
// 8. Create an archive template file (archive-program.php). If not archive.php will be used. So we need to create archive-program.php
// 9. Copy the contents from archive-event.php to archive-program.php as a starting point and do the necessary changes
// 10. Order the programs alphabetically by title. The default query is almost good so we do not need to write a custom query. We just need to manipulate the default query.

// Creating Relationships Between Post Types
// 1. Create a new field group using ACF called Related Program
// 2. Add a field called Related Program(s)
// 3. Change field name to related_programs
// 4. Change field type to relationship
// 5. Set filter by post type to program
// 6. Set filters to only search
// 7. In the location section. Set the rules to show this field group if Post Type is equal to Event

    // Showing Related Programs in the Single Event Template
    // 1. Open single-event.php
    // 2. Write the necessary code to get the related programs
       
        // Writing a custom query to get the related events to a program. There is no need to create another custom group and a custom field for this.
        // 1. Open single-program.php
        // 2. Write the custom query to get the related events



// Creating Professors post type
// 1. Register the post type in mu-plugins folder (NOTE: There is no need for an archive page for professors, so has_archive is removed, and because there is no archive there is no need for a rewrite slug)
// 2. Create some professors in the admin
// 3. Update permalink structure(Settings -> Permalinks -> Save Changes)
// 4. Test viewing a newly created professor post in step 2. At this time the view is powered by single.php and we need to change it by creating a dedicated template file
// 5. Create single-professor.php in the theme folder
// 6. As a starting point, copy the contents from single-event.php to single-professor.php
// 7. Update the template file in necessary places.

    // Creating a relationship between Professors and Programs
    // 1. Navigate to Related Programs field group and modify the location rules to show this field group if Post Type is equal to Event or Professor
    // 2. Add some programs to some professors using admin dashboard
    // 3. Modify single-program.php to show the related professors using a custom query


// Creating a featured image for a professor
// 1. Add this code segment  -> add_theme_support('post-thumbnails'); to the university_features function in functions.php
// 2. Navigate to mu-plugins folder and add support to thumbnail
// 3. Add a featured image to a professor using admin dashboard
