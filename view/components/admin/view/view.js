/**
 *  Arikaim
 *  @copyright  Copyright (c)  <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com 
*/
'use strict';

function SitemapView() {

    this.init = function() {
        paginator.init('page_rows','sitemap::admin.view.rows','sitemap');                  
    }; 
}

var sitemapView = createObject(SitemapView,ControlPanelView);

arikaim.component.onLoaded(function() {
    sitemapView.init();   
});