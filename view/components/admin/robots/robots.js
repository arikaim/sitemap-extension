'use strict';

arikaim.component.onLoaded(function() {
    arikaim.ui.button('.create-file',function(button) {
        arikaim.ui.loadComponent({
            mountTo: 'file_content',
            component: "sitemap::admin.robots.file"
        });
    });
});