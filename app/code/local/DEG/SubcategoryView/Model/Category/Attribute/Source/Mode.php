<?php

class DEG_SubcategoryView_Model_Category_Attribute_Source_Mode
    extends Mage_Catalog_Model_Category_Attribute_Source_Mode
{
    const DM_SUBCATEGORY = 'SUBCATEGORY_LISTING';
    const DM_SUBCATEGORY_MIXED = 'SUBCATEGORY_LISTING_MIXED';

    /**
     * Adds a new display mode for categories for listing subcategories.
     *
     * @return array|null
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $options = parent::getAllOptions();
            $this->_options = array_merge($options, array(
                array(
                    'value' => self::DM_SUBCATEGORY_MIXED,
                    'label' => Mage::helper('catalog')->__('Static block and subcategory listing'),
                ),
                array(
                    'value' => self::DM_SUBCATEGORY,
                    'label' => Mage::helper('catalog')->__('Subcategory listing only'),
                )
            ));
        }

        return $this->_options;
    }
}