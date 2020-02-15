'use strict';

$(document).ready(function() {
    safeCall('sitemapView',function(obj) {
        obj.initRows();
    },true);    
});