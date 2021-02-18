<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap\Subscribers;

use Arikaim\Core\Events\EventSubscriber;
use Arikaim\Core\Interfaces\Events\EventSubscriberInterface;

/**
 * Dasboard Subscriber class
 */
class DasboardSubscriber extends EventSubscriber implements EventSubscriberInterface
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {       
        $this->subscribe('dashboard.get.items');
    }
    
    /**
     * Subscriber code executed.
     *
     * @param EventInterface $event
     * @return string
     */
    public function execute($event)
    {     
        return [
            'component' => 'sitemap::admin.dashboard',
            'class'     => 'two wide'
        ];    
    }
}
