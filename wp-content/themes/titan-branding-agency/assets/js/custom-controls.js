(function(api) {

    api.sectionConstructor['titan-branding-agency-upsell'] = api.Section.extend({
        attachEvents: function() {},
        isContextuallyActive: function() {
            return true;
        }
    });

})(wp.customize);