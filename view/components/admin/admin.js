/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function SitemapControlPanel() {
    var self = this;

    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/tags/admin/delete/' + uuid,onSuccess,onError);          
    };
 
    this.init = function() {    
        arikaim.ui.tab();
    };
}

var sitemap = new SitemapControlPanel();

arikaim.page.onReady(function() {
    sitemap.init();
});