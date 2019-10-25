<?php
/**
 *  Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2017-2019 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license.html
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
     * @param string $event_name
     * @param string|null $extension_name
     * @param integer $priority
     */
    public function __construct($event_name = null, $extension_name = null, $priority = 0)
    {       
        $this->subscribe('dashboard.get.items',$extension_name,$priority);
    }
    
    /**
     * Subscriber code executed.
     *
     * @param EventInterface $event
     * @return void
     */
    public function execute($event)
    {     
        return 'sitemap::admin.dashboard';
    }
}
