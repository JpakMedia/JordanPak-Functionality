<?php
/**
 * JordanPak Functionality - Project CPT Template - Archive
 *
 * Archive Template for Project CPT
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */



//===========================//
//  CONFIGURE PAGE ELEMENTS  //
//===========================//


//-- REMOVE DEFAULT ELEMENTS --//
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


//-- ADD BODY CLASSES --//
add_filter( 'body_class', 'jpak_project_archive_body_classes' );
/**
* JordanPak Functionality - Project Archive Body Classes
*
* @package JordanPak-Functionality
* @since 1.0.0
*
* @param string $classes Array of body classes
* @return string $classes Array of body classes
*/
function jpak_project_archive_body_classes( $classes ) {

    $classes[] = 'full-width-content';

    return $classes;

} // jpak_project_archive_body_classes



//=======================//
//  CUSTOM PROJECT LOOP  //
//=======================//

add_action( 'genesis_before_loop', 'jpak_project_archive_loop' );
function jpak_project_archive_loop() {

    // Project Grid Wrapper
    echo '<div class="project-grid clearfix">';

        //-- GET PROJECTS --//
        $projects = jpak_project_query();


        //-- PROJECT LOOP --//
        $count = 0;

        // CYCLE PROJECTS
        foreach ( $projects as $project ) {

            // Post Data
            $project_post =         get_post( $project );
            $project_title =        $project_post->post_title;
            $project_thumbnail =    get_post_thumbnail_id( $project );                                              // Get ID of Thumb
            $project_thumbnail =    wp_get_attachment_image_src( $project_thumbnail, 'project-grid-thumbnail' );    // Get Stuff from ID
            $project_thumbnail =    $project_thumbnail[0];                                                          // Get URL from Stuff

            // Post MetaData
            $project_meta = jpak_project_get_meta( $project, true );

            // Wrapper Classes
            $wrapper_classes = 'entry project-grid-entry one-half';    // Defaults
            if ( $count % 2 == 0 ) {                // Check for First
                $wrapper_classes .= ' first';
            }

            ?>

            <!-- Project Wrapper -->
            <div class="<?php echo $wrapper_classes; ?>">

                <!-- LINK -->
                <a href="<?php echo get_permalink( $project ) ?>" title="Project: <?php echo $project_title?>">

                    <!-- Featured Image -->
                    <img src="<?php echo $project_thumbnail ?>" alt="Project: <?php echo $project_title ?>">

                    <!-- Fade Above Image -->
                    <div class="fade"></div>

                    <!-- Title -->
                    <h2 class="entry-title" itemprop="headline"><?php echo $project_title ?></h2>
                    <?php
                    if ( $project_meta['subtitle'] ) {
                        echo '<p class="entry-subtitle"';
                        if ( $project_meta['color'] ) {
                            echo ' style="color: ' . $project_meta['color'] . '"';
                        }
                        echo '>' . $project_meta['subtitle'] . '</p>';
                    }
                    ?>

                </a>

            </div><!-- / .project-wrapper -->

            <?php

            $count++;

        } // foreach $projects as $project


    echo '</div>'; // .project-grid

} // jpak_project_archive_loop()


//-- LOAD FRAMEWORK --//
genesis();
