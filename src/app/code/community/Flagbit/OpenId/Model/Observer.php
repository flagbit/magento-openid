<?php

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
