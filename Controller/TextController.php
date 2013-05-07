<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\TextBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TextController extends Controller
{
    /**
     * @Route("/{slug}.html")
     * @Template("SIPTextBundle:Text:item.html.twig")
     */
    public function itemAction($slug)
    {
        $test = $this->getTextRepository()->findOneBy(array('slug' => $slug));

        if (!$test) {
            throw $this->createNotFoundException("Unable to find entity");
        }

        return array('text' => $test);
    }

    /**
     * @return \SIP\ResourceBundle\Repository\EntityRepository
     */
    private function getTextRepository()
    {
        return $this->get('sip_text.repository.text');
    }
}