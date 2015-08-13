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
}