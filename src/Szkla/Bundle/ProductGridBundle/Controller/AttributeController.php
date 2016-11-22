<?php

namespace Szkla\Bundle\ProductGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Szkla\Bundle\ProductGridBundle\Entity\Attribute;
use Symfony\Component\HttpFoundation\Request;

class AttributeController extends Controller
{
    /**
     * @Route("/", name="szkla_attributes.attributes_index")
     * @Template
     * @Acl(
     *     id="szkla_attributes.attribute_view",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attribute",
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
    public function viewAction(Attribute $attribute)
    {
        return array(
            'entity' => $attribute,   // XXX: seems like this needs to be passed for ORO
            'attribute' => $attribute,
        );
    }

    /**
     * @Route("/create", name="szkla_attributes.attribute_create")
     * @Template("SzklaProductGridBundle:Attribute:update.html.twig")
     * @Acl(
     *     id="szkla_attributes.attribute_create",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attribute",
     *     permission="CREATE"
     * )
     */
    public function createAction(Request $request)
    {
        return $this->update(new Attribute(), $request);
    }

    /**
     * @Route("/update/{id}", name="szkla_attributes.attribute_update", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @Acl(
     *     id="szkla_attributes.attribute_update",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attribute",
     *     permission="EDIT"
     * )
     */
    public function updateAction(Attribute $attribute, Request $request)
    {
        return $this->update($attribute, $request);
    }

    private function update(Attribute $attribute, Request $request)
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
