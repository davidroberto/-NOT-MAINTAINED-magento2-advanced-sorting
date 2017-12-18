<?php

namespace DavidRobert\AdvancedSorting\Block\Product\ProductList;

use \Magento\Catalog\Block\Product\ProductList\Toolbar as ToolbarCore;

class Toolbar extends ToolbarCore
{
	public function setCollection($collection)
	{
		if($this->getCurrentOrder()=="best_seller") {
			$collection->sortByBestSellers($this->getCurrentDirectionReverse());
		} else if($this->getCurrentOrder()=="created_at") {
			$collection->sortByNewest($this->getCurrentDirectionReverse());
		}

		$this->_collection = $collection;

		$this->_collection->setCurPage($this->getCurrentPage());

		$limit = (int)$this->getLimit();
		if ($limit) {
			$this->_collection->setPageSize($limit);
		}
		if ($this->getCurrentOrder()) {
			$this->_collection->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
		}
		return $this;
	}

	public function getCurrentDirectionReverse() {
		if ($this->getCurrentDirection() == 'asc') {
			return 'desc';
		} elseif ($this->getCurrentDirection() == 'desc') {
			return 'asc';
		} else {
			return $this->getCurrentDirection();
		}
	}

}