@extends('layouts.app')

@push('page-css')
	<!-- Datatables CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Products</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Products</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('add-product')}}" class="btn btn-primary float-right mt-2">Add New</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
	
		<!-- Recent Orders -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="datatable table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Category</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Discount</th>
								<th>Expiry Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($products as $product)
							<tr>
								<td>
									<h2 class="table-avatar">
										@if(!empty($product->purchase->image))
										<span class="avatar avatar-sm mr-2">
											<img class="avatar-img" src="{{asset('storage/purchases/'.$product->purchase->image)}}" alt="product image">
										</span>
										@endif
										{{$product->purchase->name}}
									</h2>
								</td>
								<td>{{$product->purchase->category->name}}</td>
								<td>{{AppSettings::get('app_currency', '$')}} {{$product->price}}
								</td>
								<td>{{$product->purchase->quantity}}</td>
								<td>{{$product->discount}}%</td>
								<td>
								{{date_format(date_create($product->purchase->expiry_date),"d M, Y")}}</span>										
								</td>
								<td>
									<div class="actions">
										<a class="btn btn-sm bg-success-light" href="{{route('edit-product',$product)}}">
											<i class="fe fe-pencil"></i> Edit
										</a>
										<a data-id="{{$product->id}}" href="javascript:void(0);" class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
											<i class="fe fe-trash"></i> Delete
										</a>
									</div>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Recent Orders -->
		
	</div>
</div>

<!-- Delete Modal -->
<x-modals.delete :route="'products'" :title="'Product'" />
<!-- /Delete Modal -->
@endsection

@push('page-js')
	<!-- Datatables JS -->
	<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush