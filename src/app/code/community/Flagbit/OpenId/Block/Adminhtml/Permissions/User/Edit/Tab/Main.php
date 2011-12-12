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
 * User edit form main tab
 *
 * @category    Flagbit
 * @package     Flagbit_OpenId
 * @author      David Fuhr <fuhr@flagbit.de>
 */
class Flagbit_OpenId_Block_Adminhtml_Permissions_User_Edit_Tab_Main extends Mage_Adminhtml_Block_Permissions_User_Edit_Tab_Main
{
    protected function _prepareForm()
    {
        $return = parent::_prepareForm();
        
        /* @var $form Varien_Data_Form */
        $form = $this->getForm();
        
        /* @var $fieldset Varien_Data_Form_Element_Fieldset */
        $fieldset = $form->getElement('base_fieldset');
        
        $fieldset->addField('openid_identifier', 'text', array(
            'name'  => 'openid_identifier',
            'label' => Mage::helper('flagbit_openid')->__('OpenId Identifier'),
            'id'    => 'openid_identifier',
            'title' => Mage::helper('flagbit_openid')->__('OpenId Identifier'),
        ));

        /* @var $model Mage_Admin_Model_User */
        $model = Mage::registry('permissions_user');
        $form->addValues(array('openid_identifier' => $model->getData('openid_identifier')));
        
        return $return;
    }
}
