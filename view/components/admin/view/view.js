/**
 *  Arikaim
 *  @version    1.0  
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
        
        /*
        search.init({
            id: 'tags_rows',
            component: 'tags::admin.view.rows',
            event: 'tags.search.load'
        },'tags')  

        arikaim.events.on('tags.search.load',function(result) {      
            paginator.reload();
            self.initRows();    
        },'tagsSearch');
        */

        this.initRows();
    };

    this.initRows = function() {

       

        arikaim.ui.button('.delete-button',function(element) {
            var uuid = $(element).attr('uuid');
           
        });

    };
}

var sitemapView = new SitemapView();

arikaim.page.onReady(function() {
    sitemapView.init();   
});