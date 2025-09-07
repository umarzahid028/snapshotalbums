
@include('layouts.admin.header')

	<div class="sa-app__body" id="top">
		<div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
			<div class="container">
				<div class="py-5">
					<div class="row g-4 align-items-center">
						<div class="col">
							@foreach($products as $product)
						<form action="{{route('admin.product.update', $product->id)}}" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                @csrf
								@method('PUT')
							<h1 class="h3 m-0">Edit Product</h1>
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
										<h2 class="mb-0 fs-exact-18">Basic information</h2>
									</div>
									<div class="mb-4">
										<label class="form-label" for="form-product/name">Name</label>
										<input class="form-control" id="form-product/name" name="name" type="text" value="{{$product->name}}">
									</div>
									<div class="mb-4">
										<select name="category_id" id="nameid" class="form-control">
                                            <!-- <option value="{{$product->id}}">{{$product->category->name}}</option> -->
                                            @foreach($categories as $category)
                                            <!-- <option value="{{$category->id}}">{{$category->name}}</option> -->
											<option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
									</div>
									<div class="mb-4">
										<label class="form-label" for="form-product/slug">Slug</label>
										<div class="input-group input-group--sa-slug">
											<span class="input-group-text" id="form-product/slug-addon">https://example.com/products/</span>
												<input aria-describedby="form-product/slug-addon form-product/slug-help" name="slug" class="form-control" id="form-product/slug" type="text" value="{{$product->slug}}">
										</div>
										<div class="form-text" id="form-product/slug-help">
											Unique human-readable product identifier. No longer than 255 characters.
										</div>
									</div>
									<div class="mb-4">
										<label class="form-label" for="form-product/description">Description</label> 
										<!-- <textarea class="sa-quill-control  form-control"id="editor" name="content" rows="8">{{$product->desc}}</textarea> -->
										<textarea class="form-control" name="desc" id="form-product/short-description" rows="2">{{$product->desc}}</textarea>
									</div>
									<div>
										<label class="form-label" for="form-product/short-description">Short description</label> 
										<textarea class="form-control" name="short_desc" id="form-product/short-description" rows="2">{{$product->short_desc}}</textarea>
									</div>
								</div>
							</div>
							<div class="card mt-5">
								<div class="card-body p-5">
									<div class="mb-5">
										<h2 class="mb-0 fs-exact-18">Pricing</h2>
									</div>
									<div class="row g-4">
										<div class="col">
											<label class="form-label" for="form-product/price">Price For Retailer</label>
											<input class="form-control" name="P_for_retailer" value="{{$product->P_for_retailer}}" id="form-product/price" type="number" placeholder="1499">
										</div>
										<div class="col">
											<label class="form-label" for="form-product/price">Price For Distributor</label>
											<input class="form-control" name="P_for_distributor" value="{{$product->P_for_distributor}}" id="form-product/price" type="number" placeholder="1499">
										</div>
										<div class="col">
											<label class="form-label" for="form-product/old-price">price For Wholesaler</label>
											<input class="form-control" name="P_for_wholesaler" value="{{$product->P_for_wholesaler}}" id="form-product/old-price" type="number" placeholder="1499">
										</div>
									</div>
									
								</div>
							</div>
							<div class="card mt-5">
								<div class="card-body p-5">
									<div class="mb-5">
										<h2 class="mb-0 fs-exact-18">Inventory</h2>
									</div>
									<div class="mb-4">
										<label class="form-label" for="form-product/sku">SKU</label>
										<input class="form-control" name="sku" value="{{$product->sku}}" id="form-product/sku" type="text" value="SCREW150">
									</div>
									
									<div>
										<label class="form-label" for="form-product/quantity">Stock quantity</label>
										<input class="form-control" name="qty" value="{{$product->qty}}" id="form-product/quantity" type="number" value="18">
									</div>
								</div>
							</div>
							<div class="card mt-5">
								<div class="card-body p-5">
									<div class="mb-5">
										<h2 class="mb-0 fs-exact-18">Image</h2>
									</div>
									
									<div class="mb-4">
										<img  height="100" src="{{asset('storage/appproduct/'.$product->image)}}" alt="{{$product->image}}" width="100">
										<br>
										<label class="form-label" for="form-product/sku">Select Product Image</label>
										<input class="form-control" name="image" id="form-product/sku" type="file">
									</div>
									<div class="col-auto d-flex">
										<button class="btn btn-primary" type="submit">Upload</button>
									</div>
									
								</div>
							</div>
							
							
						</div>
						
					</div>
				</div>
			</form>
			@endforeach
			</div>
		</div>
	</div><!-- sa-app__body / end -->
	
	
	@include('layouts.admin.footer')

