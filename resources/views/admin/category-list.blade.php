@include('layouts.admin.header')


<!-- sa-app__body -->


	<div class="sa-app__body" id="top">
		<div class="mx-xxl-3 px-4 px-sm-5">
			<div class="py-5">
				<div class="row g-4 align-items-center">
					<div class="col">
						
						<h1 class="h3 m-0">Category</h1>
					</div>
					<div class="col-auto d-flex">
						<a class="btn btn-primary" href="{{route('admin.category.create')}}">New Category</a>
					</div>
				</div>
			</div>
		</div>
		@if(session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif
		<div class="mx-xxl-3 px-4 px-sm-5 pb-6">
			<div class="sa-layout">
				
				<div class="sa-layout__content">
					<div class="card">
						<div class="p-4">
							<div class="row g-4">
								<!-- <div class="col-auto sa-layout__filters-button">
									<button class="btn btn-sa-muted btn-sa-icon fs-exact-16" data-sa-layout-sidebar-open=""><svg height="1em" viewbox="0 0 16 16" width="1em" xmlns="http://www.w3.org/2000/svg">
									<path d="M7,14v-2h9v2H7z M14,7h2v2h-2V7z M12.5,6C12.8,6,13,6.2,13,6.5v3c0,0.3-0.2,0.5-0.5,0.5h-2 C10.2,10,10,9.8,10,9.5v-3C10,6.2,10.2,6,10.5,6H12.5z M7,2h9v2H7V2z M5.5,5h-2C3.2,5,3,4.8,3,4.5v-3C3,1.2,3.2,1,3.5,1h2 C5.8,1,6,1.2,6,1.5v3C6,4.8,5.8,5,5.5,5z M0,2h2v2H0V2z M9,9H0V7h9V9z M2,14H0v-2h2V14z M3.5,11h2C5.8,11,6,11.2,6,11.5v3 C6,14.8,5.8,15,5.5,15h-2C3.2,15,3,14.8,3,14.5v-3C3,11.2,3.2,11,3.5,11z"></path></svg></button>
								</div> -->
								<div class="col">
									<input class="form-control form-control--search mx-auto" id="table-search" placeholder="Start typing to search for products" type="text">
								</div>
							</div>
						</div>
						<div class="sa-divider"></div>
						<table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]" data-sa-search-input="#table-search">
							<thead>
								<tr>
									<!-- <th class="w-min" data-orderable="false"><input aria-label="..." class="form-check-input m-0 fs-exact-16 d-block" type="checkbox"></th> -->
									<th>Category</th>
									<th class="w-min" data-orderable="false"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<!-- <td><input aria-label="..." class="form-check-input m-0 fs-exact-16 d-block" type="checkbox"></td> -->
									
									<td>
										<a class="text-reset" href="app-category.html">{{$category->name}}</a>
									</td>
									
									<td>
										<div class="dropdown">
											<button aria-expanded="false" aria-label="More" class="btn btn-sa-muted btn-sm" data-bs-toggle="dropdown" id="product-context-menu-0" type="button"><svg height="13" width="3" xmlns="http://www.w3.org/2000/svg">
											<path d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"></path></svg></button>
											<ul aria-labelledby="product-context-menu-0" class="dropdown-menu dropdown-menu-end">
												<li>
													<a class="dropdown-item" href="{{route('admin.category.edit', $category->id)}}">Edit</a>
												</li>
												<li>
													<hr class="dropdown-divider">
												</li>
												<li>
													<!-- <a class="dropdown-item text-danger" href="#">Delete</a> -->
													
													<form action="{{route('admin.category.destroy', $category->id)}}" method="POST" class="">
														@method('delete')
														@csrf
														<button class="dropdown-item text-danger" onclick="return confirm('Are you sure wants to delete?')"><span data-feather=""></span>Delete</button>
													</form>
													
												</li>
											</ul>
										</div>
									</td>
								</tr>
								@endforeach
								<!--  -->
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div><!-- sa-app__body / end -->

	


	@include('layouts.admin.footer')

</body>
</html>