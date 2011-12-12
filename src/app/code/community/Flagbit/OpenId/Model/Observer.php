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
 * Openid observer model
 *
 * @category    Flagbit
 * @package     Flagbit_OpenId
 * @author      David Fuhr <fuhr@flagbit.de>
 */
class Flagbit_OpenId_Model_Observer
{
    public function coreBlockAbstractToHtmlAfter($event)
    {
        /* @var $block Mage_Core_Block_Abstract */
        $block = $event->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Template && 'login.phtml' === $block->getTemplate()) {
            $html = $event->getTransport()->getHtml();
            
            $dom = new DOMDocument();
            $dom->loadHTML($html);
            $xml = simplexml_import_dom($dom);
            /* @var $formButtons SimpleXMLElement */
            $formButtons = current($xml->xpath('//form[@id=\'loginForm\']//div[@class=\'form-buttons\']'));
            
            $openIdLoginLink = $formButtons->addChild('a', Mage::helper('flagbit_openid')->__('OpenID Login'));
            $openIdLoginLink->addAttribute('class', 'left');
            $openIdLoginLink->addAttribute('style', 'margin-left: 10px');
            $openIdLoginLink->addAttribute('href', Mage::helper('adminhtml')->getUrl('adminhtml/openid/login', array('_nosecret' => true)));

            $html = $xml->saveXML();
            
            $event->getTransport()->setHtml($html);
        }
    }
}
