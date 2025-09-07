@include('layouts.admin.header')

	<div class="sa-app__body" id="top">
		<div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
			<div class="container">
				<div class="py-5">
					<div class="row g-4 align-items-center">
						<div class="col">
							
						<form method="POST" action="{{ route('admin.settings.store') }}" class="signin-form">
                     	 @csrf
							<h1 class="h3 m-0">Settings</h1>
						</div>
						
					</div>
				</div>
				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif
				<div class="sa-entity-layout" data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
					<div class="sa-entity-layout__body">
						<div class="sa-entity-layout__main">
							<div class="card">
								<div class="card-body p-5">
									<div class="mb-5">
										<h2 class="mb-0 fs-exact-18">Settings</h2>
									</div>

									<div class="mb-4">
										<label class="form-label" for="form-product/name">Change Password</label>
										<input name="password" class="form-control" value="" id="form-product/name" type="password" placeholder="" required>
									</div>
									<div class="col-auto d-flex">
										<button class="btn btn-primary" type="submit">Update</button>
									</div>
								</div>
							</div>
							
							
						</div>
						
					</div>
				</div>
			</form>
			</div>
		</div>
	</div><!-- sa-app__body / end -->
	@include('layouts.admin.footer')
