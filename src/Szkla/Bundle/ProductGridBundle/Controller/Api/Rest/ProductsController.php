<?php

namespace Szkla\Bundle\ProductGridBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Szkla\Bundle\ProductGridBundle\Entity\Products;

/**
 * Class ProductsController
 * @RouteResource("product")
 * @NamePrefix("szkla_products_api_")
 */
class ProductsController extends RestController
{
    /**
     * @Acl(
     *     id="szkla_products.product_delete",
     *     type="entity",
     *     class="SzklaProductGridBundle:Products",
     *     permission="DELETE"
     * )
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    public function getForm()
    {
    }

    public function getFormHandler()
    {
    }

    public function getManager()
    {
        return $this->get('szkla_products.product_manager.api');
    }
}
