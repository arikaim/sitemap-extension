'use strict';

arikaim.component.onLoaded(function() {
    $('#changefreq_dropdown').on('change', function() {
        var selected = $(this).val();       
        options.save('sitemap.changefreq',selected,function(result) {
            arikaim.ui.getComponent('toast').show(result.message);
        });
    });

    $('#priority_dropdown').on('change', function() {
        var selected = $(this).val();       
        options.save('sitemap.priority',selected,function(result) {
            arikaim.ui.getComponent('toast').show(result.message);
        });       
    });
});