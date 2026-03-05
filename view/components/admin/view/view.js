'use strict';

function SitemapView() {

    this.init = function() {
                          
    }; 
}

var sitemapView = createObject(SitemapView,ControlPanelView);

arikaim.component.onLoaded(function() {
    sitemapView.init();   
});