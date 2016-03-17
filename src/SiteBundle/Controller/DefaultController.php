<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="site_carrefour")
     */
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();
    	if ($session->has('id')) {
		    return $this->redirect( $this->generateUrl('site_home') );
		}else{
        	return $this->render('SiteBundle:Default:index.html.twig');
		}
    }

    /**
     * @Route("/home", name="site_home")
     */
    public function homeAction(Request $request)
    {
    	$session = $request->getSession();
    	if ($session->has('id')) {
	    	$id_user = $session->get('id');

	    	$getUsers = $this->get("services.users");
			$user = $getUsers->findUserById($id_user);

	        return $this->render('SiteBundle:Default:home.html.twig', array('id_user' => $id_user, 'user' => $user));
	    }else{
	    	return $this->redirect( $this->generateUrl('site_carrefour') );
	    }
    }

    /**
     * @Route("/user/connect", name="site_user_connect")
     */
    public function connectAction(Request $request)
    {
        $session = $request->getSession();
        $id = $request->get('id');
        $session->set('id', $id);
        return $this->redirect( $this->generateUrl('site_home') );
    }

    /**
     * @Route("/user/disconnect", name="site_user_disconnect")
     */
    public function disconnectAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->redirect( $this->generateUrl('site_home') );
    }

    /**
     * @Route("/connexion")
     */
    public function connexionAction(Request $request)
	{

	    if($request->isXmlHttpRequest())
	    {
	    	$email = $request->get('email');
	    	$getUsers = $this->get("services.users");
			$emailUser = $getUsers->findUserByEmail($email);
	        return new JSONResponse($emailUser);
	    }
	    else {
	        return new Response("Erreur: ce n'est pas une requete ajax");
	    }
	}
}
