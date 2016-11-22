<?php
/**
 * Created by PhpStorm.
 * User: solik
 * Date: 22.11.16
 * Time: 14:14
 */

namespace Szkla\Bundle\ProductGridBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="szkla_user.user_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}