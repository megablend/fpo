<?php
namespace App\Classes;

use Illuminate\Http\Request;
use App\AdministratorsGroup;
use App\Merchant;
use App\MerchantsFile;
use App\Transaction;
use Helper as DefaultHelper;
use DB;
use URL;

class MerchantsHelper
{

   /**
    * Get merchant profile name
    * 
    * @return App\AdministratorsGroup
    * 
    */
   public function businessName(Request $request)
   {
      if($request->session()->has('merchant_id')){
         $merchant = Merchant::find($request->session()->get('merchant_id'));
         return DefaultHelper::capitalize($merchant->business_name);
      }
      else{
         return 'Unknown Merchant';
      }
   }

   /**
    * Check if 
    */

   /**
     * Return merchant account details
     *
     * @return object
     */
    public function merchantDetails(Request $request)
    {
       $merchant_id = $request->session()->get('merchant_id');
       $merchant = Merchant::find($merchant_id);
       
       //return merchant details
       return $merchant;
    }

    /**
     * Return Merchant Logo
     *
     * @return string
     * 
     */
    public function logo(Request $request)
    {
        // $merchant_logo = MerchantsFile::where('merchant_id', $request->session()->get('merchant_id'))->where('file_name', 'logo')->first();
        return (string) URL::asset('public/merchants/assets/images/icons/default-icon.png');
    }

    /**
     * Order details for the dashboard
     *
     * @return integer
     * @param $request \Illuminate\Http\Request
     * @param string $information_type
     * 
     */
    public function dashboardOrderDetails(Request $request, $information_type)
    {
       $transactions = Transaction::where('merchant_id', $request->session()->get('merchant_id'))->where('transaction_status', $information_type)->get();
       return $transactions->count();
    }

    /**
     * Transaction Summary
     *
     * @return float
     * @param $request \IIlluminate\Http\Response
     * @param $payment_type string
     * 
     */
    public function transactionSummary(Request $request, $payment_type)
    {
       switch($payment_type){
          case 'escrow':
             $sum_of_escrow = Transaction::where('merchant_id', $request->session()->get('merchant_id'))->where('transaction_status', 'paid')->where('settlement_status', false)->get();
             return $sum_of_escrow->count() > 0 ? number_format($sum_of_escrow->sum('transaction_amount'), 2) : '0.00';
          break;

          case 'paid_revenue':
             $sum_of_paid_revenue = Transaction::where('merchant_id', $request->session()->get('merchant_id'))->where('transaction_status', 'paid')->where('settlement_status', true)->get();
             return $sum_of_paid_revenue->count() > 0 ? number_format($sum_of_paid_revenue->sum('transaction_amount'), 2) : '0.00';
          break;

          case 'total_revenue':
             $sum_of_escrow = Transaction::where('merchant_id', $request->session()->get('merchant_id'))->where('transaction_status', 'paid')->where('settlement_status', false)->get();
             $sum_of_paid_revenue = Transaction::where('merchant_id', $request->session()->get('merchant_id'))->where('transaction_status', 'paid')->where('settlement_status', true)->get();
             $sum_of_escrow = $sum_of_escrow->count() > 0 ? $sum_of_escrow->sum('transaction_amount') : 0;
             $sum_of_paid_revenue = $sum_of_paid_revenue->count() > 0 ? $sum_of_paid_revenue->get('transaction_amount') : 0;
             $total = $sum_of_escrow + $sum_of_paid_revenue;
             return number_format($total, 2);
          break;
       }
    }

    /**
     * Generate OTP Code
     *
     * @return string
     * @param int $length
     * 
     */
    public function generateOTP($randStringLength = 6)
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
     * Generate password token 
     *
     * @return string
     * @param int $length
     */
    public function generatePasswordToken($length = 32)
    {
        $key = "";
            $possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";         
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
}