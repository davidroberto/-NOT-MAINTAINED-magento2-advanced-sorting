<?php

namespace DavidRobert\AdvancedSorting\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

	const XML_PATH_HOME = 'catalog/advanced_sorting/';

	public function __construct(Context $context) {
		parent::__construct($context);
	}

	public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}


	public function getAdvancedSortingConfig($code, $storeId = null)
	{
		return $this->getConfigValue(self::XML_PATH_HOME . $code, $storeId);
	}


}