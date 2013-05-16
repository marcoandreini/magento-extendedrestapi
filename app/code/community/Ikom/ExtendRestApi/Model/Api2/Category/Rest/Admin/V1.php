<?php

/**
 * Override for Magento's Catalog REST API
 */
class Ikom_ExtendRestApi_Model_Api2_Category_Rest_Admin_V1 extends Mage_Catalog_Model_Api2_Product_Rest {

	/**
	 * Retrieve the category
	 * @return category entity
	 */
    protected function _retrieve() {
    	$category_id = $this->getRequest()->getParam('category_id');
        $category = Mage::getResourceModel('catalog/category')->load($category_id);
        // $store = $this->_getStore();
        // $category->setStoreId($store->getId());
		return $category;
    }

    /**
     * Retrieves the category collection and returns
     *
     * @return int
     */
     protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('catalog/category');
        $store = $this->_getStore();
        $collection->setStoreId($store->getId());
        $collection->addAttributeToSelect(array_keys(
                $this->getAvailableAttributes($this->getUserType(), Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)
        ));
        $this->_applyCategoryFilter($collection);
        $this->_applyCollectionModifiers($collection);
        $categories = $collection->load()->toArray();
        return $categories['items'];
    }
}

