<?php
/**
 * Created by PhpStorm.
 * User: dnow
 * Date: 11.05.2018
 * Time: 14:07
 */

namespace AppBundle\Controller\Api;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Programmer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProgrammerController extends BaseController
{
    /**
     * @Route("/api/programmers")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $data = $request->getContent();

        $programmer = new Programmer($data['nickname'], $data['avatarNumber']);
        $programmer->setTagLine($data['tagLine']);
        $programmer->setUser($this->findUserByUsername('weaverryan'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($programmer);
        $em->flush();

        return new Response('It worked. Believe me - I\'m an API');
    }
}
