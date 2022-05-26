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
}
