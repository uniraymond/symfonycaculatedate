<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\CaculateDays as cacuDays;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $cacu = new cacuDays();
        $data = array();

        $data['dateFrom']          = '2016-6-2 10:30:20';
        $data['dateTo']            = '2016-6-6 8:29:21';
        $data['timetype']          = 0;
        $data['interval']          = 'wd';
        $result = $cacu->datediff($data);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
