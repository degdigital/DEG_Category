<?php
/**
 * Allows a category to display subcategories rather than products if configured to do so
 */
class DEG_SubcategoryView_Block_View extends Mage_Catalog_Block_Category_View
{
    /**
     * Returns true if the category's display mode is set to Subcategory Listing.
     *
     * @return bool
     */
    public function isSubcategoryMode()
    {
        return $this->getCurrentCategory()->getDisplayMode() == DEG_SubcategoryView_Model_Category_Attribute_Source_Mode::DM_SUBCATEGORY;
    }

    public function isSubcategoryMixedMode()
    {
        return $this->getCurrentCategory()->getDisplayMode() == DEG_SubcategoryView_Model_Category_Attribute_Source_Mode::DM_SUBCATEGORY_MIXED;

    }

    /**
     * @return string
     */
    public function getSubcategoryListHtml()
    {
        return $this->getChildHtml('subcategory_list');
    }

    /**
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
}
