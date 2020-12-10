<?php
namespace Codazon\Shopbybrandpro\Controller\Index\SearchBrands;

/**
 * Interceptor class for @see \Codazon\Shopbybrandpro\Controller\Index\SearchBrands
 */
class Interceptor extends \Codazon\Shopbybrandpro\Controller\Index\SearchBrands implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Codazon\Shopbybrandpro\Model\BrandFactory $brandFactory, \Codazon\Shopbybrandpro\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $storeManager, $resultLayoutFactory, $brandFactory, $helper);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl($urlKey, $params = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrl');
        return $pluginInfo ? $this->___callPlugins('getUrl', func_get_args(), $pluginInfo) : parent::getUrl($urlKey, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllBrandsArray($query = false, $orderBy = 'brand_label', $order = 'asc')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAllBrandsArray');
        return $pluginInfo ? $this->___callPlugins('getAllBrandsArray', func_get_args(), $pluginInfo) : parent::getAllBrandsArray($query, $orderBy, $order);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getThumbnailImage($brand, array $options = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getThumbnailImage');
        return $pluginInfo ? $this->___callPlugins('getThumbnailImage', func_get_args(), $pluginInfo) : parent::getThumbnailImage($brand, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }

    /**
     * {@inheritdoc}
     */
    public function getActionFlag()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getActionFlag');
        return $pluginInfo ? $this->___callPlugins('getActionFlag', func_get_args(), $pluginInfo) : parent::getActionFlag();
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRequest');
        return $pluginInfo ? $this->___callPlugins('getRequest', func_get_args(), $pluginInfo) : parent::getRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResponse');
        return $pluginInfo ? $this->___callPlugins('getResponse', func_get_args(), $pluginInfo) : parent::getResponse();
    }
}
