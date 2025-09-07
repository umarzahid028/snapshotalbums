@include('admin.header')


<!-- sa-app__body -->

	<div class="sa-app__body" id="top">
		<div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
			<div class="container container--max--lg">
				<div class="py-5">
					<div class="row g-4 align-items-center">
						<div class="col">
							
							<h1 class="h3 m-0">General</h1>
						</div>
						<div class="col-auto d-flex">
							<!-- <a class="btn btn-secondary me-3" href="#">Reset</a> -->

							<a class="btn btn-primary" href="#">Save</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body p-5">
						<div class="mb-4">
							<label class="form-label" for="form-settings/name"> Name</label><input class="form-control" id="form-settings/name" type="text" value="Admin">
						</div>
						<div class="mb-4">
							<label class="form-label" for="form-settings/description"> Description</label> 
							<textarea class="form-control" id="form-settings/description" rows="4">Tools Store HTML eCommerce Template</textarea>
						</div>
						<div class="mb-n2">
							<label class="form-label" for="form-settings/email">Email Address</label><input aria-describedby="form-settings/email/help" class="form-control" id="form-settings/email" type="email" value="admin@example.com">
							<div class="form-text" id="form-settings/email/help">
								The contact email address of the store administrator.
							</div>
						</div>
						<div class="mb-n2">
							<label class="form-label" >Password</label>

							<input type="password" class="form-control" >
							
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div><!-- sa-app__body / end -->



@include('footer')

</body>
</html>