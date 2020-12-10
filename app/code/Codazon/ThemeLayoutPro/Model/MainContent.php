<?php
/**
 *
 * Copyright © 2017 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Codazon\ThemeLayoutPro\Model;

class MainContent extends \Codazon\ThemeLayoutPro\Model\ThemeLayoutAbstract
{
    const ENTITY = 'themelayout_maincontent';
    
    const CACHE_TAG = 'themelayout_maincontent';
    
    protected $_projectPath = 'codazon/themelayout/main';
    protected $_mainFileName = 'main-styles.less.css';
    protected $_cssFileName = 'main-styles.css';
    protected $elementType = 'main';
    protected $primary = 'entity_id';
    protected $_defaultValues = null;
    private $scopeOverriddenValue = null;
    protected $_flexibleLessDir = 'codazon/themelayout/main/general/flexible';
    
    
    protected $_storeValuesFlags = [];
    const KEY_IS_USE_DEFAULT = 'is_use_default';
    
    protected function _construct()
    {
        $this->_init('Codazon\ThemeLayoutPro\Model\ResourceModel\MainContent');
    }
    
    
    
    
    private function getAttributeScopeOverriddenValue()
    {
        if ($this->scopeOverriddenValue === null) {
            $this->scopeOverriddenValue = \Magento\Framework\App\ObjectManager::getInstance()
                ->get('Codazon\ThemeLayoutPro\Model\Eav\ScopeOverriddenValue');
        }
        return $this->scopeOverriddenValue;
    }
    
    public function getResourceCollection()
    {
        $collection = parent::getResourceCollection()->setStoreId($this->getStoreId());
        return $collection;
    }
    

    
    public function setExistsStoreValueFlag($attributeCode)
    {
        $this->_storeValuesFlags[$attributeCode] = true;
        return $this;
    }
    
	public function getExistsStoreValueFlag($attributeCode)
    {
        return array_key_exists($attributeCode, $this->_storeValuesFlags);
    }
    
    
    
}