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
use Arikaim\Core\FileSystem\File;

/** 
 *  Sitemap contro panel api controller
 */
class SitemapControlPanel extends ApiController
{
    /**
     *  
     *
     * @param object $request
     * @param object $response
     * @param Validator $data
     * @return object
     */
    public function moveToTrash($request, $response, $data)
    {
        $this->requireControlPanelPermission();

        $this->onDataValid(function($data) {      
           
        });
        $data->validate();

        return $this->getResponse();
    }
}
