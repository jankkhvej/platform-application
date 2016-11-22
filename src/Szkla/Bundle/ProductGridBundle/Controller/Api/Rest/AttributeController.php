<?php

namespace Szkla\Bundle\ProductGridBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Szkla\Bundle\ProductGridBundle\Entity\Attribute;

/**
 * Class AttributesController
 * @RouteResource("attribute")
 * @NamePrefix("szkla_attributes_api_")
 */
class AttributeController extends RestController
{
    /**
     * @Acl(
     *     id="szkla_attributes.attribute_delete",
     *     type="entity",
     *     class="SzklaProductGridBundle:Attribute",
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
        return $this->get('szkla_attributes.attribute_manager.api');
    }
}
