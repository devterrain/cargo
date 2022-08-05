@extends('layouts.master')
@section('title')
إضافة مخزن
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">مخزن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مخازن</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mg-b-20"">
							<div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة مخزن جديد</a>
                                </div>
                            </div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-10p border-bottom-0">م</th>
												<th class="wd-25p border-bottom-0">المخزن</th>
												<th class="wd-15p border-bottom-0">الكمية الافتتاحية</th>
												<th class="wd-15p border-bottom-0">السعة</th>
												<th class="wd-10p border-bottom-0">الحالة</th>
												<th class="wd-25p border-bottom-0"><p class="text-info"> نسبة البضاعة بالمخزن </p></th>
												<th class="wd-20p border-bottom-0">ملاحظات</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0; ?>
											@foreach ($stores as $store)
											<?php $i++; ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$store->store_name}}</td>
												<td>{{$store->store_quat}}</td>
												<td>{{$store->store_capacity}}</td>
												<td>{{$store->active}}</td>
												<td><p class="text-info"> {{$store->store_quat / $store->store_capacity * 100}} <strong>%</strong> </p></td>
												<td>{{$store->store_notes}}</td>
											</tr>
											@endforeach

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			<!-- Container closed -->
			<div class="modal" id="modaldemo8">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">اضافة مخزن جديد</h6><button aria-label="Close" class="close" data-dismiss="modal"
								type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('store.store') }}" method="post">
								@csrf
								<div class="form-group">
									<label for="text">المخزن</label>
									<input type="text" class="form-control" id="store_name" name="store_name">
								</div>
								<div class="form-group">
									<label for="text">الكمية الافتتاحية</label>
									<input type="number" class="form-control" id="store_quat" name="store_quat" step="0.001" pattern="^\d*(\.\d{0,3})?$" min="0" value="0">
								</div>
								<div class="form-group">
									<label for="text">السعة</label>
									<input type="number" class="form-control" id="store_capacity" name="store_capacity" step="0.001" pattern="^\d*(\.\d{0,3})?$" min="0" value="0">
								</div>
								<div class="form-group">
									<label for="text">ملاحظات</label>
									<textarea class="form-control" id="store_notes" name="store_notes"></textarea>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">تاكيد</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<!-- End Modal effects-->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
