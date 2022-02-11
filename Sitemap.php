<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap;

use Arikaim\Core\Extension\Extension;

/**
 * Sitemap extension
*/
class Sitemap extends Extension
{
    /**
     * Install extension routes, events, jobs ..
     *
     * @return void
    */
    public function install()
    {  
        // Page route
        $this->addPageRoute('/sitemap.xml','SitemapPage','sitemapXML');   
        // Create db tables
        $this->createDbTable('SitemapOptionsSchema');
        // Events
        $this->registerEvent('sitemap.pages','Trigger on show sitemap.xml page');
        // Options
        $this->createOption('sitemap.changefreq','weekly');
        $this->createOption('sitemap.priority','1.0');
    }   

    /**
     * Uninstall extension
     *
     * @return void
     */
    public function unInstall()
    {
    }
}
