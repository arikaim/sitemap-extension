'use strict';

arikaim.component.onLoaded(function() {
    arikaim.page.loadContent({
        id: 'sitemap_stats',
        component: 'sitemap::admin.dashboard.stats',
        params: {
            component_id: 'sitemap_dashboard_stats'
        }       
    });  
});