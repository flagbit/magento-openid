<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Flagbit
 * @package     Flagbit_OpenId
 * @copyright   Copyright (c) 2011 Flagbit GmbH & Co. KG (http://www.flagbit.de/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Auth session model
 *
 * @category    Flagbit
 * @package     Flagbit_OpenId
 * @author      David Fuhr <fuhr@flagbit.de>
 */
class Flagbit_OpenId_Model_Admin_Session extends Mage_Admin_Model_Session
{

    /**
     * Try to login user in admin
     *
     * @param  string $username
     * @param  string $password
     * @param  Mage_Core_Controller_Request_Http $request
     * @return Mage_Admin_Model_User|null
     */
    public function login($username, $password, $request = null)
    {
        if ($request instanceof Mage_Core_Controller_Request_Http) {
            if ($postLogin = $request->getPost('login') && isset($postLogin['openid_identifier']) && $username === $postLogin['openid_identifier']) {
                $consumer = new Zend_OpenId_Consumer();
                if (!$consumer->login($login['openid_identifier'])) {
                    throw new Exception('login failed');
                }
            }
            
            $identity = null;
            if ('id_res' === $request->getParam('openid_mode')) {
                $consumer = new Zend_OpenId_Consumer();
                // idenitity will be returned by reference
                if (!$consumer->verify($request->getParams(), $identity)) {
                    throw new Exception('verification failed');
                }
                
                // valid login - all fine: now let's fake a login for magento
                /* @var $user Mage_Admin_Model_User */
                $user = Mage::getModel('admin/user');
                // TODO load user and verify openid identifier and pass it on to parent::login()
            }
        }
        
        return parent::login($username, $password, $request);
    }
}
