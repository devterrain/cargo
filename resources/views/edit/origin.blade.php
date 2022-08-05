@extends('layouts.master')
@section('title')
إضافة ميناء
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
							<h4 class="content-title mb-0 my-auto">إعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مصانع وجهات تحميل</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					@if (session()->has('Add'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>{{ session()->get('Add') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if (session()->has('edit'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>{{ session()->get('edit') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة جهة تحميل جديدة</a>
                                </div>
                            </div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">م</th>
												<th class="wd-15p border-bottom-0">جهة التحميل</th>
												<th class="wd-15p border-bottom-0">العنوان</th>
												<th class="wd-10p border-bottom-0">الهاتف</th>
												<th class="wd-20p border-bottom-0">ملاحظات</th>
												<td>تعديل البيانات</td>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0; ?>
											@foreach ($origins as $origin)
											<?php $i++; ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$origin->origin_name}}</td>
												<td>{{$origin->origin_address}}</td>
												<td>{{$origin->origin_phone}}</td>
												<td>{{$origin->origin_notes}}</td>
												<td>
													<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $origin->id }}" data-origin_name="{{ $origin->origin_name }}"
                                                       data-origin_address="{{ $origin->origin_address }}" data-origin_phone="{{ $origin->origin_phone }}"
													   data-origin_notes="{{ $origin->origin_notes }}" data-toggle="modal" href="#exampleModal2"
                                                       title="بيانات جهة التحميل"><i class="las la-pen"></i></a>
												</td>
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
			</div>
			<!-- Container closed -->
			<div class="modal" id="modaldemo8">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">جهة تحميل جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal"
								type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('origin.store') }}" method="post">
								@csrf
								<div class="form-group">
									<label for="text">اسم جهة التحميل</label>
									<input type="text" class="form-control" id="origin_name" name="origin_name" required>
								</div>
								<div class="form-group">
									<label for="text">العنوان</label>
									<input type="text" class="form-control" id="origin_address" name="origin_address">
								</div>
								<div class="form-group">
									<label for="text">الهاتف</label>
									<input type="text" class="form-control" id="origin_phone" name="origin_phone">
								</div>
								<div class="form-group">
									<label for="text">ملاحظات</label>
									<textarea class="form-control" id="origin_notes" name="origin_notes"></textarea>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">تاكيد</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
				   <div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">تعديل بيانات المقطورة</h6><button aria-label="Close" class="close" data-dismiss="modal"
								type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="origin/update" method="post">
								{{method_field('patch')}}
								@csrf
								<div class="form-group">
									<input type="hidden" name="id" id="id" value="">
									<label for="text">اسم جهة التحميل</label>
									<input type="text" class="form-control" id="origin_name" name="origin_name" required>
								</div>
								<div class="form-group">
									<label for="text">العنوان</label>
									<input type="text" class="form-control" id="origin_address" name="origin_address">
								</div>
								<div class="form-group">
									<label for="text">الهاتف</label>
									<input type="text" class="form-control" id="origin_phone" name="origin_phone">
								</div>
								<div class="form-group">
									<label for="text">ملاحظات</label>
									<textarea class="form-control" id="origin_notes" name="origin_notes"></textarea>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">تاكيد</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
								</div>
							</form>
						</div>
					</div>
				   </div>
				   
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
<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var origin_name = button.data('origin_name')
		var origin_address = button.data('origin_address')
		var origin_phone = button.data('origin_phone')
		var origin_notes = button.data('origin_notes')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #origin_name').val(origin_name);
		modal.find('.modal-body #origin_address').val(origin_address);
		modal.find('.modal-body #origin_phone').val(origin_phone);
		modal.find('.modal-body #origin_notes').val(origin_notes);
	})
</script>
@endsection