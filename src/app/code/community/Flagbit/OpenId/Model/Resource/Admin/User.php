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
 * Admin user resource
 *
 * @category    Flagbit
 * @package     Flagbit_OpenId
 * @author      David Fuhr <fuhr@flagbit.de>
 */
class Flagbit_OpenId_Model_Resource_Admin_User extends Mage_Admin_Model_Resource_User
{
    public function loadByOpenIdIdentifier($openIdIdentifier)
    {
        $adapter = $this->_getReadAdapter();

        $select = $adapter->select()
                    ->from($this->getMainTable())
                    ->where('openid_identifier = :openid_identifier');

        $binds = array(
            'openid_identifier' => $openIdIdentifier
        );

        return $adapter->fetchRow($select, $binds);
    }
}
