<?php
namespace Codazon\Lookbookpro\Controller\Router;

/**
 * Interceptor class for @see \Codazon\Lookbookpro\Controller\Router
 */
class Interceptor extends \Codazon\Lookbookpro\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Codazon\Lookbookpro\Model\ResourceModel\Lookbook\CollectionFactory $lookbookCollectionFactory, \Codazon\Lookbookpro\Model\ResourceModel\LookbookCategory\CollectionFactory $categoryCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->___init();
        parent::__construct($actionFactory, $lookbookCollectionFactory, $categoryCollectionFactory, $storeManager, $scopeConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
