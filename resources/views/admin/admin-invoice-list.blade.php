@include('layouts.admin.header')


<!-- sa-app__body -->

	<div class="sa-app__body" id="top">
		<div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
			<div class="container">
				<div class="py-5">
					<div class="row g-4 align-items-center">
						<div class="col">
							
							<h1 class="h3 m-0">Invoice List</h1>
						</div>
						<!-- <div class="col-auto d-flex">
							<a class="btn btn-primary" href="app-order.html">New order</a>
						</div> -->
					</div>
				</div>
				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif
				<div class="card">
					<div class="p-4">
						<input class="form-control form-control--search mx-auto" id="table-search" placeholder="Start typing to search for orders" type="text">
					</div>
					<div class="sa-divider"></div>
					<table class="sa-datatables-init text-nowrap" data-order="[[ 1, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
						<thead>
							<tr>
								<!-- <th class="w-min" data-orderable="false"><input aria-label="..." class="form-check-input m-0 fs-exact-16 d-block" type="checkbox"></th> -->
								<th>ID</th>
								<th>Number</th>
								<th>Date</th>
								<th>Customer</th>
								<th>Paid</th>
								<th>Status</th>
								<th>Price</th>
								<th>Items</th>
								<th>Total</th>
								<th class="w-min" data-orderable="false"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($invoices as $invoice)
							<tr>
								<!-- <td><input aria-label="..." class="form-check-input m-0 fs-exact-16 d-block" type="checkbox"></td> -->
								<td>
									<a class="text-reset">{{$invoice->id}}</a>
								</td>
								<td>
									<a class="text-reset"># {{$invoice->invoice_number}}</a>
								</td>
								<td>{{$invoice->date}}</td>
								<td>
									<a class="text-reset">{{$invoice->order->user->name}}</a>
								</td>
								<td>
									<div class="d-flex fs-6">
										<div class="{{ $invoice->order->paid == 'yes' ? 'badge badge-sa-success' : 'badge badge-sa-danger' }}">
											{{$invoice->order->paid}}
										</div>
									</div>
								</td>
								<td>
									<div class="d-flex fs-6">
										<div class="{{ $invoice->order->status == 'Approved' ? 'badge badge-sa-success' : 'badge badge-sa-danger' }}">
											{{$invoice->order->status}}
										</div>
									</div>
								</td>
								<td>
									<div class="sa-price">
										<span class="sa-price__symbol">$</span><span class="sa-price__integer">{{$invoice->order->order_price}}</span><span class="sa-price__decimal">.00</span>
									</div>
								</td>
								<td>{{$invoice->order->item}}</td>
								<td>
									<div class="sa-price">
										<span class="sa-price__symbol">$</span><span class="sa-price__integer">{{$invoice->order->total}}</span><span class="sa-price__decimal">.00</span>
									</div>
								</td>
								<td>
									<div class="dropdown">
										<button aria-expanded="false" aria-label="More" class="btn btn-sa-muted btn-sm" data-bs-toggle="dropdown" id="order-context-menu-0" type="button"><svg height="13" width="3" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"></path></svg></button>
										<ul aria-labelledby="order-context-menu-0" class="dropdown-menu dropdown-menu-end">
											<li>
												<a class="dropdown-item" href="{{route('admin.invoice.show', $invoice->id)}}">Generate PDF</a>
											</li>
											<!-- <li>
												<hr class="dropdown-divider">
											</li>
											<li>
												<a class="dropdown-item text-danger" href="#">Delete</a>
											</li> -->
										</ul>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- sa-app__body / end -->



	@include('layouts.admin.footer')

</body>
</html>