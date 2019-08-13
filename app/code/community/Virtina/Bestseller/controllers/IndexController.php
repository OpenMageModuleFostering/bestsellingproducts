<?php
/**
 * Virtina
 * @package    Virtina_Bestseller
 * @copyright  Copyright (c) 2015-2016 Virtina. (http://www.virtina.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Virtina_Bestseller_IndexController extends Mage_Core_Controller_Front_Action{

   public function indexAction() {

		$this->loadLayout();     
		$this->renderLayout();
		
   }
   
}
?>
