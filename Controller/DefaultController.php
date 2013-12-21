<?php

namespace Floarc\DynamicJavascriptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="_demo_dynjs_hello")
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
    	

//     	echo '<pre>';
//     	print_r($form);
//     	echo '<pre>';

    	/*
    	echo '<pre>';
    	print_r((get_class($form)));
    	echo '<pre>';    	
    	
    	echo '<pre>';
    	print_r(get_class_methods(get_class($form)));
    	echo '<pre>';

    	echo '<pre>';
    	print_r(get_class($form->getConfig()));
    	echo '<pre>';
    	echo '<pre>';
    	print_r(get_class_methods(get_class($form->getConfig())));
    	echo '<pre>';
    	*/

    	
    	foreach($form as $key => $per) {
    		echo get_class($per->getConfig())." ".$per->getConfig()->getName()." ".$per->getConfig()->getType()->getName()."<br />";
    	} 

    	
    	echo '<pre>';
    	//print_r($per->getConfig()->getFormConfig());
    	echo '<pre>';    	
    	
    	echo '<pre>';
    	//print_r($form->getConfig()->getFormConfig());
    	echo '<pre>';    	
    	
    	die("tptp");
    	
    	
    	/*
    	return $this->render('FloarcDynamicJavascriptBundle:Default:contact.html.twig', array(
    			'form' => $form->createView(),
    	));
    	*/    	
    	
    }

    
    /**
     * @Route("/dynamic_javascript", name="_demo_dynjs_dynamic_javascript")
     * @Template()
     */
    public function dynamicJavascriptAction()
    {
   	 
    	$templating = $this->get('templating');
   	 
    	$dynjs = $this->get('dyn_js');
    	/*
    	$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig", array("age"=>"3","name"=>"Luna"), "@FloarcDynamicJavascriptBundle/Resources/public/js/girl.js" );
    	$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig", array("foo"=>"bar","name"=>"John"), "@FloarcDynamicJavascriptBundle/Resources/public/js/mydyn.js" );
    	$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig", array("foo"=>"tod","name"=>"Jim"), "@FloarcDynamicJavascriptBundle/Resources/public/js/mydyn.js" );
    	*/

    	//$dynjs->addDynJs("FloarcDynamicJavascriptBundle:Default:DynamicJavascript:person.html.twig", 	 array("name"=>"Luna", "sex"=>"girl", "age"=>"36", "height"=>"1.75"), "@FloarcDynamicJavascriptBundle/Resources/public/js/person.js");
    	//$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:person.html.twig", 	 array("name"=>"Luna", "sex"=>"girl", "age"=>"36", "height"=>"1.75"), "@FloarcDynamicJavascriptBundle/Resources/public/js/person.js");
    	
    	//$dynjs->addDynJs("FloarcDynamicJavascriptBundle:DynamicJavascript:dynjs.html.twig", 	 array("name"=>"Luna", "sex"=>"girl", "age"=>"36", "height"=>"1.75"), "@FloarcDynamicJavascriptBundle/Resources/public/js/person.js");
    	//$dynjs->addDynJs("@FloarcDynamicJavascriptBundle:Default:DynamicJavascript:concatened.html.twig", array("name"=>"John","family_name"=>"Doe"), 						  "@FloarcDynamicJavascriptBundle/Resources/public/js/concatened.js");
    	//$dynjs->addDynJs("@FloarcDynamicJavascriptBundle:Default:DynamicJavascript:concatened.html.twig", array("name"=>"Jim","family_name"=>"Carter"), 						  "@FloarcDynamicJavascriptBundle/Resources/public/js/concatened.js");    	
    	//$dynjs->dumpDynJs();
    	//die("dynamicJavascript");
    	
    	//return $this->render('FloarcDynamicJavascriptBundle:DynamicJavascript:test.html.twig', array());
    	return array('text' => "Dynamic Js generated");
    }    
    
    
}