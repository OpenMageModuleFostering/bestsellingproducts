<?php
/**
 * Virtina
 * @package    Virtina_Bestseller
 * @copyright  Copyright (c) 2015-2016 Virtina. (http://www.virtina.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Virtina_Bestseller_Block_Bestseller extends Mage_Catalog_Block_Product_Abstract
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
	/**
     * Best selling products
     *
     * @return array
     */
    public function getProducts()
    { 
        $storeId = Mage::app()->getStore()->getId();
		$cateids = $this->getData('cat_ids');
		$arr_catid = explode(",", $cateids);
		if($cateids != null)    
            {  
        $arr_productids = $this->getProductByCategory();
        $products = Mage::getResourceModel('reports/product_collection')
            ->addPdtOrderedQty()
            ->addAttributeToSelect('*')           
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc');
        $products->joinField('category_id',
                    'catalog/category_product',
                    'category_id',
                    'product_id=entity_id',
                    null,
                    'left');     
        $products->addAttributeToFilter('category_id', array('in' => $arr_catid));
        
        }
        else {
        $products = Mage::getResourceModel('reports/product_collection')
            ->addPdtOrderedQty()
            ->addAttributeToSelect('*')           
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc'); // most best sellers on top
        }
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize(10)->setCurPage(1);
        $this->setProductCollection($products);
    }
        
    
}
