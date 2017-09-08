<?php

namespace AppBundle\Controller;

use Bonobo\BonoboBundle\Entity\Friend;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="")
     */
    public function indexAction(Request $request)
    {
       /* $bonobo = new Friend();
        $bonobo->setName("boubou");
        $bonobo->setAge(10);
        $bonobo->setFamille("bobo");
        $bonobo->setRace("race pur");
        $bonobo->setNourriture("banane");

        $em = $this->getDoctrine()->getManager();

        $em->persist($bonobo);

        $em->flush();
*/


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);

    }
}
