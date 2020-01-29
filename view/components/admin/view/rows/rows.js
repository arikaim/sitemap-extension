$(document).ready(function() {
    safeCall('currencyView',function(obj) {
        obj.initRows();
    },true);    
});