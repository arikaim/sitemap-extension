/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license.html
 *  http://www.arikaim.com
 * 
 *  Extension: Sitemap
 *  Component: sitemap::admin.view
*/

function SitemapView() {
    var self = this;

    this.init = function() {
        paginator.init('page_rows',{
            name: 'sitemap::admin.view.rows',
            params: {  }
        },'sitemap');
        this.initRows();
    };

    this.initRows = function() {
    };
}

var sitemapView = new SitemapView();

arikaim.page.onReady(function() {
    sitemapView.init();   
});