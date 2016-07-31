@extends('layouts.merchant')
@section('title', $title)
@section('extra_css_files')
  <link rel="stylesheet" href="{{ URL::asset('public/assets/datatables/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('public/assets/datatables/dataTables.bootstrap.min.css') }}">
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
						<h4 class="widget-title">Transactions</h4>
					</header><!-- .widget-header -->
					<div class="col-md-12" style="margin-top: 15px; margin-bottom: 15px; padding-top: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="exampleTextInput1" class="col-sm-2 control-label remove-col-padding">Search By Status</label>
								<div class="col-sm-2">
									<select class="form-control" data-ng-init="searchCriteria = '{{ $active_transaction_status ? $active_transaction_status : 0 }}'" data-ng-model="searchCriteria"  ng-change="searchParams('transactions')">
										<option value="0">All</option>
										@foreach($transaction_statuses AS $transaction_status)
                                           <option value="{{ $transaction_status }}" {{ $active_transaction_status ? 'selected' : null }}>{{ ucfirst($transaction_status) }}</option>
										@endforeach
									</select>
								</div>
							</div>
					    </form>
				    </div>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Transaction Number</th>
										<th>Customer ID</th>
										<th>Order Code</th>
										<th>Amount</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Status</th>
										<th>Settlement Status</th>
										<!-- <th>Action</th> -->
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Transaction Number</th>
										<th>Customer ID</th>
										<th>Order Code</th>
										<th>Amount</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Status</th>
										<th>Settlement Status</th>
										<!-- <th>Action</th> -->
									</tr>
								</tfoot>
								<tbody>
									@if($transactions->count())
									   {{--*/ $counter = 1 /*--}}
                                       @foreach($transactions AS $transaction)
                                           {{--*/ $total_amount = $transaction->order->amount * $transaction->order->quantity /*--}}
                                           {{--*/ $settlement_status = $transaction->settlement_status ? 'Settled' : 'Pending' /*--}}
                                           {{--*/ $settlement_status_class = $transaction->settlement_status ? 'btn-primary' : 'btn-warning' /*--}}
                                           <tr>
												<td>{{ $counter }}</td>
												<td>{{ $transaction->transaction_no }}</td>
												<td>{{ $transaction->customer->unique_access_id }}</td>
												<td>{{ $transaction->order->order_code }}</td>
												<td>{{ '₦' . number_format($transaction->order->amount, 2) }}</td>
												<td>{{ $transaction->order->quantity }}</td>
												<td>{{ '₦' . number_format($total_amount, 2) }}</td>
												<td><span {{ $transaction->transaction_status == 'declined' ? 'class="text-dnager"' : null }}>{{ ucfirst($transaction->transaction_status) }}</span></td>
												<td><button href="javascript:void();" class="btn btn-xs btn-{{ $settlement_status_class }}">{{ $settlement_status }}</button></td>
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
							<button type="button" class="btn btn-success btn-md" data-ng-click="downloadReport('{{ $active_transaction_status }}', 'transactions')">Download Report</button>
					    </form>
				    </div>
				</div><!-- .widget -->
			</div><!-- END column -->
		
		</div><!-- .row -->
	</section><!-- .app-content -->
	@endsection