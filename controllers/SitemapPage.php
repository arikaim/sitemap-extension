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
        $model = Model::SitemapOptions('sitemap');
        $language = $this->getDefaultLanguage();
        
        $pages = $model->getPageRoutes($language);

        $component = $this->get('page')->renderHtmlComponent('sitemap::sitemap.xml',[
            'pages'      => $pages,
            'changefreq' => $this->get('options')->get('sitemap.changefreq','weekly'),
            'priority'   => $this->get('options')->get('sitemap.priority','1.0')
        ],$language);
       
        return $this->writeXml($response,$component->getHtmlCode());    
    }
}
