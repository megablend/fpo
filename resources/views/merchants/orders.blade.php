@extends('layouts.merchant')
@section('title', $title)
@section('extra_css_files')
  <link rel="stylesheet" href="{{ URL::asset('public/assets/datatables/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/datatables/dataTables.bootstrap.min.css') }}">
@endsection

<!-- Modals -->
@section('modals')
   <!-- Customer Profile Modal -->
  <div class="modal fade" id="customerProfileModal" tabindex="-1" role="dialog" aria-labelledby="customerProfileModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Customer Profile</h4>
            </div>
            <div class="modal-body">
                 <div class="row">
	                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" data-ng-if="activeCustomerProfile != null" src="<?php print URL::asset('{{ activeCustomerProfile.customer_identification_file[0].file_path }}'); ?>"> </div>
	                
	                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
	                  <dl>
	                    <dt>DEPARTMENT:</dt>
	                    <dd>Administrator</dd>
	                    <dt>HIRE DATE</dt>
	                    <dd>11/12/2013</dd>
	                    <dt>DATE OF BIRTH</dt>
	                       <dd>11/12/2013</dd>
	                    <dt>GENDER</dt>
	                    <dd>Male</dd>
	                  </dl>
	                </div>-->
	                <div class=" col-md-9 col-lg-9 "> 
	                  <table class="table table-user-information">
	                    <tbody>
	                      <tr>
	                        <td>Full Name:</td>
	                        <td>@{{ activeCustomerProfile.title + ' ' + activeCustomerProfile.surname + ' ' + activeCustomerProfile.first_name | capitalize:true }}</td>
	                      </tr>
	                      <tr>
	                        <td>Place of Birth:</td>
	                        <td>@{{ activeCustomerProfile.place_of_birth | capitalize }}</td>
	                      </tr>
	                      <tr>
	                        <td>Gender:</td>
	                        <td>@{{ activeCustomerProfile.sex | capitalize }}</td>
	                      </tr>
	                   
	              
	                      <tr>
	                        <td>Organisation:</td>
	                        <td>@{{ activeCustomerProfile.name_of_organisation | capitalize:true }}</td>
	                      </tr>
	                        <tr>
	                        <td>Unique Access ID:</td>
	                        <td><strong>@{{ activeCustomerProfile.unique_access_id == '' ? 'No Record' : activeCustomerProfile.unique_access_id }}</strong></td>
	                      </tr>
	                      <tr>
	                        <td>Email</td>
	                        <td>@{{ activeCustomerProfile.email != '' ? activeCustomerProfile.email : 'No Record' }}</td>
	                      </tr>
	                      <tr>
	                        <td>Phone Number</td>
	                        <td>@{{ activeCustomerProfile.phone_number }}
	                        </td>
	                           
	                      </tr>

	                      <tr>
	                        <td>Allowed Credit Limit</td>
	                        <td>@{{ activeCustomerProfile.credit_limit.credit_limit  | currency:'&#8358;' }}
	                        </td>
	                           
	                      </tr>
	                     
	                    </tbody>
	                  </table>
	                
	                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>

<!-- Token Modal -->
<div class="modal fade" id="orerTokenModal" tabindex="-1" role="dialog" aria-labelledby="orerTokenModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Process Order @{{ $root.orderCode }}</h4>
            </div>
            <div class="modal-body">
                 <div class="row">
	                  <div class="col-md-12">
                           <form action="#" no-validate class="form-horizontal" name="order.process" id="order-process">
								<div class="form-group">
									<div class="col-sm-9">
										<input type="number" data-ng-model="order.token" name="order_token" placeholder="Enter the token from the customer" id="control-demo-1" class="form-control" required>
										<span class="form-div-error" data-ng-cloak data-ng-show="order.process.order_token.$error.required && order.process.order_token.$dirty">** Please enter the token sent to the customer to process order</span>
									</div>
								</div><!-- .form-group -->
							</form>
	                  </div>
	              </div>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary" id="process-order" data-ng-click="completeOrderProcess($event)" data-ng-disabled="order.process.$invalid"><i class="zmdi zmdi-check-circle zmdi-hc-lg"></i> Process Order</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>

@endsection

@section('extra_js_files')  
  <script src="{{ URL::asset('public/assets/dataTables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/dataTables/dataTables.bootstrap.min.js') }}"></script>
  
  <script type="text/javascript">
      //datatables
      $('#default-datatable').DataTable();
  </script>
@endsection
@section('content')
<section class="app-content">
		<div class="row">
			<!-- DOM dataTable -->
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title">Orders</h4>
					</header><!-- .widget-header -->
					<!-- <hr class="widget-separator"> -->
					<div class="col-md-12" style="margin-top: 15px; margin-bottom: 15px; padding-top: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="exampleTextInput1" class="col-sm-2 control-label remove-col-padding">Search By Status</label>
								<div class="col-sm-2">
									<select class="form-control" data-ng-init="searchCriteria = {{ $active_order_status ? $active_order_status : 0 }}" data-ng-model="searchCriteria"  ng-change="searchParams('orders')">
										<option value="0">All</option>
										@foreach($orders_statuses AS $order_status)
                                           <option value="{{ $order_status->id }}" {{ $active_order_status ? 'selected' : null }}>{{ ucfirst($order_status->status_name) }}</option>
										@endforeach
									</select>
								</div>
							</div>
					    </form>
				    </div>
				    <hr>
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Order Code</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Customer ID</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Order Code</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Customer ID</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									@if($orders->count())
									   {{--*/ $counter = 1 /*--}}
                                       @foreach($orders AS $order)
                                           {{--*/ $total_amount = $order->amount * $order->quantity /*--}}
                                           <tr>
												<td>{{ $counter }}</td>
												<td>{{ $order->order_code }}</td>
												<td>{{ $order->description }}</td>
												<td>{{ '₦' . number_format($order->amount, 2) }}</td>
												<td>{{ $order->quantity }}</td>
												<td>{{ '₦' . number_format($total_amount, 2) }}</td>
												<td>{{ $order->customer->unique_access_id }}</td>
												<td><span id="order-status-{{ $order->id }}"  {{ $order->order_status->status_name == 'declined' ? 'class="text-dnager"' : null }}>{{ ucfirst($order->order_status->status_name) }}</span></td>
												<td>
		                                            <button type="button" class="btn mw-md btn-primary btn-xs make-smaller" data-ng-click="getCustomerProfile({{ $order->customer->id }}); $event.preventDefault()"><i class="zmdi zmdi-account-circle zmdi-hc-lg"></i> View Customer Profile</button>
		                                            @if($order->order_status->status_name == 'pending')
			                                            <button type="button" id="order-processing-{{ $order->id }}" class="btn mw-md btn-success btn-xs make-smaller" data-ng-click="processOrder({{ $order->id }}, '{{ $order->order_code }}')"><i class="zmdi zmdi-check-circle zmdi-hc-lg"></i> Process Order</button>
			                                            <button type="button" id="decline-order-{{ $order->id }}" class="btn mw-md btn-danger btn-xs make-smaller" data-ng-click="declineOrder({{ $order->id }}, '{{ $order->order_code }}')"><i class="zmdi zmdi-close-circle-o zmdi-hc-lg"></i> Decline Order</button>
		                                            @endif
												</td>
											</tr>
											{{--*/ $counter++; /*--}}
                                       @endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div><!-- .widget-body -->
					<div class="col-md-12" style="margin-top: 15px; margin-bottom: 15px; padding-top: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;">
						<form class="form-horizontal pull-right">
							<button type="button" class="btn btn-success btn-md" data-ng-click="downloadReport('{{ $active_order_status }}', 'orders')">Download Report</button>
					    </form>
				    </div>
				</div><!-- .widget -->
			</div><!-- END column -->
		
		</div><!-- .row -->
	</section><!-- .app-content -->
	@endsection