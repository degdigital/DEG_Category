<?php

class DEG_SubcategoryView_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var Mage_Catalog_Model_Resource_Category_Collection|null
     */
    protected $_categoryCollection = null;

    /**
     * Returns the subcategories for the current category.
     *
     * @return Mage_Catalog_Model_Resource_Category_Collection
     */
    public function getCurrentSubcategories()
    {
        /* @var $layer Mage_Catalog_Model_Layer */
        /* @var $productCollection Mage_Catalog_Model_Resource_Product_Collection */

        if (!$this->_categoryCollection) {
            $layer = Mage::getSingleton('catalog/layer');
            $category = $layer->getCurrentCategory();

            if (!$category) {
                return $this->_categoryCollection = array();
            }

            $this->_categoryCollection = Mage::getResourceModel('catalog/category_collection');
            $this->_categoryCollection
                ->addAttributeToSelect(array('url_key', 'name', 'thumbnail', 'is_anchor'))
                ->addAttributeToFilter('is_active', 1)
                ->addIdFilter($category->getChildren())
                ->setOrder('position', Varien_Db_Select::SQL_ASC)
                ->joinUrlRewrite();

            $productCollection = Mage::getResourceModel('catalog/product_collection');
            $productCollection->addCountToCategories($this->_categoryCollection);
        }

        return $this->_categoryCollection;
    }

    /**
     * Returns the number of frontend-visible products for a category.
     *
     * @param Mage_Catalog_Model_Category $category
     * @return int
     */
    public function getVisibleProductCount($category)
    {
        /* @var $collection Mage_Catalog_Model_Resource_Product_Collection */

        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->addCategoryFilter($category);
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

        return $collection->getSize();
    }
}