<?php

namespace Szkla\Bundle\ProductGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Szkla\Bundle\ProductGridBundle\Entity\Attributes;
use Symfony\Component\HttpFoundation\Request;

class AttributesController extends Controller
{
    /**
     * @Route("/", name="szkla_attributes.attributes_index")
     * @Template
     * @Acl(
     *     id="szkla_attributes.attribute_view",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attributes",
     *     permission="VIEW"
     * )
     */
    public function indexAction()
    {
        return array('gridName' => 'attributes-grid');
    }

    /**
     * @Route("/{id}", name="szkla_attributes.attribute_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("szkla_attributes.attribute_view")
     */
    public function viewAction(Attributes $attribute)
    {
        return array(
            'entity' => $attribute,   // XXX: seems like this needs to be passed for ORO
            'attribute' => $attribute,
        );
    }

    /**
     * @Route("/create", name="szkla_attributes.attribute_create")
     * @Template("SzklaProductGridBundle:Attributes:update.html.twig")
     * @Acl(
     *     id="szkla_attributes.attribute_create",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attributes",
     *     permission="CREATE"
     * )
     */
    public function createAction(Request $request)
    {
        return $this->update(new Attributes(), $request);
    }

    /**
     * @Route("/update/{id}", name="szkla_attributes.attribute_update", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @Acl(
     *     id="szkla_attributes.attribute_update",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attributes",
     *     permission="EDIT"
     * )
     */
    public function updateAction(Attributes $attribute, Request $request)
    {
        return $this->update($attribute, $request);
    }

    private function update(Attributes $attribute, Request $request)
    {
        $form = $this->get('form.factory')->create('szkla_attributes', $attribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attribute);
            $entityManager->flush();

            return $this->get('oro_ui.router')->redirectAfterSave(
                array(
                    'route' => 'szkla_attributes.attribute_update',
                    'parameters' => array('id' => $attribute->getId()),
                ),
                array('route' => 'szkla_attributes.attributes_index'),
                $attribute
            );
        }

        return array(
            'entity' => $attribute,
            'form' => $form->createView(),
        );
    }
}
