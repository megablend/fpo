<?php

namespace App\Classes;

use App\State;
use App\Customer;
use App\CreditLimitLog;
use App\CommissionPercentage;
use App\OrderHistory;
use Illuminate\Http\Request;
use App\ProductsCategory;
use App\OrdersStatus;
use App\Merchant;
use DB;

class Helper
{
    /**
     * Return all ids of the states table
     *
     * @return string
     */
    public function statesIds()
    {
    	$states = State::all();
    	$allStates = [];

    	foreach($states AS $state)
    	{
    		$allStates[] = $state->id;
    	}

    	return (string) implode($allStates, ', ');

    }

    /** 
     * Return all ids of the products categories table
     *
     * @return string
     */
    public function productsCatgoriesIds()
    {
        $product_categories = ProductsCategory::all();
        $all_products_categories = [];

        foreach($product_categories AS $product_category)
        {
            $all_products_categories[] = $product_category->id;
        }

        return (string) implode($all_products_categories, ', ');
    }

    /**
     * Return credit limit status
     *
     * @return boolean
     * @param \Illuminate\Http\Request
     * @param array $cart
     * 
     */
    public function checkCreditLimitAmount(Request $request, array $cart)
    {
       $customer_credit_limit = CreditLimitLog::where('customer_id', $request->session()->get('customer_id'))->orderBy('id', 'desc')->first();
       if(!$customer_credit_limit){
          $customer = Customer::find($request->session()->get('customer_id'));
          $customer_credit_limit = (float) $customer->credit_limit->credit_limit;
       }
       else{
         $customer_credit_limit = (float) $customer_credit_limit->current_credit_limit;
       }
       // return $customer_credit_limit;
       $total_amount_in_cart = 0;

       foreach($cart AS $item){
          $total_amount_in_cart += (float) ($item->item_amount * $item->item_quantity);
       }

       //mark up with the new order commission percentage
       $total_amount_in_cart += $this->getOrderCommission($total_amount_in_cart);

       return (bool) ($total_amount_in_cart > $customer_credit_limit ? true : false);
    }

    /**
     * Get the commission for the total items in cart
     *
     * @return float
     * @param float $total_amount_in_cart
     * 
     */
    public function getOrderCommission($total_amount_in_cart)
    {
       $commission_percentage = (float) (CommissionPercentage::orderBy('id', 'desc')->first()->commission_percentage/100);
       $order_commission = $total_amount_in_cart * $commission_percentage;

       return $order_commission;
    }

    /**
     * Calculate the total order commission
     *
     * @return float
     * @param float $sub_total 
     * @param int $commission_percentage
     * 
     */
    public function orderCommission($sub_total, $commission_percentage)
    {
        $commission_percentage = (float) ($commission_percentage / 100);
        return (float) $sub_total * $commission_percentage;
    }

    /**
     * Update Order History
     *
     * @return void
     * @param string $order_code
     * @param array $amounts
     * 
     */
    public function addOrderHistory($order_code, $customer_id, array $amounts)
    {
        foreach($amounts AS $amount => $status){
            $order_history = new OrderHistory;
            $order_history->order_code = $order_code;
            $order_history->order_total = $amount;
            $order_history->customer_id = $customer_id;
            $order_history->order_status = $status;

            $order_history->save();
        }
    }

    /**
     * Get order previous total
     *
     * @return float
     * @param float $order_total
     * 
     */
    public function getPreviousTotal($order_total, $order_commission_percentage)
    {
        $total = $order_total + $this->orderCommission($order_total, $order_commission_percentage);

        return (float) $total;
    }

    /**
     * Get order total plus commission
     *
     * @return float
     * @param float $sub_total 
     * @param float $commission
     * 
     */
    public function getOrderTotal($sub_total, $commission)
    {
        return (float) $sub_total + $commission;
    }

    /**
     * Get commission percentage
     *
     * @return float
     * 
     */
    public function commissionPercentage()
    {
        return (float) CommissionPercentage::orderBy('id', 'desc')->first()->commission_percentage;
    }

    /**
     * Show invoice status
     *
     * @return string
     * @param int $order_status
     * 
     */
    public function invoiceStatus($order_status)
    {
        switch($order_status){
             case 1:
               return 'Unpaid';
             break;

             case 2:
               return 'Paid';
             break;

             case 3:
             case 5:
               return 'Cancelled';
             break;

             default:
               return 'Unpaid';
             break;
        }
    }

    /**
     * Get the order status of an order
     * 
     */
    public function getOrderStatus($order_id)
    {
       
    }

    /**
     * Update Cart Item
     *
     * @return float
     * @param Object $cart_items
     * @param int $merchant_id
     * @param string $desc
     * @param int $quantity
     * 
     */
    public function updateCartItem($cart_items, $merchant_id, $desc, $quantity)
    {
        //loop through the cart items
        foreach($cart_items AS $item){
            if($item->merchant_id == $merchant_id && $item->item_description == $desc){
                $item->item_quantity = $quantity;
                break;
            }
        }

        //update session
        // $request->session()->put('cart', $cart_items);
        // return (float) $this->cartTotal($cart_items);
        return $cart_items;
    }

    /**
     * Delete Cart Item
     *
     * @return float
     * @param Illuminate\Http\Request $request
     * @param int $merchant_id
     * @param string $desc
     * @param int $quantity
     * 
     */
    public function deleteCartItem(Request $request, $merchant_id, $desc)
    {
        $cart_items = $request->session()->get('cart');

        //loop through the cart items
        foreach($cart_items AS $key => $item){
            if($item->merchant_id == $merchant_id && $item->item_description == $desc){
                unset($cart_items[$key]);
                break;
            }
        }

        //update session
        $request->session()->put('cart', $cart_items);
        return (float) $this->cartTotal($cart_items);
    }

    /**
     * Generate Order Code
     *
     * @return string
     * @param int $length
     * 
     */
    public function generateOrderCode($randStringLength = 12)
    {
        $timestring = microtime();
        $secondsSinceEpoch=(integer) substr($timestring, strrpos($timestring, " "), 100);
        $microseconds=(double) $timestring;
        $seed = mt_rand(0,1000000000) + 10000000 * $microseconds + $secondsSinceEpoch;
        mt_srand($seed);
        $randstring = "";

        for($i=0; $i < $randStringLength; $i++){
        $randstring .= mt_rand(0, 9);
        }
        
        //return code
        return (string) "T" . $randstring;
    }

    /**
     * Generate Transaction
     *
     * @return string
     * @param int $length
     * 
     */
    public function generateTransactionNumber($randStringLength = 12)
    {
        $timestring = microtime();
        $secondsSinceEpoch=(integer) substr($timestring, strrpos($timestring, " "), 100);
        $microseconds=(double) $timestring;
        $seed = mt_rand(0,1000000000) + 10000000 * $microseconds + $secondsSinceEpoch;
        mt_srand($seed);
        $randstring = "";

        for($i=0; $i < $randStringLength; $i++){
        $randstring .= mt_rand(0, 9);
        }
        
        //return code
        return (string) $randstring;
    }

    /**
     *  Return cart details
     *
     *  @return float 
     *  @param Object $cart_items
     *  
     */
    public function cartTotal($cart_items)
    {
        $total = 0;
        foreach($cart_items AS $item){
            $item_total = $item->item_quantity * $item->item_amount;
            $total += $item_total;
        }

        //return total
        return $total;
    }

    /**
     *  Check if an item already exists in the database
     *
     * @return boolean
     * @param \Illuminate\Http\Request
     * @param array $cart
     * @param string $item
     * 
     */
    public function validateCartItem(Request $request, array $cart, array $params)
    {
         $merchant_id = $request->session()->get('selected_merchant');
         $result = false;

         if(count($cart)){
             foreach($cart AS $item){
                if($item->merchant_id == $merchant_id && $item->item_description == $params['description']){
                    $result = true;
                    break;
                }
             }
         }

         return (bool) $result;
    }

    /**
     * Return customer account details
     *
     * @return object
     */
    public function customerDetails(Request $request)
    {
       $customer_id = $request->session()->get('customer_id');
       $customer = Customer::find($customer_id);
       
       //return customer details
       return $customer;
    }

    /**
     * Check if this is signed in
     *
     * @return boolean
     */
    public function isSignedIn(Request $request)
    {
        return (bool) ($request->session()->has('customer_id') && $request->session()->get('customer_id') != '' && $request->session()->has('completed_step') && $request->session()->get('completed_step') == 4);
    }

    /**
     * Get Customer credit limit
     *
     * @return float
     * @param int $salary
     * 
     */
    public function getCreditLimit($salary)
    {
        $credit_limit = floatval($salary) * 0.30;
        return (float) $credit_limit;
    }

    /**
     * Sign in a customer
     * 
     * @return boolean
     */
    public function signin($phoneNumber, $password)
    {
       
    }


    /**
     * Return a capitalised string
     *
     * @return string
     * @param string $string 
     */
    public function capitalize($string)
    {
        return ucwords(strtolower($string));
    }

    /**
     * Check Customers Phone Number
     *
     * @return object
     * @param Request $request
     */
    public function checkCustomerPhoneNumber(Request $request)
    {

    }

    /**
     * Generate random string for the app
     *
     * @return string
     * @param int $length
     */
    public function generateRandString($length = 7)
    {
        $key = "";
            $possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";         
            $i = 0;   
            while ($i < $length) 
            { 
              $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
              if (!strstr($key, $char)) { 
                $key .= $char;
                $i++;
              }
            }
            
            //return key
            return (string) $key;
    }

    /**
     * Send SMS verification to customer
     * 
     * @return void
     * @param string $customer_phone_number
     * @param string $message
     */
    public function sendSMS($customer_phone_number, $message)
    {
        $message = $message;
        $un = 'paychoicepp_code';
        $up = 'qD0}hM6]aZ8*cK4{';
        $msg = stripslashes($message);
        $recipient = '234' . ltrim($customer_phone_number, '0');
        $sender = 'TRADESTORE';

        /* production of the required URL */
        $url = "http://www.mysmslink.com/sms_send_out.php?"
                . "un=$un"
                . "&up=" . urlencode($up)
                . "&recipient=" . urlencode($recipient)     //A comma-separated list of phone numbers in international format
                . "&sender=" . urlencode($sender)           //The sender name to use
                . "&msg=" . urlencode($msg);                //The actual SMS body
        if (($f = @fopen($url, "r")))
        {
            $sendResponse = fgets($f, 255);
        } else $sendResponse = 0;
        return $sendResponse;
    }

    /**
     * Redirect the user no matter what. No need to use a return
     * statement. Also avoids the trap put in place by the Blade Compiler.
     *
     * @param string $url
     * @param int $code http code for the redirect (should be 302 or 301)
     */
    public function swiftredirect($url, $code = 302)
    {
        try {
            abort($code, '', ['Location' => $url]);
        } catch (\Exception $exception) {
            // the blade compiler catches exceptions and rethrows them
            // as ErrorExceptions :(
            //
            // also the __toString() magic method cannot throw exceptions
            // in that case also we need to manually call the exception
            // handler
            $previousErrorHandler = set_exception_handler(function () {
            });
            restore_error_handler();
            call_user_func($previousErrorHandler, $exception);
            die;
        }
    }
    
    
//======================================================= BANKORK ========================================================    
    /**
     * Check if this merchant signed in
     *
     * @return boolean
     */
    public function isSignedInMerchant(Request $request)
    {
        return (bool) ($request->session()->has('merchant_id') && $request->session()->get('merchant_id') != '' && $request->session()->has('merchant_completed_step') && $request->session()->get('merchant_completed_step') == 4);
    }
    
     /**
     * Return merchant order details
     *
     * @return object
     */
    public function merchantOrderDetails(Request $request)
    {
       $merchantorders = DB::table('merchants')
                  ->select(DB::raw('merchants.id,merchants.business_name,orders.customer_id,customers.title,customers.surname,customers.first_name,orders.order_code,SUM(orders.amount) as order_total,orders.updated_at'))
                  ->join('orders', 'orders.merchant_id', '=', 'merchants.id')
                  ->join('customers', 'customers.id', '=', 'orders.customer_id')
                  ->where('merchants.id', $request->session()->get('merchant_id'))
                  ->groupBy('orders.order_code')  
                  ->orderBy('orders.updated_at','DESC')  
                  ->orderBy('orders.order_code')
                  ->get();
       
       //return merchant order details
       return $merchantorders;
    }

    public function GenerateTransactionID($randStringLength) {
        $timestring = microtime();
        $secondsSinceEpoch=(integer) substr($timestring, strrpos($timestring, " "), 100);
        $microseconds=(double) $timestring;
        $seed = mt_rand(0,1000000000) + 10000000 * $microseconds + $secondsSinceEpoch;
        mt_srand($seed);
        $randstring = "";
        for($i=0; $i < $randStringLength; $i++){
        $randstring .= mt_rand(0, 9);
        }
        return($randstring);
    } 
    
    public function insertAtPosition($string, $insert, $position) {
        return implode($insert, str_split($string, $position));
    }
}
