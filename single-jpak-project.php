<?php
/**
 * JordanPak Functionality - Project CPT Template - Single
 *
 * Single Template for Project CPT
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */



//===========================//
//  CONFIGURE PAGE ELEMENTS  //
//===========================//


 //-- REMOVE DEFAULT ELEMENTS --//
 remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
 remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
 remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
 remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


//-- ADD BODY CLASSES --//
 add_filter( 'body_class', 'jpak_project_single_body_classes' );
 /**
  * JordanPak Functionality - Project Single Body Classes
  *
  * Adds "full-width-content", "page", and "no-mini-hero" body classes to page
  *
  * @package JordanPak-Functionality
  * @since 1.0.0
  *
  * @param string $classes Array of body classes
  * @return string $classes Array of body classes
  */
 function jpak_project_single_body_classes( $classes ) {

     $classes[] = 'full-width-content';
     $classes[] = 'page';
     $classes[] = 'no-mini-hero';

     return $classes;

 } // jpak_project_single_body_classes


//-- REMOVE MINI-HERO --//
remove_action( 'genesis_after_header', 'jpak_mini_hero' );




//====================//
//  GET PROJECT META  //
//====================//

global $jpak_project_meta;
$jpak_project_meta = jpak_project_get_meta( $post->ID );




//====================//
//  PROJECT ELEMENTS  //
//====================//

add_action( 'genesis_after_header', 'jpak_project_single_background_previews' );
/**
 * JordanPak Functionality - Project Single Background & Previews
 *
 * Configures top part of page with color theme and desktop/mobile preview images.
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */
function jpak_project_single_background_previews() {

    // Get Project Meta
    $project_meta = $GLOBALS['jpak_project_meta'];

    // Prep Needed Vars
    $color =            $project_meta['color'];
    $desktop_preview =  $project_meta['desktop_preview'];
    $mobile_preview =   $project_meta['mobile_preview'];


    // project-background-previews Inline Styling
    $background_previews_style = ''; //'background-color: ' . $color . ';';


    // Background & Previews
    echo '<div class="project-background-previews" style="' . $background_previews_style . '">';

        // If There's a Desktop Preview
        if ( $desktop_preview ) {
            echo jpak_project_browser_mockup( $desktop_preview );
        }

        // If There's a Mobile Preview
        if ( $mobile_preview ) {
            echo jpak_project_browser_mockup( $mobile_preview, 'mobile', 'right', false );
        }

    echo '</div>'; // .project-background-previews

} // jpak_project_single_background_previews()



add_filter( 'body_class', 'jpak_project_single_body_classes' );
/**
 * JordanPak Functionality - Browser Mockup
 *
 * Outputs a preview image inside a "Browser Mockup" frame.
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 *
 * @param string $src Image SRC Attribute
 * @param string $size Size of mockup (desktop, mobile)
 * @param string $position Position of Mockup (left, right)
 * @param bool $with_tab Include tab in frame
 * @return string $browser_mockup HTML markup of Browser Mockup
 */
function jpak_project_browser_mockup( $src, $size = 'desktop', $position = 'left', $with_tab = true ) {

    //-- HTML STRING --//
    $browser_mockup = '';


    //-- WRAPPER CLASSES --//
    $mockup_classes = 'browser-mockup';             // Default
    $mockup_classes .= ' size-' . $size;            // Size
    $mockup_classes .= ' position-' . $position;    // Position

    if ( $with_tab ) {
        $mockup_classes .= ' with-tab';
    }


    //-- MARKUP --//
    $browser_mockup .= '<div class="' . $mockup_classes . '">';
        $browser_mockup .= '<img src="' . $src . '">';
    $browser_mockup .= '</div>'; // .browser-mockup


    return $browser_mockup;

} // jpak_project_browser_mockup()



//-- LOAD FRAMEWORK --//
genesis();
