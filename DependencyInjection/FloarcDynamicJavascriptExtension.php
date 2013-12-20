<?php

namespace Floarc\DynamicJavascriptBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Cache\ApcCache;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FloarcDynamicJavascriptExtension extends Extension
{
	private $container;
	
	private $output;
	
	private $parameters;

	private $response;	
	
	private $template;
	
	private $dynJsArray; 
	
	private $cache;
	
	private $templating;
	
	
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
                
    }
    
    
    //public function __construct($name,$param,$foo)
    //public function __construct()
    public function __construct(ContainerInterface $container = null)
    //public function __construct(ContainerInterface $container = null)
    {
    	$this->container = $container;
    	/*
    	$this->templating = $templating;
    	$this->cache = $cache;
    	*/
    	
    	$this->dynJsArray=array();
    	
    }    

    /**
     * 
     * @param string $template
     * @param string $parameters
     * @param string $output
     * @return \Floarc\DynamicJavascriptBundle\DependencyInjection\FloarcDynamicJavascriptExtension
     */
    public function addDynJs($template = null, $parameters = null, $output = null )
    {
    	
    	$this->template = $template;
    	$this->parameters = $parameters;
    	$this->dynJsArray[$output][] = array("template"=>$template, "parameters"=>$parameters, "output"=>$output);
    	return $this;
    }

    /**
     * 
     * @return \Floarc\DynamicJavascriptBundle\DependencyInjection\FloarcDynamicJavascriptExtension
     */
    public function dumpDynJs()
    {
     	if(count($this->dynJsArray)>0){
     		foreach ($this->dynJsArray as $key => $dynJs) {
     			$content = "";
     			if(count($dynJs)>0){
     				foreach ($dynJs as $k => $dJs) {
     					if($content == ""){$content .= "\n";}
     					$content .= $this->container->get('templating')->render($dJs["template"], $dJs["parameters"]);
     				}
     			}
     			
     			$path = $this->getResourcePath($key);
     			$this->container->get('filesystem')->dumpFile($path, $content);
     			
     		}
     		
     	}
    	
    	return $this;
    }    
    
    
    public function getAlias()
    {
    	return 'floarc_dynamic_javascript';
    }
    
    
    public function getContent()
    {
    	
    	//echo "cache ".$this->cache->fetch('foo')."<br />";
    	//echo "cache ".$this->container->get('cache')->fetch('foo')."<br />";
    	//return $this->templating->render($this->getTemplate(), $this->getParameters());
    	return $this->container->get('templating')->render($this->getTemplate(), $this->getParameters());
    }    

    public function getResourcePath($resource)
    {
    	$path = "";
   	
    	if ((stripos($resource, '/') !== false) && (stripos($resource, '\\') !== false)) {
    		throw new \RuntimeException('Resource must have only one type of directory separator: / or \ '.$target);
    	}
    	
    	$dir_separator = "";
    	if (stripos($resource, '/') !== false){
    		$dir_separator = "/";
    	}
    	if (stripos($resource, '\\') !== false){
    		$dir_separator = "\\";
    	} 
    	   	
   	
    	$tab_resource = explode($dir_separator, $resource);
    	$new_tab_resource = $tab_resource;
   	
    	if(count($tab_resource)>0){
    		
    		//La racine de la resource fait elle reference à un bundle
    		if(substr($tab_resource[0], 0, 1)== "@"){
    			$bundle_path=$this->container->get('kernel')->locateResource($tab_resource[0]);
    			unset($new_tab_resource[0]);
    			$path = $bundle_path.implode($dir_separator, $new_tab_resource);
    		}
    		
    	}
    	return $path;
    	
   	
    }    
    

    public function generateOutput()
    {
    	$target = $this->getOutput();
    	if (false === @file_put_contents($target, $this->getContent())) {
    		throw new \RuntimeException('Unable to write file '.$target);
    	}    	
    }    

    
    public function getOutput()
    {
    	return $this->output;
    }
    
    public function setOutput($output)
    {
    	$this->output = $output;
    }    

    public function getParameters()
    {
    	return $this->parameters;
    }
    
    public function setParameters($parameters)
    {
    	$this->parameters = $parameters;
    }

    public function getResponse()
    {
    	return $this->response;
    }
    
    public function setResponse($response)
    {
    	$this->response = $response;
    }

    public function getTemplate()
    {
    	return $this->template;
    }
    
    public function setTemplate($template)
    {
    	$this->template = $template;
    }    

    
    /**
     * Renders a view.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A response instance
     *
     * @return Response A Response instance
     */
    /*
    public function render($view, array $parameters = array(), Response $response = null)
    {
    	return $this->container->get('templating')->renderResponse($view, $parameters, $response);
    }
    */    
    
}
