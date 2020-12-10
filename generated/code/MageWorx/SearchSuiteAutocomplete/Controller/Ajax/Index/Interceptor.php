<?php
namespace MageWorx\SearchSuiteAutocomplete\Controller\Ajax\Index;

/**
 * Interceptor class for @see \MageWorx\SearchSuiteAutocomplete\Controller\Ajax\Index
 */
class Interceptor extends \MageWorx\SearchSuiteAutocomplete\Controller\Ajax\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SearchSuiteAutocomplete\Helper\Data $helperData, \Magento\Framework\App\Action\Context $context, \Magento\Search\Model\QueryFactory $queryFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \MageWorx\SearchSuiteAutocomplete\Model\Search $searchModel)
    {
        $this->___init();
        parent::__construct($helperData, $context, $queryFactory, $storeManager, $searchModel);
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
