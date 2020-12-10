<?php
/**
* Copyright © 2020 Codazon. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Codazon\ThemeLayoutPro\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;

class FixData extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $helper;
    
    protected $importHelper;
    
    const PATCH_FILE = 'fix_data.xml';
    
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Codazon\ThemeLayoutPro\Helper\Data $helper,
        \Codazon\Core\Helper\Import $importHelper
    ) {
        parent::__construct($context);
        $this->importHelper = $importHelper;
    }
    
    public function fixTemplate()
    {
        $objectManager = $this->importHelper->getObjectManager();
        $collection = $objectManager->get(\Codazon\ThemeLayoutPro\Model\ResourceModel\Template\Collection::class);
        $connection = $collection->getConnection();
        $connection->dropTable($collection->getTable('themelayout_template'));
        $connection->dropTable($collection->getTable('themelayout_template_set'));
        $this->createTemplateTables();
        $importModel = $objectManager->get(\Codazon\ThemeLayoutPro\Model\Import::class);
        $importModel->importTemplateSet();
        $importModel->importTemplate();
        return $this;
    }
    
    protected function createTemplateTables()
    {
        $setup = $this->importHelper->getObjectManager()->get(\Magento\Framework\Setup\SchemaSetupInterface::class);
        $connection = $setup->getConnection();
        /* Template Type Table */
        $table = $connection->newTable(
            $setup->getTable('themelayout_template_set')
        )->addColumn(
            'template_set_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['primary' => true, 'identity' => true, 'unsigned' => true, 'nullable' => false],
            'Set id'
        )->addColumn(
            'template_set_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Set name'
        )->addColumn(
            'template_set_image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Preview image'
        )->setComment(
            'Template set'
        );
        $connection->createTable($table);
        
        /* Template Table */
        $table = $connection->newTable(
            $setup->getTable('themelayout_template')
        )->addColumn(
            'template_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['primary' => true, 'identity' => true, 'unsigned' => true, 'nullable' => false],
            'Template id'
        )->addColumn(
            'template_set_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => true, 'unsigned' => true],
            'Template type'
        )->addColumn(
            'template_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Template Name'
        )->addColumn(
            'template_image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Preview image'
        )->addColumn(
            'content',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            ['nullable' => true],
            'Template content'
        )->addForeignKey(
            $setup->getFkName(
                'themelayout_template', 'template_set_id', 'themelayout_template_set', 'template_set_id'
            ),
            'template_set_id',
            $setup->getTable('themelayout_template_set'),
            'template_set_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Template'
        );
        $connection->createTable($table);
    }
    
    public function fixData()
    {
        $patchFile = $this->importHelper->getEtcXmlFilePath(self::PATCH_FILE, 'Codazon_ThemeLayoutPro');
        $patchList = $this->importHelper->getArrayFromXmlFile($patchFile);
        $objectManager = $this->importHelper->getObjectManager();
        
        $patchList = $patchList['patch_list']['item'];

        if (isset($patchList['process'])) {
            $patchList = [$patchList];
        }

        foreach ($patchList as $listItem) {
            $colClass = $listItem['collection'];
            $modelClass = $listItem['model'];
            $fieldToSelect = $listItem['field_to_select'];
            $attributeToSelect = $listItem['attribute_to_select'];
            $processes = $listItem['process']['item'];
            
            
            if (isset($processes['condition']) || isset($processes['patch'])) {
                $processes = [$processes];
            }
            
            foreach ($processes as $process) {
                $collection = $objectManager->create($colClass);
                $condition = isset($process['condition']) ? $process['condition'] : [];
                $patches = $process['patch']['item'];
                if (isset($patches['field'])) {
                    $patches = [$patches];
                }
                
                if ($fieldToSelect) {
                    $collection->addFieldToSelect(explode(',', $fieldToSelect));
                }
                if ($attributeToSelect) {
                    $collection->addAttributeToSelect(explode(',', $attributeToSelect));
                }
                if (!empty($condition['field'])) {
                    $collection->addFieldToFilter($condition['field'], $condition['value']);
                }
                if (!empty($condition['attribute'])) {
                    $collection->addAttributeToFilter($condition['attribute'], $condition['value']);
                }
                foreach ($collection as $itemModel) {
                    foreach ($patches as $patch) {
                        $model = $objectManager->create($modelClass)->setStore(0)->load($itemModel->getId());
                        $fieldValue = $model->getData($patch['field']);
                        if (strpos($fieldValue, $patch['search']) === false) {
                            if (isset($patch['not_exist'])) {
                                $fieldValue = str_replace($patch['not_exist']['search'], $patch['not_exist']['replace'], $fieldValue);
                                $model->setStoreId(0)->load($model->getId())->setData($patch['field'], $fieldValue)->save();
                            }
                        } else {
                            if (isset($patch['exist'])) {
                                $fieldValue = str_replace($patch['exist']['search'], $patch['exist']['replace'], $fieldValue);
                                $model->setStoreId(0)->load($model->getId())->setData($patch['field'], $fieldValue)->save();
                            }
                        }
                    }
                }
            }
        }
        return $this;
    }   
}