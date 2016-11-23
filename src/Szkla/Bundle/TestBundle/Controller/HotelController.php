<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HotelController
 *
 * @Route("/hotel")
 */
class HotelController extends Controller
{
    /**
     * @Route("/", name="szkla_test.hotel_index")
     * @Template
     * @Acl(
     *     id="szkla_test.hotel_view",
     *     type="entity",
     *     class="SzklaTestBundle:Hotel",
     *     permission="VIEW"
     * )
     */
    public function indexAction()
    {
        return array('gridName' => 'hotels-grid');
    }
}