<?php

namespace ParserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ParserBundle\Entity\ParserNamespace;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class DefaultController
 * @package ParserBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/parser/tree", name="parser_tree")
     */
    public function indexAction()
    {
        return $this->render('parser/index.html.twig');
    }

    /**
     * @Route("/parser/source", name="parser_source")
     *
     * @Method({"GET"})
     */
    public function sourceAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository(ParserNamespace::class);
        $namespace = $repo->childrenHierarchy();
        return $this->json($namespace);
    }
}
