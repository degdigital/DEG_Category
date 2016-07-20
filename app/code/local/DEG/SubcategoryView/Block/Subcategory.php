<?php
/**
 * Subcategory Listing
 */
class DEG_SubcategoryView_Block_Subcategory extends Mage_Core_Block_Template
{
    protected $_helper = null;

    /**
     * @return DEG_SubcategoryView_Helper_Data
     */
    protected function _getHelper()
    {
        if (!$this->_helper) {
            $this->_helper = Mage::helper('DEG_SubcategoryView');
        }
        return $this->_helper;
    }

    /**
     * Returns the subcategories for the current category.
     *
     * @return Mage_Catalog_Model_Resource_Category_Collection
     */
    public function getCurrentSubcategories()
    {
        return $this->_getHelper()->getCurrentSubcategories();
    }

    /**
     * Returns the number of frontend-visible products for a category.
     *
     * @param Mage_Catalog_Model_Category $category
     * @return int
     */
    public function getVisibleProductCount($category)
    {
        return $this->_getHelper()->getVisibleProductCount($category);
    }

    /**
     * Gets the current Layer
     *
     * @return Mage_Catalog_Model_Layer
     */
    protected function getLayer()
    {
        if (Mage::helper('enterprise_search')->getIsEngineAvailableForNavigation()) {
            return Mage::getSingleton('enterprise_search/catalog_layer');
        } else {
            return Mage::getSingleton('catalog/layer');
        }
    }

    /**
     * Returns all of the visible products and their attributes for a given category.
     * @param $category
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    public function getVisibleProductCollection($category){
        $layer = $this->getLayer();
        $layer->setCurrentCategory($category);
        return $layer->getProductCollection();
    }

    /**
     * Gets the product URL without the hierarchical category information.
     *
     * @param $product
     * @return mixed
     */
    public function getProductUrlWithoutCategory($product){
        return Mage::getResourceSingleton('catalog/product')->getAttributeRawValue($product->getId(), 'url_key', Mage::app()->getStore());
    }

}