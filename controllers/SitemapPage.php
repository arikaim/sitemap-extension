<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2016-2018 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license.html
 * 
*/
namespace Arikaim\Extensions\Sitemap\Controllers;

use Arikaim\Core\Db\Model;
use Arikaim\Core\Controllers\Controller;
use Arikaim\Core\View\Html\HtmlComponent;

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
        $xml = HtmlComponent::loadComponent('sitemap::sitemap.xml',['pages' => $pages]);
       
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
        $routes = Model::Routes()->getPageRoutesQuery(null,1)->get();
        
        foreach ($routes as $route) {
            $result = $sitemap->getRoutePages($route);
            $pages = array_merge($pages,$result);                
        }
      
        return $pages;
    }
}
