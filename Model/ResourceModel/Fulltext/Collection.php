<?php

namespace DavidRobert\AdvancedSorting\Model\ResourceModel\Fulltext;

use Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection as CollectionCore;

class Collection extends CollectionCore {

	function sortByBestSellers($dir) {

		$this->getSelect()->joinLeft(
			'sales_order_item',
			'e.entity_id = sales_order_item.product_id',
			array('qty_ordered'=>'SUM(sales_order_item.qty_ordered)'))
		     ->group('e.entity_id')
		     ->order('qty_ordered '.$dir);

	}

	function sortByNewest($dir) {

		$this->getSelect()
		     ->order('e.created_at '.$dir);

	}
}