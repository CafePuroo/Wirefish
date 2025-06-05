add_filter('template_include', function($template) {
    if (is_page('dashboard')) {
        return get_template_directory() . '/capturas.php';
    }
    return $template;
});
