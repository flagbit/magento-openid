# Flagbit_OpenId

Provides [OpenID](http://www.openid.net/)-Authentication for the [Magento](http://www.magentocommerce.com/) Backend.

## Notes

Adminhtml Controllers require a valid Session. The
Exceptions for 'forgotpassword' and 'logout' are hardcoded in ``Mage_Admin_Model_Observer::actionPreDispatchAdmin()`` which is triggered via event defined in
``app/code/core/Mage/Adminhtml/etc/config.xml``. This forces me to override the Observer which can cause nasty Conflicts. Any other suggestions? Anybody?