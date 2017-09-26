<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Paypalpayment;
class paypalController extends BaseController {

    
    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
     private $_apiContext;
     
         public function __construct()
         {
     
             
             $this->_apiContext = Paypalpayment::ApiContext('AdzFxl4isIqGiTdjLyItPw5ztimbwe8-w49xg01zbCYTVxyPa3ogbtupsysqzwOg_eeyOSJzD0L14P2n','EKutjhr1jFsXniNCLEHzigP8r2v6hqDQ17B6N0-XiutFkpaYxWRGAcOSor8jT1n8JZ-mdRqQh9NVYjxU');
             
     
         }


    public function index2()
    {
        echo "<pre>";

        $payments = Paypalpayment::getAll(array('count' => 1, 'start_index' => 0), $this->_apiContext);

        dd($payments);
    }
           /*
    * Display form to process payment using credit card
    */
    public function index3()
    {
        return View::make('payment.order');
    }

    /*
    * Process payment using credit card
    */
    public function index()
    {
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $addr= Paypalpayment::address();
        $addr->setLine1("3909 Witmer Road");
        $addr->setLine2("Niagara Falls");
        $addr->setCity("Niagara Falls");
        $addr->setState("NY");
        $addr->setPostalCode("14305");
        $addr->setCountryCode("US");
        $addr->setPhone("716-298-1822");

        // ### CreditCard
      /*  $card = Paypalpayment::creditCard();
        $card->setType("visa")
            ->setNumber("4758411877817150")
            ->setExpireMonth("05")
            ->setExpireYear("2019")
            ->setCvv2("456")
            ->setFirstName("Joe")
            ->setLastName("Shopper");
        */
        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        //$fi = Paypalpayment::fundingInstrument();
       // $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");
        
        //->setFundingInstruments(array($fi));

        $item1 = Paypalpayment::item();
  

        $item2 = Paypalpayment::item();
        $item1->setName('Ground Coffee 40 oz')
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku("123123") // Similar to `item_number` in Classic API
        ->setPrice(7.5);
        
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);
        

        $itemList = Paypalpayment::itemList();
        $itemList->setItems(array($item1,$item2));
/*

        $details = Paypalpayment::details();
        $details->setShipping("1.2")
                ->setTax("1.3")
                //total of items prices
                ->setSubtotal("17.5");

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal("20")
                ->setDetails($details);
*/
        $details = Paypalpayment::details();
        
        $details->setShipping(1.2)
        ->setTax(1.3)
        ->setSubtotal(17.50);
    
        

        //Payment Amount
        $amount = Paypalpayment::amount();
        
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);
        
        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());
        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        //$baseUrl = 'http://unitedcompanyweb.com';
        $baseUrl = url('/');
        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
            ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");
        
        $payment = Paypalpayment::payment();
       
        $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));
    

        $request = clone $payment;
            
        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create($this->_apiContext);
            
        } catch (\PayPal\Exception\PayPalConnectionException $pce) {
            echo $pce->getCode(); 
            echo $pce->getData();
            // Don't spit out errors or use "exit" like this in production code
            echo '<pre>';print_r(json_decode($pce->getData()));exit;
        }
        $approvalUrl = $payment->getApprovalLink();
        dd($approvalUrl);
    } 
          
}
