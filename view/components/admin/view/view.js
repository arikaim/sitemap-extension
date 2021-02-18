/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com 
*/
'use strict';

function SitemapView() {

    this.init = function() {
        paginator.init('page_rows','sitemap::admin.view.rows','sitemap');          
        this.initRows();
    };

    this.initRows = function() {
    };
}

var sitemapView = new SitemapView();

arikaim.component.onLoaded(function() {
    sitemapView.init();   
});