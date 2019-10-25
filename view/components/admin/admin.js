/**
 *  Arikaim
 *  
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license.html
 *  http://www.arikaim.com
 * 
 *  Extension: Sitemap
 *  Component: sitemap:admin
 */

function SitemapControlPanel() {
    var self = this;

    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/tags/admin/delete/' + uuid,onSuccess,onError);          
    };
 
    this.init = function() {    
       
    };
}

var sitemap = new SitemapControlPanel();

arikaim.page.onReady(function() {
    sitemap.init();
});