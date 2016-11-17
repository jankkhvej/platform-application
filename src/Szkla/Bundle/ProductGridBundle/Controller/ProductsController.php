<?php

namespace Szkla\Bundle\ProductGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Szkla\Bundle\ProductGridBundle\Entity\Products;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller
{
    /**
     * @Route("/", name="szkla_products.products_index")
     * @Template
     * @Acl(
     *     id="szkla_products.product_view",
     *     type="entity",
     *     class="SzklaProductGridBundle:Products",
     *     permission="VIEW"
     * )
     */
    public function indexAction()
    {
        return array('gridName' => 'products-grid');
    }

    /**
     * @Route("/{id}", name="szkla_products.product_view", requirements={"id"="\d+"})
     * @Template
     * @AclAncestor("szkla_products.product_view")
     */
    public function viewAction(Products $product)
    {
        return array(
            'entity' => $product,   // XXX: seems like this needs to be passed for ORO
            'product' => $product,
        );
    }

    /**
     * @Route("/create", name="szkla_products.product_create")
     * @Template("SzklaProductGridBundle:Products:update.html.twig")
     * @Acl(
     *     id="szkla_products.product_create",
     *     type="entity",
     *     class="SzklaProductGridBundle:Products",
     *     permission="CREATE"
     * )
     */
    public function createAction(Request $request)
    {
        return $this->update(new Products(), $request);
    }

    /**
     * @Route("/update/{id}", name="szkla_products.product_update", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @Acl(
     *     id="szkla_products.product_update",
     *     type="entity",
     *     class="SzklaProductGridBundle:Products",
     *     permission="EDIT"
     * )
     */
    public function updateAction(Products $product, Request $request)
    {
        return $this->update($product, $request);
    }

    private function update(Products $product, Request $request)
    {
        $form = $this->get('form.factory')->create('szkla_products', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->get('oro_ui.router')->redirectAfterSave(
                array(
                    'route' => 'szkla_products.product_update',
                    'parameters' => array('id' => $product->getId()),
                ),
                array('route' => 'szkla_products.products_index'),
                $product
            );
        }

        return array(
            'entity' => $product,
            'form' => $form->createView(),
        );
    }
}
