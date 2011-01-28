<?php
/*
    Plugin Name: Display Badges
    Plugin URI: http://www.damn.org.za/blog/DisplayBadges
    Description: Display a set of Badges (named XXFoo.inc) within the widget
    Author: Eugéne Roux
    Version: 1
    Author URI: http://damn.org.za/
 */

//
//  DisplayBadges Class
//
class DisplayBadges extends WP_Widget {
    //
    //  constructor
    //
    function DisplayBadges() {
        $widget_ops = array( 'classname' => 'widget_badges', 'description' => __( "Display a set of Badges (named XXFoo.inc) within the widget. The path is specified as an offset from the Blog's base URL." ));
        $this->WP_Widget( 'badges', __( 'Badges', 'badges_widget' ), $widget_ops );
        $this->widget_defaults = array(
            'internalcss' => true,
            'dropshadow' => false,
            'path' => 'badges',
        );

    }

    //
    //  @see WP_Widget::widget
    //
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $badgedir = $instance['path'];
        $internalcss = $instance["internalcss"] ? true : false;
        $dropshadow = $instance["dropshadow"] ? true : false;

        if (is_dir( "./" . $badgedir )) {

            echo $before_widget;

            if ( $title )
                echo $before_title . $title . $after_title; // This way we get to choose a "No Title" scenario...

            foreach (glob( "./" . $badgedir . "/[0-9][0-9]*.inc") as $filename) {
                $fileid = preg_replace("/\.\/[\w-_]+\/\d+(.+)\.inc/", "\$1", $filename); // Extract the base name... and mind the leading ./
                print("    <li class=\"badge\">\n");
                if ( $internalcss ) {
                    print( "<ul style='list-style: none; display: block; text-align: center; border: 1px solid; " );
                    print( "-moz-border-radius: 1em; -webkit-border-radius: 1em; -khtml-border-radius: 1em; border-radius: 1em; " );
                    if ( $dropshadow ) {
                        print( "-moz-box-shadow: #CCC 5px 5px 5px; -webkit-box-shadow: #CCC 5px 5px 5px; ");
                        print( "-khtml-box-shadow: #CCC 5px 5px 5px; box-shadow: #CCC 5px 5px 5px; ");
                    }
                    print( "width: auto; margin: 1em; padding: 2ex;' id='badge-$fileid'><li>\n" );
                } else {
                    print( "<ul id='badge-$fileid'><li>\n" );
                }
                $badgearray = file($filename); 
                foreach ($badgearray as $badge) {
                    $badge = str_replace("[BLOGURL]", get_settings('home'), $badge);
                    print("$badge");
                }
                print("        </li></ul> <!-- #badge-$fileid -->\n");
            }

            echo $after_widget;
        }
    }

    //
    //  @see WP_Widget::update
    //
    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['path'] = $new_instance['path'];
        $instance['internalcss'] = ( isset( $new_instance['internalcss'] ) ? 1 : 0 );
        $instance['dropshadow'] = ( isset( $new_instance['dropshadow'] ) ? 1 : 0 );
        return $instance;
    }

    //
    //  @see WP_Widget::form
    //
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->widget_defaults );
        extract( $instance );

        $title = esc_attr( $instance['title'] );
        $path = $instance['path'];
        $internalcss = $instance['internalcss'] ? "checked='checked'" : "";        
        $dropshadow = $instance['dropshadow'] ? "checked='checked'" : "";        

        print( "\t<p>\n\t\t<label for='" . $this->get_field_id("title") . "'>" ); _e( "Title:" );
        print( "\n\t\t\t<input class='widefat' id='" . $this->get_field_id("title") . "' name='" . $this->get_field_name("title") . "' type='text' value='" . $title . "' />\n\t\t</label>\n\t</p>\n" );

        print( "\t<p>\n\t\t<label for='" . $this->get_field_id("path") . "'>"); _e( "Path:" );
        print( "\n\t\t\t<input class='widefat' id='" . $this->get_field_id("path") . "' name='" . $this->get_field_name("path") . "' type='text' value='" . $path . "' />\n\t\t</label>\n\t</p>\n" );

        print( "\t<p>\n" );
        print( "\t\t<input class='checkbox' type='checkbox' " . $internalcss );
        print( " id='" . $this->get_field_id("internalcss") . "' name='" . $this->get_field_name("internalcss") . "'/>\n" );
        print( "\t\t<label for='" . $this->get_field_id("internalcss") . "'>" ); _e( "Display Badge in a Box" );
        print( "</label>\n" );
        print( "\t\t<br />\n" );
        print( "\t\t<input class='checkbox' type='checkbox' " . $dropshadow );
        print( " id='" . $this->get_field_id("dropshadow") . "' name='" . $this->get_field_name("dropshadow") . "'/>\n" );
        print( "\t\t<label for='" . $this->get_field_id("dropshadow") . "'>" ); _e( "Display a Drop-Shadow" );
        print( "</label>\n" );
        print( "\t</p>\n" );

    }
}

//
// register DisplayBadges widget
//
add_action('widgets_init', create_function('', 'return register_widget( "DisplayBadges" );'));
