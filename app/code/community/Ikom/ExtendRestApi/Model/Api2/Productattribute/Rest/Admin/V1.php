<?php

/**
 * Override for Magento's Catalog REST API
 */
class Ikom_ExtendRestApi_Model_Api2_Productattribute_Rest_Admin_V1 extends Mage_Api2_Model_Resource {

	/**
	 * Retrieve the attribute options
	 * @return attribute options
	 */
    protected function _retrieve() {
    	$id =  $this->getRequest()->getParam('id');
    	$attribute = Mage::getModel('catalog/product')->getResource()->getAttribute($id);
    	$options = $attribute->getSource()->getAllOptions(true, true);
    	$data = array();
    	$data["id"] = $id;
    	$data["options"] = array();
    	foreach ($options as $instance) {
    		if ($instance['value']) {
    			$data["options"][$instance['value']] = $instance['label'];
    		}
    	}
    	return $data;
    }

    /**
     * TODO
     *
     * @return int
     */
    protected function _retrieveCollection() {
    }
}

