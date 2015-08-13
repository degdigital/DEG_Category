<?php
class DEG_SubcategoryView_Model_Observer
{
    public function addLayoutUpdate(Varien_Event_Observer $observer)
    {
        /* @var $category Mage_Catalog_Model_Category */

        if(Mage::app()->getRequest()->getControllerName() != 'category') {
            return;
        }

        $category = Mage::registry('current_category');
        if($category && $category->getId()) {
            if(in_array($category->getDisplayMode(), $this->_getSubcategoryDisplayModes())) {
                Mage::app()->getLayout()->getUpdate()->addHandle('catalog_category_subcategory_listing');
            }
        }
    }

    protected function _getSubcategoryDisplayModes()
    {
        return array(
            DEG_SubcategoryView_Model_Category_Attribute_Source_Mode::DM_SUBCATEGORY,
            DEG_SubcategoryView_Model_Category_Attribute_Source_Mode::DM_SUBCATEGORY_MIXED
        );
    }
}