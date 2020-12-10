<?php
namespace Flurrybox\EnhancedPrivacy\Api\CustomerManagementInterface;

/**
 * Proxy class for @see \Flurrybox\EnhancedPrivacy\Api\CustomerManagementInterface
 */
class Proxy implements \Flurrybox\EnhancedPrivacy\Api\CustomerManagementInterface, \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Flurrybox\EnhancedPrivacy\Api\CustomerManagementInterface
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Flurrybox\\EnhancedPrivacy\\Api\\CustomerManagementInterface', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Flurrybox\EnhancedPrivacy\Api\CustomerManagementInterface
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOrders(\Magento\Customer\Api\Data\CustomerInterface $customer)
    {
        return $this->_getSubject()->hasOrders($customer);
    }

    /**
     * {@inheritdoc}
     */
    public function isCustomerToBeDeleted(\Magento\Customer\Api\Data\CustomerInterface $customer)
    {
        return $this->_getSubject()->isCustomerToBeDeleted($customer);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCustomer(\Magento\Customer\Api\Data\CustomerInterface $customer)
    {
        return $this->_getSubject()->deleteCustomer($customer);
    }

    /**
     * {@inheritdoc}
     */
    public function anonymizeCustomer(\Magento\Customer\Api\Data\CustomerInterface $customer)
    {
        return $this->_getSubject()->anonymizeCustomer($customer);
    }

    /**
     * {@inheritdoc}
     */
    public function cancelCustomerDeletion(\Magento\Customer\Api\Data\CustomerInterface $customer)
    {
        return $this->_getSubject()->cancelCustomerDeletion($customer);
    }
}
