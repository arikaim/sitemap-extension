/**
 *  Arikaim
 *  @copyright  Copyright (c)  <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function SitemapControlPanel() {
  
    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/tags/admin/delete/' + uuid,onSuccess,onError);          
    };
 
    this.init = function() {    
        arikaim.ui.tab();
    };
}

var sitemap = new SitemapControlPanel();

arikaim.component.onLoaded(function() {
    sitemap.init();
});