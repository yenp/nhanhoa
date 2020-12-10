<?php
/**
* Copyright © 2018 Codazon. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Codazon\MegaMenu\Controller\Index;

class Ajax extends \Magento\Framework\App\Action\Action
{
    protected $menu;
    
	protected $resultLayoutFactory;
    
	public function __construct(
        \Magento\Framework\App\Action\Context $context,
		\Codazon\MegaMenu\Block\Widget\Megamenu $menu,
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
		$this->menu = $menu;
		$this->resultJsonFactory = $resultJsonFactory;
		parent::__construct($context);
		
    }
    
    public function execute()
    {
        $request = $this->getRequest();
        $resultJson = $this->resultJsonFactory->create();
        $result = [];
        $result['success'] = false;
        $result['html'] = null;
        if ($menu = $request->getParam('menu')) {
            $layout = $this->resultJsonFactory->create();
            $this->_view->getLayout()->createBlock('Magento\Framework\View\Element\FormKey', 'formkey');
            $this->menu->addData([
                'use_ajax_menu' => false,
                'paging_menu'   => $request->getParam('paging_menu', true)
            ]);
            $menu = $this->menu->setMenu($menu);
            if ($menu->getMenuObject()) {
                $result['success'] = true;
                $result['html'] = $menu->toHtml();
            }
        }
        return $resultJson->setJsonData(json_encode($result));
    }
}