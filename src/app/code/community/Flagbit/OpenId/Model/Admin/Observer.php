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
 * Admin observer model
 *
 * @category    Flagbit
 * @package     Flagbit_OpenId
 * @author      David Fuhr <fuhr@flagbit.de>
 */
class Flagbit_OpenId_Model_Admin_Observer extends Mage_Admin_Model_Observer
{
    public function actionPreDispatchAdmin($event)
    {
        /* @var $session Mage_Admin_Model_Session */
        $session = Mage::getSingleton('flagbit_openid/admin_session');
        $request = Mage::app()->getRequest();
        
        if (!$session->isLoggedIn() && 'admin' === $request->getModuleName() && 'openid' === $request->getControllerName() && 'login' === $request->getActionName()) {
            if (($postLogin = $request->getPost('login')) || 'id_res' === $request->getParam('openid_mode')) {
                $username = isset($postLogin['openid_identifier']) ? $postLogin['openid_identifier'] : '';
                $user = $session->login($username, '', $request);
            }
            else {
                $request->setDispatched(true);
            }
        }
        else {
            return parent::actionPreDispatchAdmin($event);
        }
        
        $session->refreshAcl();
    }
}
