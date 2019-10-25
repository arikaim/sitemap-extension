<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2016-2018 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license.html
 * 
*/
namespace Arikaim\Extensions\Sitemap;

use Arikaim\Core\Packages\Extension\Extension;

/**
 * Sitemap extension
*/
class Sitemap extends Extension
{
    /**
     * Install extension routes, events, jobs ..
     *
     * @return boolean
    */
    public function install()
    {  
        // Page route
        $this->addPageRoute('/sitemap.xml','SitemapPage','sitemapXML',null,null,null,false);   
        // Create db tables
        $this->createDbTable('SitemapOptionsSchema');
        // Events
        $this->registerEvent('sitemap.pages','Trigger on show sitemap.xml page');
        // Options
        $this->createOption('sitemap.changefreq','weekly');
        $this->createOption('sitemap.priority','1.0');

        return true;
    }   

    /**
     * Uninstall extension
     *
     * @return boolean
     */
    public function unInstall()
    {
        $this->dropDbTable('SitemapOptionsSchema'); 
        
        return true;
    }
}
