<?php

namespace ParserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use ParserBundle\Entity\ParserClass;
use ParserBundle\Entity\ParserInterface;
use ParserBundle\Entity\ParserNamespace;

/**
 * Class DefaultController
 * @package ParserBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/parser/tree", name="parser_tree")
     *
     * @return string|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return new Response(
            '<html><body>Hi</body></html>'
        );
    }
}
