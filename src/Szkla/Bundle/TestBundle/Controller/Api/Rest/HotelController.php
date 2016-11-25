<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

/**
 * @RouteResource("hotel")
 * @NamePrefix("szkla_test_api_")
 */
class HotelController extends RestController
{
    /**
     * @Acl(
     *      id="szkla_test.hotel_delete",
     *      type="entity",
     *      class="SzklaTestBundle:Hotel",
     *      permission="DELETE"
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
        return $this->get('szkla_test.hotel_manager.api');
    }
}