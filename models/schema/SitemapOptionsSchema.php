<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Sitemap\Models\Schema;

use Arikaim\Core\Db\Schema;

/**
 * Sitemap buttons db table
 */
class SitemapOptionsSchema extends Schema  
{    
    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = "sitemap_options";

    /**
     * Create table
     *
     * @param \Arikaim\Core\Db\TableBlueprint $table
     * @return void
     */
    public function create($table) 
    {            
        // columns
        $table->id();
        $table->prototype('uuid');     
        $table->string('lastmod')->nullable(true);
        $table->string('changefreq')->nullable(true);
        $table->text('priority')->nullable(true);
        $table->string('pattern')->nullable(false);
        // indexes
        $table->index('pattern');
    }

    /**
     * Update table
     *
     * @param \Arikaim\Core\Db\TableBlueprint $table
     * @return void
     */
    public function update($table) 
    {              
    }
}
