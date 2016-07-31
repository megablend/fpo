<?php
namespace App\Classes;

use Illuminate\Http\Request;
use App\AdministratorsGroup;
use DB;
use SoapWrapper;
use Storage;
use App\Transaction;

class AdminHelper
{

   /**
    * Get all administrator groups
    * 
    * @return App\AdministratorsGroup
    * 
    */
   public function administratorGroups()
   {
      return AdministratorsGroup::where('status', true)->get();
   }

   /**
    * Get all administrator permissions
    * 
    */
   public function permissions(Request $request)
   {
   	  $permission = DB::table('administrators_permissions')
                      ->select('administrators_groups.*', 'administrators_tasks.*', 'administrators_modules.*')
                      ->join('administrators_groups', 'administrators_permissions.administrator_group_id', '=', 'administrators_groups.id')
                      ->join('administrators_tasks', 'administrators_permissions.administrator_task_id', '=', 'administrators_tasks.id')
                      ->join('administrators_modules', 'administrators_tasks.administrator_module_id', '=', 'administrators_modules.id')
                      ->where('administrators_tasks.task_status', true)
                      ->where('administrators_groups.id', $request->user()->administrator_group_id)
                      ->orderBy('administrators_modules.module_order')
                      ->get();
      return $permission;
   }

   /**
    * Define class patterns for the orders
    *
    * @return string
    * @param $order_status string
    * 
    */
   public function getOrderStatusClass($order_status)
   {
      $class = null;
      switch($order_status){
          case 'fulfilled':
             $class = 'success';
          break;

          case 'pending':
            $class = 'primary';
          break;

          case 'cancelled':
            $class = 'warning';
          break;

          case 'declined':
            $class = 'danger';
          break;
      }
      return (string) $class;
   }

   /**
    * Get all the amount due to a merchant
    * 
    */
   public function getTotalTransactionsForMerchant($transaction_type, $merchant_id)
   {
      switch($transaction_type){
          case 'due':
             $sum_of_escrow = Transaction::where('merchant_id', $merchant_id)->where('transaction_status', 'paid')->where('settlement_status', false)->get();
             return (float) $sum_of_escrow->sum('transaction_amount');
          break;

          case 'paid':
             $sum_of_paid_revenue = Transaction::where('merchant_id', $merchant_id)->where('transaction_status', 'paid')->where('settlement_status', true)->get();
             return (float) $sum_of_paid_revenue->sum('transaction_amount');
          break;

          case 'total':
             $sum_of_escrow = Transaction::where('merchant_id', $merchant_id)->where('transaction_status', 'paid')->where('settlement_status', false)->get();
             $sum_of_paid_revenue = Transaction::where('merchant_id', $request->session()->get('merchant_id'))->where('transaction_status', 'paid')->where('settlement_status', true)->get();
             $sum_of_escrow = $sum_of_escrow->count() > 0 ? $sum_of_escrow->sum('transaction_amount') : 0;
             $sum_of_paid_revenue = $sum_of_paid_revenue->count() > 0 ? $sum_of_paid_revenue->get('transaction_amount') : 0;
             $total = $sum_of_escrow + $sum_of_paid_revenue;
             return (float) $total;
          break;
      }
   }

   /**
    * Consume all SoapClient APIs
    *
    * @return void
    * @param \Illuminate\Http\Response
    * @param string $request_type
    * @param string $wsdl
    * 
    */
   public function soapApi(Request $reauest, $request_type, $wsdl)
   {
        // Add the settlement service to the wrapper
        SoapWrapper::add(function ($service) use($request_type, $wsdl) {
            $service->name($request_type)->wsdl($wsdl)->trace(true);
        });

        switch($request_type){
            case 'settlement':
                $file = Storage::get('schedule_files/test.xml');
                $data = ['XMLRequest' => $file];

                // Using the added service
                SoapWrapper::service($request_type, function ($service) use ($data, $file) {
                    // var_dump($service->getFunctions());
                    var_dump($service->call('uploadNewVendors', ['request' => $file]));
                });
            break;
        }
   }
}