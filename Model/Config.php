<?php

namespace DavidRobert\AdvancedSorting\Model;

use \Magento\Catalog\Model\Config as ConfigCore;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\SerializerInterface;
use DavidRobert\AdvancedSorting\Helper\Data;

class Config extends ConfigCore
{

	/**
	 * @var Data
	 */
	protected $_dataHelper;

	public function __construct(
		\Magento\Framework\App\CacheInterface $cache,
		\Magento\Eav\Model\Entity\TypeFactory $entityTypeFactory,
		\Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory $entityTypeCollectionFactory,
		\Magento\Framework\App\Cache\StateInterface $cacheState,
		\Magento\Framework\Validator\UniversalFactory $universalFactory,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Catalog\Model\ResourceModel\ConfigFactory $configFactory,
		\Magento\Catalog\Model\Product\TypeFactory $productTypeFactory,
		\Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory $groupCollectionFactory,
		\Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setCollectionFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Eav\Model\Config $eavConfig,
		SerializerInterface $serializer = null,
		Data $dataHelper
	) {

		parent::__construct(
		$cache,
		$entityTypeFactory,
		$entityTypeCollectionFactory,
		$cacheState,
		$universalFactory,
		$scopeConfig,
		$configFactory,
		$productTypeFactory,
		$groupCollectionFactory,
		$setCollectionFactory,
		$storeManager,
		$eavConfig,
		$serializer
		);

		$this->_dataHelper = $dataHelper;
	}

	public function getAttributeUsedForSortByArray()
	{
		if ($this->_dataHelper->getAdvancedSortingConfig('sort_by_date')) {
			$options['created_at'] = __('New');
		}

		if ($this->_dataHelper->getAdvancedSortingConfig('sort_by_best_seller')) {
			$options['best_seller'] = __('Best seller');
		}

		foreach ($this->getAttributesUsedForSortBy() as $attribute) {
			/* @var $attribute \Magento\Eav\Model\Entity\Attribute\AbstractAttribute */
			$options[$attribute->getAttributeCode()] = $attribute->getStoreLabel();
		}

		if (!$this->_dataHelper->getAdvancedSortingConfig('sort_by_position')) {
			unset($options['position']);
		}

		if (!$this->_dataHelper->getAdvancedSortingConfig('sort_by_name')) {
			unset($options['name']);
		}

		if (!$this->_dataHelper->getAdvancedSortingConfig('sort_by_price')) {
			unset($options['price']);
		}

		return $options;
	}
}