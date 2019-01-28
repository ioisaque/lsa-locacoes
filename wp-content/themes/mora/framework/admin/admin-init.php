<?php
    // Load the theme/plugin options
    if ( file_exists( get_template_directory().'/framework/admin/options-init.php' ) ) {
        require_once get_template_directory().'/framework/admin/options-init.php';
    }

    // Load Redux extensions
    if ( file_exists( get_template_directory().'/framework/admin/redux-extensions/extensions-init.php' ) ) {
        require_once get_template_directory().'/framework/admin/redux-extensions/extensions-init.php';
    }

