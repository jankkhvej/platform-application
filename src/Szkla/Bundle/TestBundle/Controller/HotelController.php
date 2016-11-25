<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Szkla\Bundle\TestBundle\Entity\Hotel;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/{id}", name="szkla_test.hotel_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("szkla_test.hotel_view")
     */
    public function viewAction(Hotel $hotel)
    {
        return array(
            'entity' => $hotel,
            'hotel' => $hotel,
        );
    }

    /**
     * @Route("/create", name="szkla_test.hotel_create")
     * @Template("SzklaTestBundle:Hotel:update.html.twig")
     * @Acl(
     *     id="szkla_test.hotel_create",
     *     type="entity",
     *     class="SzklaTestBundle:Hotel",
     *     permission="CREATE"
     * )
     */
    public function createAction(Request $request)
    {
        return $this->update(new Hotel(), $request);
    }

    /**
     * @Route("/update/{id}", name="szkla_test.hotel_update", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @Acl(
     *     id="szkla_test.hotel_update",
     *     type="entity",
     *     class="SzklaTestBundle:Hotel",
     *     permission="EDIT"
     * )
     */
    public function updateAction(Hotel $hotel, Request $request)
    {
        return $this->update($hotel, $request);
    }

    private function update(Hotel $hotel, Request $request)
    {
        $form = $this->get('form.factory')->create('szkla_test_hotel', $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hotel);
            $entityManager->flush();

            return $this->get('oro_ui.router')->redirectAfterSave(
                array(
                    'route' => 'szkla_test.hotel_update',
                    'parameters' => array('id' => $hotel->getId()),
                ),
                array('route' => 'szkla_test.hotel_index'),
                $hotel
            );
        }

        return array(
            'entity' => $hotel,
            'form' => $form->createView(),
        );
    }
}