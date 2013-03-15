<?php
namespace Acme\Bundle\DemoFlexibleEntityBundle\Tests\Functional\Controller;

/**
 * Test related class
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/MIT MIT
 *
 */
class CustomerControllerTest extends KernelAwareControllerTest
{

    /**
     * Define customer controller name for url generation
     * @staticvar string
     */
    protected static $controller = 'customer';

    /**
     * Get customer manager
     *
     * @return \Oro\Bundle\FlexibleEntityBundle\Manager\FlexibleManager
     */
    protected function getCustomerManager()
    {
        return $this->getContainer()->get('customer_manager');
    }

    /**
     * Test related method
     */
    public function testIndexAction()
    {
        foreach (self::$locales as $locale) {
            $this->client->request(
                'GET',
                self::prepareUrl($locale, 'index'),
                array(),
                array(),
                array('PHP_AUTH_USER' =>  self::AUTH_USER, 'PHP_AUTH_PW' => self::AUTH_PW)
            );
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }
    }

    /**
     * Test related method
     *
     * @throws \Exception
     */
    public function testShowAction()
    {
        // find customer to show
        $customer = $this->getCustomerManager()->getFlexibleRepository()->findOneBy(array());
        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        // call and assert view
        foreach (self::$locales as $locale) {
            $this->client->request(
                'GET',
                self::prepareUrl('en', 'show/'.$customer->getId()),
                array(),
                array(),
                array('PHP_AUTH_USER' =>  self::AUTH_USER, 'PHP_AUTH_PW' => self::AUTH_PW)
            );
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }
    }

    /**
     * Test related method
     */
    public function testCreateAction()
    {
        // just call view to show form
        foreach (self::$locales as $locale) {
            $this->client->request(
                'GET',
                self::prepareUrl($locale, 'create'),
                array(),
                array(),
                array('PHP_AUTH_USER' =>  self::AUTH_USER, 'PHP_AUTH_PW' => self::AUTH_PW)
            );
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }
    }

    /**
     * Test related method
     */
    public function testEditAction()
    {
        // find customer to edit
        $customer = $this->getCustomerManager()->getFlexibleRepository()->findOneBy(array());
        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        // just call view to show form
        foreach (self::$locales as $locale) {
            $this->client->request(
                'GET',
                self::prepareUrl($locale, 'edit/'. $customer->getId()),
                array(),
                array(),
                array('PHP_AUTH_USER' =>  self::AUTH_USER, 'PHP_AUTH_PW' => self::AUTH_PW)
            );
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }
    }

    /**
     * Count customers in database
     *
     * @return integer
     */
    protected function countCustomers()
    {
        $customers = $this->getCustomerManager()->getFlexibleRepository()->findAll();

        return count($customers);
    }

    /**
     * Test related method
     */
    public function testQueryLazyLoadAction()
    {
        foreach (self::$locales as $locale) {
            $this->client->request(
                'GET',
                self::prepareUrl($locale, 'query-lazy-load'),
                array(),
                array(),
                array('PHP_AUTH_USER' =>  self::AUTH_USER, 'PHP_AUTH_PW' => self::AUTH_PW)
            );
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }
    }

    /**
     * Related method
     */
    public function testQueryAction()
    {
        // test with all parameters to null
        $params = array(
            'attributes' => 'null',
            'criteria'   => 'null',
            'orderBy'    => 'null',
            'limit'      => 'null',
            'offset'     => 'null'
        );
        $this->callQueryActionUrl($params);

        // test with only dob
        $params = array(
            'attributes' => 'dob'
        );
        $this->callQueryActionUrl($params);

        // test with dob and gender
        $params = array(
            'attributes' => 'dob&gender'
        );
        $this->callQueryActionUrl($params);

        // test filtered by firstname
        $params = array(
            'attributes' => 'null',
            'criteria'   => 'firstname=Nicolas'
        );
        $this->callQueryActionUrl($params);

        // test filtered by firstname and company
        /*$params = array(
            'criteria'   => 'firstname=Romain&company=Akeneo'
        );
        $this->callQueryActionUrl($params);*/

        // test dob, company and gender filtered by firstname and company
        $params = array(
            'attributes' => 'dob&company&gender',
            'criteria'   => 'firstname=Romain&company=Akeneo'
        );
        $this->callQueryActionUrl($params);

        // test filtered by firstname and limit
        $params = array(
            'criteria' => 'firstname=Nicolas',
            'limit'    => 10,
            'offset'   => 0
        );
        $this->callQueryActionUrl($params);

        // test select dob filtered by firstname and order by dob desc
        $params = array(
            'attributes' => 'dob',
            'criteria'   => 'firstname=Romain',
            'orderBy'    => 'dob=desc'
        );
        $this->callQueryActionUrl($params);
    }

    /**
     * Call query action and assert result
     * @param mixed $params
     */
    protected function callQueryActionUrl($params)
    {
        $attributes = (isset($params['attributes'])) ? $params['attributes'] : 'null';
        $criteria   = (isset($params['criteria'])) ? $params['criteria'] : 'null';
        $orderBy    = (isset($params['orderBy'])) ? $params['orderBy'] : 'null';
        $limit      = (isset($params['limit'])) ? $params['limit'] : 'null';
        $offset     = (isset($params['offset'])) ? $params['offset'] : 'null';

        $urlSuffix = $this->prepareUrlForQueryAction($attributes, $criteria, $orderBy, $limit, $offset);
        foreach (self::$locales as $locale) {
            $this->client->request(
                'GET',
                self::prepareUrl($locale, 'query/'. $urlSuffix),
                array(),
                array(),
                array('PHP_AUTH_USER' =>  self::AUTH_USER, 'PHP_AUTH_PW' => self::AUTH_PW)
            );
            $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        }
    }

    /**
     * Prepare tested url with parameters
     *
     * @param string $attributes attribute codes
     * @param string $criteria   criterias
     * @param string $orderBy    order by
     * @param int    $limit      limit
     * @param int    $offset     offset
     *
     * @return string
     */
    protected function prepareUrlForQueryAction($attributes, $criteria, $orderBy, $limit, $offset)
    {
        return $attributes .'/'. $criteria .'/'. $orderBy .'/'. $limit .'/'. $offset;
    }
}
