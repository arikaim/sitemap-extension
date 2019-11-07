<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2016-2018 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap\Models;

use Illuminate\Database\Eloquent\Model;

use Arikaim\Core\Traits\Db\Uuid;
use Arikaim\Core\Traits\Db\Find;
use Arikaim\Core\Traits\Db\Options;
use Arikaim\Core\Arikaim;
use Arikaim\Core\Db\Model as DbModel;

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
     * @param Model $route
     * @return array
     */
    public function getRoutePages($route)
    {
        $pages = [];
        if (empty($route->extension_name) == false) {
            $result = Arikaim::event()->trigger('sitemap.pages',$route->toArray(),false,$route->extension_name);
            if (is_array($result) == true) {
                foreach ($result as $list) {                       
                    $pages = array_merge($pages,$list);
                }                  
            }
        } else { 
            $pages[] = $route->getRouteUrl();
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
        $routes = DbModel::Routes()->getPageRoutesQuery(null,1)->get();
        
        foreach ($routes as $route) {
            $result = $this->getRoutePages($route);
            $pages = array_merge($pages,$result);                
        }
        Arikaim::cache()->save('sitemap.total.pages',count($pages),2);

        return count($pages);
    }
}
