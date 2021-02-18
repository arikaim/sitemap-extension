'use strict';

arikaim.component.onLoaded(function() {
    safeCall('sitemapView',function(obj) {
        obj.initRows();
    },true);    
});