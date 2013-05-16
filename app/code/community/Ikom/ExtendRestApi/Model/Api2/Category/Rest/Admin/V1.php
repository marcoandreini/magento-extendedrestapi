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
    	Mage::log("categories retrieve called");
    	$category_id = $this->getRequest()->getParam('id');
        $category = Mage::getResourceModel('catalog/category')->load($category_id);
        // $store = $this->_getStore();
        // $category->setStoreId($store->getId());

        $data = array();
    	$data['category_id'] = $category_id;
    	$data['name'] = $category->getName();
    	$data['parent_id'] = $category->getParentId();
    	$data['child_id'] = array(); // TODO: $subcats
    	$data['active'] = $category->getIsActive() ? 1 : 0;
    	$data['level'] = $category->getLevel();
    	$data['position'] = $category->getPosition();
    	return $data;
    }

    /**
     * Retrieves the category collection and returns
     *
     * @return int
     */
     protected function _retrieveCollection() {
     	Mage::log("categories retrieve collection called");
        $collection = Mage::getResourceModel('catalog/category')->getCollection();
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

