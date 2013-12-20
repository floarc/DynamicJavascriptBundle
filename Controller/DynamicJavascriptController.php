<?php

namespace Floarc\DynamicJavascriptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DynamicJavascriptController extends Controller
{
    /**
     * @Route("/djs/{name}", name="_index")
     * @Template()
     */
    public function indexAction($name)
    {
        //return array('name' => $name);
        return $this->render('FloarcDynamicJavascriptBundle:DynamicJavascript:index.html.twig', array('name' => $name));
    }
    
    /**
     * @Route("/test", name="_test")
     * @Template()
     */
    public function testAction()
    {
    	
    	/*
    	$this->container->get('templating')->renderResponse($view, $parameters, $response);
    	
    	$mailer = $this->get('my_mailer');
    	$mailer->send('ryan@foobar.net', ... );    	
    	*/
    	
    	
    	
    	$templating = $this->get('templating');
//     	echo "<pre>";
//     	print_r(get_class($templating));
//     	echo "</pre>";
//     	echo "<pre>";
//     	print_r(get_class_methods(get_class($templating)));
//     	echo "</pre>";    	
    	
    	
    	$dynjs = $this->get('dyn_js');
    	/*
    	$dynjs->setTemplate("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig");
    	$dynjs->setParameters(array("foo"=>"bar","toto"=>"tata", "name"=>"John"));
    	$dynjs->setOutput("@FloarcDynamicJavascriptBundle/Resources/public/js/mydyn.js");
    	*/
    	
    	
    	$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig", array("foo"=>"bar","toto"=>"tata", "name"=>"John"), "@FloarcDynamicJavascriptBundle/Resources/public/js/mydyn.js" );
    	$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig", array("foo"=>"bur","toto"=>"titi", "name"=>"Jim"), "@FloarcDynamicJavascriptBundle/Resources/public/js/mydyn.js" );
    	$dynjs->dumpDynJs();
    	
    	
    	//$kernel = $this->get('kernel');
    	//$path = $kernel->locateResource('@AdmeDemoBundle/path/to/file/Foo.txt');
    	//$path = $kernel->locateResource('@FloarcDynamicJavascriptBundle/Resources');
    	//echo $path;
    	//echo "<br />";
    	//echo "<br />";
    	
//     	echo "test<br />";
//  		echo "<pre>";
//  		print_r(get_class($dynjs));
// 		echo "</pre>";
// 		echo "<pre>";
// 		print_r(get_class_methods(get_class($dynjs)));
// 		echo "</pre>";
		
// 		echo "<pre>";
// 		print_r($dynjs);
// 		echo "</pre>";

		/*
		if ($fooString = $this->get('cache')->fetch('foo')) {
			echo "fetch cache<br />";
			$foo = unserialize($fooString);
		} else {
			echo "save cache<br />";
			$foo = "youpi";
			// do the work
			$this->get('cache')->save('foo', serialize($foo));
		}
				
		
		echo "foo = ".$fooString." | ".$foo."<br />";
		*/
		
		//echo $dynjs->getContent();
			
		
    	
    	
    	//die("stopz");
    	//return array('name' => $name);
    	return $this->render('FloarcDynamicJavascriptBundle:DynamicJavascript:test.html.twig', array());
    }    
}
