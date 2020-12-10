<?php
/**
 * Copyright © 2017 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codazon\ThemeLayoutPro\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

use Magento\Eav\Model\Entity\Attribute;
use Magento\Eav\Model\Entity\AttributeFactory;
use Magento\Eav\Model\AttributeManagement;
use Magento\Eav\Model\Entity\Attribute\Group;
use Magento\Eav\Model\Entity\Attribute\GroupFactory;
use Magento\Eav\Model\Entity\Attribute\Set;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Eav\Model\Entity\TypeFactory;

class UpgradeData implements UpgradeDataInterface {
    
    private $mainContentSetupFactory;
    
    protected $objectManager;
    
    private $eavSetupFactory;
    
    protected $attributeSetFactory;
    
    protected $eavTypeFactory;
    
    protected $attributeGroupFactory;
    
    protected $attributeFactory;

    public function __construct(
        \Codazon\ThemeLayoutPro\Setup\MainContentSetupFactory $mainContentSetupFactory,
        EavSetupFactory $eavSetupFactory,
        AttributeFactory $attributeFactory,
        SetFactory $attributeSetFactory,
        GroupFactory $attributeGroupFactory,
        TypeFactory $typeFactory,
        AttributeManagement $attributeManagement
    ) {
        $this->mainContentSetupFactory = $mainContentSetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        
        $this->attributeFactory = $attributeFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->eavTypeFactory = $typeFactory;
        $this->attributeGroupFactory = $attributeGroupFactory;
        $this->attributeManagement = $attributeManagement;
    }
    
    
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        $attributeCode = 'codazon_custom_tab';
        $attributeGroupCode = 'content';
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
           
        $eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			$attributeCode,
			[
				'type' => 'text',
				'backend' => '',
				'frontend' => '',
				'label' => 'Product Custom Tab',
				'input' => 'textarea',
				'class' => '',
				'source' => '',
				'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
				'visible' => true,
				'required' => false,
				'user_defined' => true,
				'default' => '',
				'searchable' => false,
				'filterable' => false,
				'comparable' => false,
				'visible_on_front' => false,
				'used_in_product_listing' => true,
				'unique' => false,
				'apply_to' => '',
                'wysiwyg_enabled' => true
			]
		);
        
        $entityType = $this->eavTypeFactory->create()->loadByCode('catalog_product');
        $attribute = $this->attributeFactory->create()->loadByCode($entityType->getId(), $attributeCode);
        if ($attribute->getId()) {
            $setCollection = $this->attributeSetFactory->create()->getCollection();
            $setCollection->addFieldToFilter('entity_type_id', $entityType->getId());
            foreach ($setCollection as $attributeSet) {
                $group = $this->attributeGroupFactory->create()->getCollection()
                    ->addFieldToFilter('attribute_group_code', ['eq' => $attributeGroupCode])
                    ->addFieldToFilter('attribute_set_id', ['eq' => $attributeSet->getId()])
                    ->getFirstItem();
                $groupId = $group->getId() ?: $attributeSet->getDefaultGroupId();
                
                if (!$groupId) {
                    $group = $this->attributeGroupFactory->create()->getCollection()
                        ->addFieldToFilter('attribute_set_id', ['eq' => $attributeSet->getId()])
                        ->getFirstItem();
                    $groupId = $group->getId() ?: $attributeSet->getDefaultGroupId();
                }
                
                if ($groupId) {
                    $this->attributeManagement->assign(
                        'catalog_product',
                        $attributeSet->getId(),
                        $groupId,
                        $attributeCode,
                        $attributeSet->getCollection()->count() * 10
                    );
                }
            }
        }
        
        /* Fix data from old version */
        $this->objectManager->get(\Codazon\ThemeLayoutPro\Helper\FixData::class)->fixData();
        
        $setup->endSetup();
    }
    
}