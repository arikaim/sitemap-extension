'use strict';

$(document).ready(function() {
    $('#changefreq_dropdown').dropdown({
        onChange: function(value) {
            options.save('sitemap.changefreq',value,function(result) {
                arikaim.page.toastMessage(result.message);
            });
        }
    });
    $('#priority_dropdown').dropdown({
        onChange: function(value) {
            options.save('sitemap.priority',value,function(result) {
                arikaim.page.toastMessage(result.message);
            });
        }
    });
});