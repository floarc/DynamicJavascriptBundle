<?php

namespace Floarc\DynamicJavascriptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", defaults={"name" = "stranger"}, name="_demo_dynjs_hello")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/contact", name="_demo_dynjs_contact")
     * @Template()
     */
    /*
    public function contactAction()
    {
    	$defaultData = array('message' => 'Type your message here');
    	$form = $this->createFormBuilder($defaultData)
    	->add('name', 'text')
    	->add('email', 'email')
    	->add('message', 'textarea')
    	->getForm();
    	
    	$form->handleRequest($this->getRequest());
    	
    	if ($form->isValid()) {
    		// Les données sont un tableau avec les clés "name", "email", et "message"
    		$data = $form->getData();
    	}
    	

    	foreach($form as $key => $per) {
    		echo get_class($per->getConfig())." ".$per->getConfig()->getName()." ".$per->getConfig()->getType()->getName()."<br />";
    	} 
    	
    	return array('form' => $form->createView());
    }
    */

    
    /**
     * @Route("/simple_dyn_js", name="_simpleDynJs")
     * @Template()
     */
    public function simpleDynJsAction()
    {
    	
    	//$path = $this->get('kernel')->locateResource('@FloarcDynamicJavascriptBundle/Resources/public/js/person.js');
    	
//     	echo $path."<br />";
//     	if($this->get('filesystem')->exists($path)){
//     		echo "existe!<br />";
//     	}else{
//     		echo "n'existe pas...!<br />";
//     	}
    	
//     	die("dd");
    	
    	//die(get_class($this->get('dyn_js')));
                               
    	
    	$templating = $this->get('templating');
		$this->get('dyn_js')
    	->addDynJs("FloarcDynamicJavascriptBundle:Default/DynamicJavascript:person.html.twig", 	 array("name"=>"Luna", "sex"=>"girl", "age"=>"36", "height"=>"1.75"), "@FloarcDynamicJavascriptBundle/Resources/public/js/simple.js")
    	->dumpDynJs();
		
    	return array('text' => "A simple dynamic javascript named \"simple.js\" has been generated");
    }

    
    /**
     * @Route("/concatenated_dyn_js", name="_concatenatedDynJs")
     * @Template()
     */
    public function concatenatedDynJsAction()
    {
    
    	$templating = $this->get('templating');
    	$this->get('dyn_js')
    	->addDynJs("FloarcDynamicJavascriptBundle:Default/DynamicJavascript:concatenated_first.html.twig", array("name"=>"John","family_name"=>"Doe"), 		"@FloarcDynamicJavascriptBundle/Resources/public/js/concatenated.js")
    	->addDynJs("FloarcDynamicJavascriptBundle:Default/DynamicJavascript:concatenated_second.html.twig", array("name"=>"Jim","family_name"=>"Carter"), 	"@FloarcDynamicJavascriptBundle/Resources/public/js/concatenated.js")    	
    	->dumpDynJs();
    	return array('text' => "A concatenated dynamic javascript named \"concatenated.js\" has been generated");
    }    
    
}