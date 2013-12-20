<?php

namespace Floarc\DynamicJavascriptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="_djs")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/contact", name="_djs_contact")
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
    
    
}