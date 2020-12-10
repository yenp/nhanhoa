<?php
/**
 * Copyright © 2017 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Config edit page
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Codazon\ThemeLayoutPro\Block\Adminhtml\Config;

use \Magento\Framework\App\ObjectManager;
use \Magento\Framework\Serialize\Serializer\Json;
/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Edit extends \Magento\Backend\Block\Widget
{
    const DEFAULT_SECTION_BLOCK = 'Codazon\ThemeLayoutPro\Block\Adminhtml\Config\Form';

    /**
     * Form block class name
     *
     * @var string
     */
    protected $_formBlockName;

    /**
     * Block template File
     *
     * @var string
     */
    protected $_template = 'Magento_Config::system/config/edit.phtml';

    /**
     * Configuration structure
     *
     * @var \Magento\Config\Model\Config\Structure
     */
    protected $_configStructure;

    
    private $jsonSerializer;
    
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Config\Model\Config\Structure $configStructure
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Config\Model\Config\Structure $configStructure,
        array $data = []
    ) {
        $this->_configStructure = $configStructure;
        $this->jsonSerializer = ObjectManager::getInstance()->get(Json::class);
        parent::__construct($context, $data);
    }

    /**
     * Prepare layout object
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        /** @var $section \Magento\Config\Model\Config\Structure\Element\Section */
        
        $section = $this->_configStructure->getElement($this->getRequest()->getParam('section'));
        
        $this->_formBlockName = $section->getFrontendModel();
        if (empty($this->_formBlockName)) {
            $this->_formBlockName = self::DEFAULT_SECTION_BLOCK;
        }
        $this->setTitle($section->getLabel());
        $this->setHeaderCss($section->getHeaderCss());

        $this->getToolbar()->addChild(
            'save_button',
            'Magento\Backend\Block\Widget\Button',
            [
                'id' => 'save',
                'label' => __('Save Config'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save', 'target' => '#config-edit-form']],
                ]
            ]
        );
        $this->getToolbar()->addChild(
            'back_button',
            'Magento\Backend\Block\Widget\Button',
            [
                'id' => 'back',
                'label' => __('Back to Theme List'),
                'class' => 'back',
                'on_click' => sprintf("location.href = '%s';",
                    $this->getUrl('*/config/index', ['_current' => ['website', 'store']])
                ),
            ]
        );
        $block = $this->getLayout()->createBlock($this->_formBlockName);
        $this->setChild('form', $block);
        return parent::_prepareLayout();
    }

    /**
     * Retrieve rendered save buttons
     *
     * @return string
     */
    public function getSaveButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }

    /**
     * Retrieve config save url
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/config/save', ['_current' => true]);
    }
    
    public function getConfigSearchParamsJson()
    {
        $params = [];
        if ($this->getRequest()->getParam('section')) {
            $params['section'] = $this->getRequest()->getParam('section');
        }
        if ($this->getRequest()->getParam('group')) {
            $params['group'] = $this->getRequest()->getParam('group');
        }
        if ($this->getRequest()->getParam('field')) {
            $params['field'] = $this->getRequest()->getParam('field');
        }
        return $this->jsonSerializer->serialize($params);
    }
}
