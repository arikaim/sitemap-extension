<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap\Controllers;

use Arikaim\Core\Db\Model;
use Arikaim\Core\Controllers\Controller;

/**
 *  Sitemap page controller
 */
class SitemapPage extends Controller
{
    /**
     * Sitemap page
     *
     * @param object $request
     * @param object $response
     * @param Validator $data
     * @return void
     */
    public function sitemapXML($request, $response, $data)
    {                   
        $pages = $this->getPageRoutes();
        $xml = $this->get('page')->createHtmlComponent('sitemap::sitemap.xml',['pages' => $pages])->load();
       
        return $this->writeXml($response,$xml);    
    }

    /**
     * Get page(s) url list for each page route 
     *
     * @return array
     */
    public function getPageRoutes()
    {
        $pages = [];
        $sitemap = Model::SitemapOptions('sitemap');
        $routes = $this->get('routes')->getRoutes(['status' => 1, 'type' => 1]);
        
        foreach ($routes as $route) {
            $result = $sitemap->getRoutePages($route);
            $pages = array_merge($pages,$result);                
        }
      
        return $pages;
    }
}
