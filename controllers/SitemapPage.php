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
use Arikaim\Core\Controllers\ApiController;
use Arikaim\Core\Arikaim;

/**
 *  Sitemap page controller
 */
class SitemapPage extends ApiController
{
    /**
     * Sitemap page
     *
     * @param object $request
     * @param object $response
     * @param Validator $data
     * @return void
     */
    public function Sitemap($request, $response, $data)
    {             

        /// ROuter pathFor  ???
        $routes = Model::Routes()->where('type','=',1)->all();
        
        foreach($item in $routes) {

        }
    }


    public function hasPlaceholder($route_pattern)
    {

    }
}
