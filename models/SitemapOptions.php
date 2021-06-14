<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap\Models;

use Illuminate\Database\Eloquent\Model;

use Arikaim\Core\Arikaim;
use Arikaim\Core\Routes\Route;

use Arikaim\Core\Db\Traits\Uuid;
use Arikaim\Core\Db\Traits\Find;

/**
 * Sitemap options class
 */
class SitemapOptions extends Model  
{
    use Uuid,       
        Find;
       
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "sitemap_options";

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'status',
        'lastmod',
        'changefreq',
        'priority',
        'pattern',
        'extension'        
    ];
    
    /**
     * Disable timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Get route options 
     *
     * @param string $pattern
     * @param string|null $extension
     * @return Model|false
     */
    public function getRouteOptions(string $pattern, ?string $extension = null)
    {
        $model = $this->routeOptions($pattern,$extension)->first();

        return (\is_object($model) == true) ? $model : false;
    }

    /**
     * Route options scope
     *
     * @param Builder $query
     * @param string $pattern
     * @param string|null $extension
     * @return Builder
     */
    public function scopeRouteOptions($query, string $pattern, ?string $extension = null)
    {
        $query = $query->where('pattern','=',$pattern);
        if (empty($extension) == false) {
           $query = $query->where('extension','=',$extension);
        }
        
        return $query;
    }

    /**
     * Save route options
     *
     * @param array $data
     * @param string $pattern
     * @param string|null $extension
     * @return Model|boolean
     */
    public function saveRouteOptions(array $data, string $pattern, ?string $extension = null)
    {
        $query = $this->routeOptions($pattern,$extension);
        if (\is_object($query->first()) == true) {
            return $query->update($data);
        } 
        $data['pattern'] = $pattern;
        $data['extension'] = $extension;
        
        return $this->create($data);       
    }

    /**
     * Get route pages list
     *
     * @param object|array $route
     * @param string $language
     * @return array|string|false
     */
    public function getRoutePages($route, string $language = 'en')
    {
        $route = (\is_object($route) == true) ? $route->toArray() : $route;        
    
        if (empty($route['extension_name']) == false && $route['type'] == 1) {    
            $route['language'] = $language;   
            $result = Arikaim::event()->dispatch('sitemap.pages',$route,false,$route['extension_name']);
          
            return $result;                          
        } 

        return Route::getRouteUrl($route['pattern']);      
    }

    /**
     * Get route pages count
     *
     * @param object|array  $route
     * @param string $language
     * @return integer
     */
    public function getRoutePagesCount($route, string $language = 'en'): int
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
        $total = Arikaim::cache()->fetch('sitemap.total.pages');              
        if ($total !== false) {
            return (int)$total;
        }

        $pages = $this->getPageRoutes($language);      
        Arikaim::cache()->save('sitemap.total.pages',\count($pages),2);

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
        $pages = [];

        // Add home page 
        $homePage = Arikaim::routes()->getRoutes([
            'status' => 1, 
            'type'   => 3
        ]);

        $routes = Arikaim::routes()->getRoutes([
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
