<?php
namespace Magento\Catalog\Model\Product\Image\UrlBuilder;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Product\Image\UrlBuilder
 */
class Interceptor extends \Magento\Catalog\Model\Product\Image\UrlBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\ConfigInterface $presentationConfig, \Magento\Catalog\Model\Product\Image\ParamsBuilder $imageParamsBuilder, \Magento\Catalog\Model\View\Asset\ImageFactory $viewAssetImageFactory, \Magento\Catalog\Model\View\Asset\PlaceholderFactory $placeholderFactory)
    {
        $this->___init();
        parent::__construct($presentationConfig, $imageParamsBuilder, $viewAssetImageFactory, $placeholderFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl(string $baseFilePath, string $imageDisplayArea) : string
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrl');
        return $pluginInfo ? $this->___callPlugins('getUrl', func_get_args(), $pluginInfo) : parent::getUrl($baseFilePath, $imageDisplayArea);
    }
}
