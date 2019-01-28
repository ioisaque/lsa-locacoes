<?php

    // All extensions placed within the extensions directory will be auto-loaded for your Redux instance.
    if(class_exists('Redux')) {
        Redux::setExtensions( 'mora_redux_data', get_template_directory() . '/framework/admin/redux-extensions/extensions/' );
    }
   

    // Any custom extension configs should be placed within the configs folder.
    if ( file_exists( get_template_directory() . '/framework/admin/redux-extensions/configs/' ) ) {
        $files = glob( get_template_directory() . '/framework/admin/redux-extensions/configs/*.php' );
        if ( ! empty( $files ) ) {
            foreach ( $files as $file ) {
                include $file;
            }
        }
    }