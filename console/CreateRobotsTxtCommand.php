<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
 */
namespace Arikaim\Extensions\Sitemap\Console;

use Arikaim\Core\Console\ConsoleCommand;

/**
 *  Create robots.txt file
 */
class CreateRobotsTxtCommand extends ConsoleCommand
{  
    /**
     * Configure command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('create:robots.txt');
        $this->setDescription('Create robots txt file');    
    }

    /**
     * Run command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function executeCommand($input,$output)
    {
        global $arikaim;

        $this->showTitle();

        $path = $arikaim->get('service')->get('sitemap')->getRobotsTxtFilePath();
        $this->writeLn("Path");
        $this->writeLn($path);

        $arikaim->get('service')->get('sitemap')->createRobotsTxt();
        
        $this->showCompleted();       
    }
}
