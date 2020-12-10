<?php
/**
 *
 * Copyright © 2017 Codazon, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codazon\ThemeLayoutPro\Controller\Adminhtml\Header;

use Magento\Backend\App\Action;

class Edit extends \Codazon\ThemeLayoutPro\Controller\Adminhtml\ThemeLayoutAbstract
{
	/**
	* Core registry
	*
	* @var \Magento\Framework\Registry
	*/
	protected $_coreRegistry = null;
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;
	
	public function __construct(
		Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Registry $registry
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $registry;
		parent::__construct($context);
	}
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Codazon_ThemeLayoutPro::header_edit');
    }
	protected function _initAction()
	{
		$resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Codazon_ThemeLayoutPro::header');
		return $resultPage;
	}
	public function execute()
	{
		$id = $this->getRequest()->getParam('header_id');
		$model = $this->_objectManager->create('Codazon\ThemeLayoutPro\Model\Header');
		
        if ($store = (int)$this->getRequest()->getParam('store')) {
            $model->setData('store_id', $store);
        }
		
        if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This header no longer exists.'));
				/** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
				$resultRedirect = $this->resultRedirectFactory->create();
				return $resultRedirect->setPath('*/*/');
			}
		}
	
		$data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
	
		$this->_coreRegistry->register('themelayout_header', $model);
	
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_initAction();
		$resultPage->addBreadcrumb(
			$id ? __('Edit Header') : __('New Header'),
			$id ? __('Edit Header') : __('New Header')
		);
		$resultPage->getConfig()->getTitle()->prepend(__('Header'));
		$resultPage->getConfig()->getTitle()
			->prepend($model->getId() ? $model->getTitle() : __('New Header'));
	
		return $resultPage;
	}
}
