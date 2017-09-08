<?php

namespace Bonobo\BonoboBundle\Controller;

use Bonobo\BonoboBundle\Entity\Friend;
use Bonobo\BonoboBundle\Form\FriendType;
use Bonobo\BonoboBundle\Form\RechercherFriendType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BonoboController extends Controller
{
    public function indexAction()
    {
        return $this->render('BonoboBonoboBundle:Default:index.html.twig');
    }

//----------------------------------------Liste Bonobo---------------------------------
    public function ListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bonobo = $em->getRepository("BonoboBonoboBundle:Friend")->findAll();
        //$cl = $em->getRepository("BonoboBonoboBundle:Client")->findAll();
        return $this->render('BonoboBonoboBundle:bonoboView:list.html.twig',array('listes'=>$bonobo));
    }

    //----------------------------------------Ajouter Bonobo---------------------------------
    public function Add1Action(Request $request)
    {
        $friend=new Friend();

        if($request->isMethod('POST')){
            $friend->setName($request->get('nom'));
            $friend->setAge($request->get('age'));
            $friend->setFamille($request->get('famille'));
            $friend->setRace($request->get('race'));
            $friend->setNourriture($request->get('nourriture'));
            $friend->setUser($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($friend); //je selectionne l'entité que je veux manipuler
            $em->flush(); //ajouter dans la table
            return $this->redirectToRoute('bonobo_bonobo_list');
        }
        return $this->render('BonoboBonoboBundle:bonoboView:ajout1.html.twig',array());
    }

//----------------------------------------Supprimer Bonobo---------------------------------
    public function DeleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("BonoboBonoboBundle:Friend")->find($id);
        $em->remove($modele);
        $em->flush();

        return $this->redirectToRoute('bonobo_bonobo_list');
    }

//----------------------------------------Modifier Bonobo---------------------------------
    public function UpdateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("BonoboBonoboBundle:Friend")->find($id);
        $Form=$this->createForm(FriendType::class, $modele);

        $Form->handleRequest($request);
        if($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirect($this->generateUrl('bonobo_bonobo_list'));
        }
        return $this->render("BonoboBonoboBundle:bonoboView:update.html.twig",array('form'=>$Form->createView()));
    }

//----------------------------------------Chercher Bonobo---------------------------------
    public function RechercheAction(Request $request)
    {
        $modele=new Friend();
        $a=$modele->getName();
        $em=$this->getDoctrine()->getManager();
        $modeles=$em->getRepository("BonoboBonoboBundle:Friend")->findAll();

        $Form=$this->createForm(RechercherFriendType::class,$modele);
        $Form->handleRequest($request);
        if($Form->isValid())
        {
            $modeles=$em->getRepository("BonoboBonoboBundle:Friend")->findBy(array('name'=>$modele->getName()));
        }
        return $this->render("BonoboBonoboBundle:bonoboView:recherche.html.twig",array('Form'=>$Form->createView(),'modeles'=>$modeles,'validation_groups' => false));
    }



    public function InviterAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $bonobo = $em->getRepository("BonoboBonoboBundle:User")->find($this->getUser());
        $freind = $em->getRepository("BonoboBonoboBundle:Friend")->find($id);
        $bonobo->addFriend( $freind );
        $em->persist($bonobo);
        $em->flush();

        return $this->redirectToRoute('bonobo_bonobo_list');
    }


}

