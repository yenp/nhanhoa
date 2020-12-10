<?php
namespace Magento\Framework\Config\View;

/**
 * Interceptor class for @see \Magento\Framework\Config\View
 */
class Interceptor extends \Magento\Framework\Config\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Config\FileResolverInterface $fileResolver, \Magento\Framework\Config\ConverterInterface $converter, \Magento\Framework\Config\SchemaLocatorInterface $schemaLocator, \Magento\Framework\Config\ValidationStateInterface $validationState, $fileName, $idAttributes = [], $domDocumentClass = 'Magento\\Framework\\Config\\Dom', $defaultScope = 'global', $xpath = [])
    {
        $this->___init();
        parent::__construct($fileResolver, $converter, $schemaLocator, $validationState, $fileName, $idAttributes, $domDocumentClass, $defaultScope, $xpath);
    }

    /**
     * {@inheritdoc}
     */
    public function getVars($module)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVars');
        return $pluginInfo ? $this->___callPlugins('getVars', func_get_args(), $pluginInfo) : parent::getVars($module);
    }

    /**
     * {@inheritdoc}
     */
    public function getVarValue($module, $var)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVarValue');
        return $pluginInfo ? $this->___callPlugins('getVarValue', func_get_args(), $pluginInfo) : parent::getVarValue($module, $var);
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaEntities($module, $mediaType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMediaEntities');
        return $pluginInfo ? $this->___callPlugins('getMediaEntities', func_get_args(), $pluginInfo) : parent::getMediaEntities($module, $mediaType);
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaAttributes($module, $mediaType, $mediaId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMediaAttributes');
        return $pluginInfo ? $this->___callPlugins('getMediaAttributes', func_get_args(), $pluginInfo) : parent::getMediaAttributes($module, $mediaType, $mediaId);
    }

    /**
     * {@inheritdoc}
     */
    public function getExcludedFiles()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getExcludedFiles');
        return $pluginInfo ? $this->___callPlugins('getExcludedFiles', func_get_args(), $pluginInfo) : parent::getExcludedFiles();
    }

    /**
     * {@inheritdoc}
     */
    public function getExcludedDir()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getExcludedDir');
        return $pluginInfo ? $this->___callPlugins('getExcludedDir', func_get_args(), $pluginInfo) : parent::getExcludedDir();
    }

    /**
     * {@inheritdoc}
     */
    public function read($scope = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'read');
        return $pluginInfo ? $this->___callPlugins('read', func_get_args(), $pluginInfo) : parent::read($scope);
    }
}
