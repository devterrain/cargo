@extends('layouts.master')
@section('title')
معدات شحن وتفريغ
@endsection
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
							<h4 class="content-title mb-0 my-auto">معدات شحن وتفريغ</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المعدات</span>
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

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
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
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">جدول المعدات الخاصة بعمليات الشحن والتفريغ</h4>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-warning btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة معدة جديدة</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">م</th>
												<th class="wd-15p border-bottom-0">رقم المعدة</th>
                                                <th class="wd-15p border-bottom-0">تصنيف المعدة</th>
                                                <th class="wd-15p border-bottom-0">النوع</th>
                                                <th class="wd-15p border-bottom-0">الموديل</th>
												<th class="wd-15p border-bottom-0">مقاول الشحن</th>
												<th class="wd-15p border-bottom-0">ملاحظات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($loaders as $loader)
											<tr>
												<td>{{$loader->id}}</td>
												<td>{{$loader->loader_num}}</td>
                                                <td>{{$loader->equipment_type}}</td>
                                                <td>{{$loader->type}}</td>
                                                <td>{{$loader->model}}</td>
												<td>{{$loader->shipingcontractor->SCName}}</td>
												<td>{{$loader->loader_notes}}</td>
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
				<div class="modal" id="modaldemo8">
					<div class="modal-dialog" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">اضافة معدة جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form action="{{ route('loader.store') }}" method="post">
									@csrf
									<div class="form-group">
										<label for="text">رقم المعدة</label>
										<input type="number" class="form-control form-control-lg" id="loader_num" name="loader_num" min="1">
									</div>
                                    <div class="form-group">
                                        <label for="text">تصنيف المعدة</label>
                                        <select name="equipment_type" id="equipment_type" class="form-control form-control-lg">
                                            <option disable selected>حدد تصنيف المعدة</option>
                                                <option value="لودر">لودر</option>
                                                <option value="جرار">سير</option>
                                                <option value="حفار">حفار</option>
                                                <option value="جرار">جرار</option>
                                        </select>
                                    </div>
									<div class="form-group">
										<label for="text">مقاول الشحن</label>
										<select name="shiping_contractor_id" id="shiping_contractor_id" class="form-control form-control-lg">
											<option disable selected>--حدد مقاول الشحن والتفريغ--</option>
										@foreach($shipingcontractors as $shipingcontractor)
											<option value="{{ $shipingcontractor->id}}">{{ $shipingcontractor->SCName}}</option>
										@endforeach
										</select>
									</div>
                                    <div class="form-group">
                                        <label for="text">النوع</label>
                                        <input type="text" class="form-control form-control-lg" id="type" name="type">
                                    </div>
                                    <div class="form-group">
                                        <label for="text">الموديل</label>
                                        <input type="text" class="form-control form-control-lg" id="model" name="model">
                                    </div>
									<div class="form-group">
										<label for="text">ملاحظات</label>
										<textarea class="form-control form-control-lg" id="loader_notes" name="loader_notes" rows="3"></textarea>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">تاكيد إضافة معدة</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal effects-->
			<!-- Container closed -->
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
