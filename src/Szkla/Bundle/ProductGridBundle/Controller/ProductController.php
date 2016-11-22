<?php

namespace Szkla\Bundle\ProductGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Szkla\Bundle\ProductGridBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/", name="szkla_products.products_index")
     * @Template
     * @Acl(
     *     id="szkla_products.product_view",
     *     type="entity",
     *     class="SzklaProductGridBundle:Product",
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
    public function viewAction(Product $product)
    {
        return array(
            'entity' => $product,   // XXX: seems like this needs to be passed for ORO
            'product' => $product,
        );
    }

    /**
     * @Route("/create", name="szkla_products.product_create")
     * @Template("SzklaProductGridBundle:Product:update.html.twig")
     * @Acl(
     *     id="szkla_products.product_create",
     *     type="entity",
     *     class="SzklaProductGridBundle:Product",
     *     permission="CREATE"
     * )
     */
    public function createAction(Request $request)
    {
        return $this->update(new Product(), $request);
    }

    /**
     * @Route("/update/{id}", name="szkla_products.product_update", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @Acl(
     *     id="szkla_products.product_update",
     *     type="entity",
     *     class="SzklaProductGridBundle:Product",
     *     permission="EDIT"
     * )
     */
    public function updateAction(Product $product, Request $request)
    {
        return $this->update($product, $request);
    }

    private function update(Product $product, Request $request)
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
