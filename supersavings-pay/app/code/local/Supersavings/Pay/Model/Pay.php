<?php
class Supersavings_Pay_Model_Pay extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'pay';
	  /**
	     * Here are examples of flags that will determine functionality availability
	     * of this module to be used by frontend and backend.
	     *
	     * @see all flags and their defaults in Mage_Payment_Model_Method_Abstract
	     *
	     * It is possible to have a custom dynamic logic by overloading
	     * public function can* for each flag respectively
	     */
	     
	    /**
	     * Is this payment method a gateway (online auth/charge) ?
	     */
	    protected $_isGateway               = true;
 
	    /**
	     * Can authorize online?
	     */
	    protected $_canAuthorize            = true;
	 
	    /**
	     * Can capture funds online?
	     */
	    protected $_canCapture              = true;
	 
	    /**
	     * Can capture partial amounts online?
	     */
	    protected $_canCapturePartial       = true;
	 
	    /**
	     * Can refund online?
	     */
	    protected $_canRefund               = false;
	 
	    /**
	     * Can void transactions online?
	     */
	    protected $_canVoid                 = true;
	 
	    /**
	     * Can use this payment method in administration panel?
	     */
	    protected $_canUseInternal          = true;
	 
	    /**
	     * Can show this payment method as an option on checkout payment page?
	     */
	    protected $_canUseCheckout          = true;
	 
	    /**
	     * Is this payment method suitable for multi-shipping checkout?
	     */
	    protected $_canUseForMultishipping  = true;
	 
	    /**
	     * Can save credit card information for future processing?
	     */
	    protected $_canSaveCc = true;
	 
	    /**
	     * Here you will need to implement authorize, capture and void public methods
	     *
	     * @see examples of transaction specific public methods such as
	     * authorize, capture and void in Mage_Paygate_Model_Authorizenet
	     */
		  protected $_order;
		  protected $_config;
		  protected $_payment;
		  protected $_redirectUrl;
		  
		  
		  
			public function getOrder(){
			if (!$this->_order) {
				$this->_order = $this->getInfoInstance()->getOrder();
			}
			return $this->_order;
			}
	
	  
	    public function getCheckout() {

			$totalItems = Mage::getModel('checkout/cart')->getQuote()->getItemsCount();
			$subTotal = Mage::getModel('checkout/cart')->getQuote()->getSubtotal();
            $grandTotal = Mage::getModel('checkout/cart')->getQuote()->getGrandTotal();
			//$orderid = Mage::getSingleton(’checkout/session’)->getQuoteId();
			//return  $totalItems."~".$subTotal."~".$grandTotal."~".$orderid;
			$orderid="100000088";
			return  $totalItems."~".$subTotal."~".$grandTotal."~".$orderid;
		}	  

		public function getQuote() {
	
			$orderIncrementId = $this->getCheckout()->getLastRealOrderId();
			$order = Mage::getModel('checkout/cart')->loadByIncrementId($orderIncrementId);
			return $order;
		}


     public function getFormFields()
    {
        $order_id = $this->getOrder()->getRealOrderId();
        
        return $order_id;
    }
 

   

  public function getOrderPlaceRedirectUrl()
  {
  
     $ret= $this->getCheckout();
	
     //$params=  $this->getFormFields();
    // $final= $params."~".$ret;
    
	 return Mage::getUrl('redirect?PaymentID='.$ret, array('_secure' => true));
  } 
  
  




		 
}
?>
