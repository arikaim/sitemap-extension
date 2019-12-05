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

use Arikaim\Core\Db\Traits\Uuid;
use Arikaim\Core\Db\Traits\Find;
use Arikaim\Core\Db\Traits\Options;
use Arikaim\Core\Arikaim;

/**
 * Sitemap options class
 */
class SitemapOptions extends Model  
{
    use Uuid,       
        Options,
        Find;
       
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "sitemap_options";

    protected $fillable = [
        'reference_id',
        'key',
        'value',
        'title',
        'description',
        'read_only',
        'hidden',
        'type'      
    ];
    
    public $timestamps = false;

    /**
     * Get route pages list
     *
     * @param array $route
     * @return array
     */
    public function getRoutePages($route)
    {
        $route = (is_object($route) == true) ? $route->toArray() : $route;
        
        $pages = [];
        if (empty($route['extension_name']) == false) {
            $result = Arikaim::event()->dispatch('sitemap.pages',$route,false,$route['extension_name']);
            if (is_array($result) == true) {
                foreach ($result as $list) {                       
                    $pages = array_merge($pages,$list);
                }                  
            }
        } else { 
            $pages[] = Arikaim::routes()->getRouteUrl($route['pattern']);
        } 
        
        return $pages;
    }

    /**
     * Get total pages 
     *
     * @return integer
     */
    public function getTotalPageRoutes()
    {
        $total = Arikaim::cache()->fetch('sitemap.total.pages');
        if (empty($total) == false) {
            return $total;
        }

        $pages = [];      
        $routes = Arikaim::routes()->getRoutes(['status' => 1,'type' => 1]);
        
        foreach ($routes as $route) {
            $result = $this->getRoutePages($route);
            $pages = array_merge($pages,$result);                
        }
        Arikaim::cache()->save('sitemap.total.pages',count($pages),2);

        return count($pages);
    }
}
