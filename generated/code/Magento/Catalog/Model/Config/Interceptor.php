<?php
namespace Magento\Catalog\Model\Config;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Config
 */
class Interceptor extends \Magento\Catalog\Model\Config implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\CacheInterface $cache, \Magento\Eav\Model\Entity\TypeFactory $entityTypeFactory, \Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory $entityTypeCollectionFactory, \Magento\Framework\App\Cache\StateInterface $cacheState, \Magento\Framework\Validator\UniversalFactory $universalFactory, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Catalog\Model\ResourceModel\ConfigFactory $configFactory, \Magento\Catalog\Model\Product\TypeFactory $productTypeFactory, \Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory $groupCollectionFactory, \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Eav\Model\Config $eavConfig, ?\Magento\Framework\Serialize\SerializerInterface $serializer = null, $attributesForPreload = [])
    {
        $this->___init();
        parent::__construct($cache, $entityTypeFactory, $entityTypeCollectionFactory, $cacheState, $universalFactory, $scopeConfig, $configFactory, $productTypeFactory, $groupCollectionFactory, $setCollectionFactory, $storeManager, $eavConfig, $serializer, $attributesForPreload);
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreId($storeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setStoreId');
        return $pluginInfo ? $this->___callPlugins('setStoreId', func_get_args(), $pluginInfo) : parent::setStoreId($storeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStoreId');
        return $pluginInfo ? $this->___callPlugins('getStoreId', func_get_args(), $pluginInfo) : parent::getStoreId();
    }

    /**
     * {@inheritdoc}
     */
    public function loadAttributeSets()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'loadAttributeSets');
        return $pluginInfo ? $this->___callPlugins('loadAttributeSets', func_get_args(), $pluginInfo) : parent::loadAttributeSets();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeSetName($entityTypeId, $id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeSetName');
        return $pluginInfo ? $this->___callPlugins('getAttributeSetName', func_get_args(), $pluginInfo) : parent::getAttributeSetName($entityTypeId, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeSetId($entityTypeId, $name = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeSetId');
        return $pluginInfo ? $this->___callPlugins('getAttributeSetId', func_get_args(), $pluginInfo) : parent::getAttributeSetId($entityTypeId, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAttributeGroups()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'loadAttributeGroups');
        return $pluginInfo ? $this->___callPlugins('loadAttributeGroups', func_get_args(), $pluginInfo) : parent::loadAttributeGroups();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeGroupName($attributeSetId, $id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeGroupName');
        return $pluginInfo ? $this->___callPlugins('getAttributeGroupName', func_get_args(), $pluginInfo) : parent::getAttributeGroupName($attributeSetId, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeGroupId($attributeSetId, $name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeGroupId');
        return $pluginInfo ? $this->___callPlugins('getAttributeGroupId', func_get_args(), $pluginInfo) : parent::getAttributeGroupId($attributeSetId, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function loadProductTypes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'loadProductTypes');
        return $pluginInfo ? $this->___callPlugins('loadProductTypes', func_get_args(), $pluginInfo) : parent::loadProductTypes();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductTypeId($name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductTypeId');
        return $pluginInfo ? $this->___callPlugins('getProductTypeId', func_get_args(), $pluginInfo) : parent::getProductTypeId($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductTypeName($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductTypeName');
        return $pluginInfo ? $this->___callPlugins('getProductTypeName', func_get_args(), $pluginInfo) : parent::getProductTypeName($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getSourceOptionId($source, $value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSourceOptionId');
        return $pluginInfo ? $this->___callPlugins('getSourceOptionId', func_get_args(), $pluginInfo) : parent::getSourceOptionId($source, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductAttributes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductAttributes');
        return $pluginInfo ? $this->___callPlugins('getProductAttributes', func_get_args(), $pluginInfo) : parent::getProductAttributes();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributesUsedInProductListing()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributesUsedInProductListing');
        return $pluginInfo ? $this->___callPlugins('getAttributesUsedInProductListing', func_get_args(), $pluginInfo) : parent::getAttributesUsedInProductListing();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributesUsedForSortBy()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributesUsedForSortBy');
        return $pluginInfo ? $this->___callPlugins('getAttributesUsedForSortBy', func_get_args(), $pluginInfo) : parent::getAttributesUsedForSortBy();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeUsedForSortByArray()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeUsedForSortByArray');
        return $pluginInfo ? $this->___callPlugins('getAttributeUsedForSortByArray', func_get_args(), $pluginInfo) : parent::getAttributeUsedForSortByArray();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductListDefaultSortBy($store = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductListDefaultSortBy');
        return $pluginInfo ? $this->___callPlugins('getProductListDefaultSortBy', func_get_args(), $pluginInfo) : parent::getProductListDefaultSortBy($store);
    }

    /**
     * {@inheritdoc}
     */
    public function getCache()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCache');
        return $pluginInfo ? $this->___callPlugins('getCache', func_get_args(), $pluginInfo) : parent::getCache();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'clear');
        return $pluginInfo ? $this->___callPlugins('clear', func_get_args(), $pluginInfo) : parent::clear();
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isCacheEnabled');
        return $pluginInfo ? $this->___callPlugins('isCacheEnabled', func_get_args(), $pluginInfo) : parent::isCacheEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityType($code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityType');
        return $pluginInfo ? $this->___callPlugins('getEntityType', func_get_args(), $pluginInfo) : parent::getEntityType($code);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributes');
        return $pluginInfo ? $this->___callPlugins('getAttributes', func_get_args(), $pluginInfo) : parent::getAttributes($entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute($entityType, $code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttribute');
        return $pluginInfo ? $this->___callPlugins('getAttribute', func_get_args(), $pluginInfo) : parent::getAttribute($entityType, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityAttributeCodes($entityType, $object = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityAttributeCodes');
        return $pluginInfo ? $this->___callPlugins('getEntityAttributeCodes', func_get_args(), $pluginInfo) : parent::getEntityAttributeCodes($entityType, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityAttributes($entityType, $object = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityAttributes');
        return $pluginInfo ? $this->___callPlugins('getEntityAttributes', func_get_args(), $pluginInfo) : parent::getEntityAttributes($entityType, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function importAttributesData($entityType, array $attributes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'importAttributesData');
        return $pluginInfo ? $this->___callPlugins('importAttributesData', func_get_args(), $pluginInfo) : parent::importAttributesData($entityType, $attributes);
    }
}
