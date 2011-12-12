<?php

class Flagbit_OpenId_Model_Admin_User extends Mage_Admin_Model_User
{
    // FIXME do we need this?
    //protected $_resourceName = '';
    
    /**
     * @param string $openIdIdentifier
     * @return Flagbit_OpenId_Model_Admin_User
     */
    public function loadByOpenIdIdentifier($openIdIdentifier)
    {
        $this->setData($this->getResource()->loadByOpenIdIdentifier($openIdIdentifier));
        return $this;
    }
}
