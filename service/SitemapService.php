<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap\Service;

use Arikaim\Core\Service\Service;
use Arikaim\Core\Service\ServiceInterface;
use Arikaim\Core\Routes\Route;
use Arikaim\Core\Utils\File;
use Arikaim\Core\Utils\Path;

/**
 * Sitemap service class
*/
class SitemapService extends Service implements ServiceInterface
{
    /**
     * robots.txt  full path name
     */
    const ROBOTS_TXT_FILE = ROOT_PATH . BASE_PATH . DIRECTORY_SEPARATOR . 'robots.txt';

    /**
     * Boot service
     *
     * @return void
     */
    public function boot()
    {
        $this->setServiceName('sitemap');
    }

    /**
     *  Get robots.txt file path
     */
    public function getRobotsTxtFilePath(): string
    {
        return Self::ROBOTS_TXT_FILE;
    }

    /**
     * Load robots.txt file content
     *
     * @return mixed|null
     */
    public function loadRobotsTxt()
    {
        return File::read(Self::ROBOTS_TXT_FILE);
    }

    /**
     * Create robots.txt file
     *
     * @return void
     */
    public function createRobotsTxt()
    {
        global $arikaim;

        $sitemapUrl = $arikaim->get('routes')->getUrlPath('sitemap.url');
        $data = "User-agent: * \r\n";
        $data .= "Allow: / \r\n";
        $data .= "\r\nSitemap: " . $sitemapUrl;

        return File::write(Self::ROBOTS_TXT_FILE,$data);
    }

    /**
     * Get route pages list
     *
     * @param array $route
     * @param string $language
     * @return array|string|false
     */
    public function getRoutePages(array $route, string $language = 'en')
    {
        global $arikaim;

        if (empty($route['extension_name']) == false && $route['type'] == 1) {    
            $route['language'] = $language;   
            $result = $arikaim->get('event')->dispatch('sitemap.pages',$route,false,$route['extension_name']);
          
            return $result;                          
        } 

        return Route::getRouteUrl($route['pattern']);      
    }

    /**
     * Get route pages count
     *
     * @param array  $route
     * @param string $language
     * @return integer
     */
    public function getRoutePagesCount(array $route, string $language = 'en'): int
    {              
        $pages = $this->getRoutePages($route,$language);
        if (\is_string($pages) == true) {
            return 1;
        }

        if (\is_array($pages) == true) {
            $pageItems = $pages[0] ?? null;
            return (\is_array($pageItems) == true) ? \count($pageItems) : \count($pages);
        }

        return 0;
    }

    /**
     * Get total pages 
     * 
     * @param string $language
     * @return integer
     */
    public function getTotalPageRoutes($language = 'en'): int
    {       
        global $arikaim;

        $total = $arikaim->get('cache')->fetch('sitemap.total.pages');              
        if ($total !== false) {
            return (int)$total;
        }

        $pages = $this->getPageRoutes($language);      
        $arikaim->get('cache')->save('sitemap.total.pages',\count($pages),2);

        return \count($pages);
    }

     /**
     * Get page(s) url list for each page route 
     *
     * @param string $language
     * @return array
     */
    public function getPageRoutes(string $language = 'en'): array
    {
        global $arikaim;
        $pages = [];

        // Add home page 
        $homePage = $arikaim->get('routes')->getRoutes([
            'status' => 1, 
            'type'   => 3
        ]);

        $routes = $arikaim->get('routes')->getRoutes([
            'status' => 1,
            'type'   => 1
        ]);     
        
        $routes = \array_merge($homePage,$routes);  
    
        foreach ($routes as $route) {
            $result = $this->getRoutePages($route,$language);  

            if (\is_array($result) == true) {                            
                foreach($result as $item) {                 
                    if (\is_array($item) == false) {
                        $pages[] = $item;
                    } else {
                        $pages = \array_merge($pages,$item);
                    }
                }              
            }       
            if (\is_string($result) == true) {   
                $pages[] = $result;
            }
        }
      
        return $pages;
    }
}
