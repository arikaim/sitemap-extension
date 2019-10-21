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
        // {ages
        $this->addPageRoute('/sitemap.xml','SitemapPage','sitemap');   
        // Control Panel
        //$this->addApiRoute('POST','/api/tags/admin/add','SitemapControlPanel','add','session');   
        // Create db tables
        $this->createDbTable('SitemapOptionsSchema');
    
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
