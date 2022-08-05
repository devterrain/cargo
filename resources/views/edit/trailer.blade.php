@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@section('title')
بيانات مقطورات نقل البضائع
@stop

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مقطورات نقل البضائع</span>
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
				<!-- row -->
				<div class="row">
                        <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة مقطورة جديدة</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class ="table-striped table-bordered nowrap" style="width:100%" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">م</th>
												<th class="wd-10p border-bottom-0">رقم المقطورة</th>
												<th class="wd-10p border-bottom-0">النوع</th>
												<th class="wd-10p border-bottom-0">تاريخ دخول الخدمة</th>
												<th class="wd-20p border-bottom-0">مقاول النقل</th>
												<th class="wd-20p border-bottom-0">ملاحظات</th>
												<th class="wd-10p border-bottom-0">المستخدم الذي اضاف</th>
												<th class="wd-25p border-bottom-0">التعديل - الحذف</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0; ?>
											@foreach ($trailers as $trailer)
											<?php $i++; ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$trailer->tplate_num}}</td>
												<td>{{$trailer->trailer_type}}</td>
												<td>{{$trailer->entry_date}}</td>
												<td>{{$trailer->contractor->contractor_name }}</td>
												<td>{{$trailer->trailer_notes}}</td>
												<td>{{$trailer->user->name }}</td>
												<td>
                                                    @can('تعديل مقطورات')
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $trailer->id }}" data-tplate_num="{{ $trailer->tplate_num }}"
                                                       data-trailer_type="{{ $trailer->trailer_type }}" data-entry_date="{{ $trailer->entry_date }}"
													   data-contractor_id="{{ $trailer->contractor_id }}" data-toggle="modal" href="#exampleModal2"
                                                       title="بيانات المقطورة"><i class="las la-pen"></i></a>
                                                    @endcan
                                                    @can('حذف مقطورات')
													   <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													   data-id="{{ $trailer->id }}" data-tplate_num="{{ $trailer->tplate_num }}"
													   data-toggle="modal" href="#modaldemo9" title="حذف"><i
														   class="las la-trash"></i></a>
                                                        @endcan
												</td>
                                            </td>
											</tr>
											@endforeach
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                    </div>


					<div class="modal" id="modaldemo8">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">اضافة مقطورة جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal"
										type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{route('trailer.store')}}" method="post">
										@csrf
										<div class="form-group">
											<label for="text">رقم المقطورة</label>
											<input type="text" class="form-control form-control-lg" id="tplate_num" name="tplate_num" required>
										</div>
										<div class="form-group">
											<label for="text">النوع</label>
											<select name="trailer_type" id="trailer_type" class="form-control form-control-lg">
												<option value="" disabled selected>حدد نوع المقطورة</option>
												<option value="صب كونتر">صب كونتر</option>
												<option value="قلاب كونتر">قلاب كونتر</option>
												<option value="فرش بساط">فرش بساط</option>
												<option value="صهريج">صهريج</option>
											</select>
										</div>
										<div class="form-group">
											<label for="text">تاريخ دخول الخدمة</label>
											<input type="date" class="form-control form-control-lg" id="entry_date" name="entry_date">
										</div>
										<div class="form-group">
											<label for="text">مقاول النقل</label>
											<select name="contractor_id" id="contractor_id" class="form-control form-control-lg">
												<option disable selected>--حدد مقاول النقل --</option>
											@foreach($contractors as $contractor)
												<option value="{{ $contractor->id}}">{{ $contractor->contractor_name}}</option>
											@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="text">ملاحظات المقطورة</label>
											<textarea class="form-control form-control-lg" id="trailer_notes" name="trailer_notes"></textarea>
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
					<!-- edit -->
				</div>
					<!-- edit -->
				<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
				   <div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">تعديل بيانات المقطورة</h6><button aria-label="Close" class="close" data-dismiss="modal"
								type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="trailer/update" method="post">
								{{method_field('patch')}}
								@csrf
								<div class="form-group">
									<input type="hidden" name="id" id="id" value="">
									<label for="text">رقم المقطورة</label>
									<input type="text" class="form-control form-control-lg" id="tplate_num" name="tplate_num" required>
								</div>
								<div class="form-group">
									<label for="text">النوع</label>
									<select name="trailer_type" id="trailer_type" class="form-control form-control-lg">
										<option value="" disabled selected>حدد نوع المقطورة</option>
										<option value="صب">صب كونتر</option>
										<option value="قلاب">قلاب كونتر</option>
										<option value="معبأ">فرش بساط</option>
										<option value="صهريج">صهريج</option>
									</select>
								</div>
								<div class="form-group">
									<label for="text">تاريخ دخول الخدمة</label>
									<input type="date" class="form-control form-control-lg" id="entry_date" name="entry_date">
								</div>
								<div class="form-group">
									<label for="text">مقاول النقل</label>
									<select name="contractor_id" id="contractor_id" class="form-control form-control-lg">
										<option disable selected>--حدد مقاول النقل --</option>
									@foreach($contractors as $contractor)
										<option value="{{ $contractor->id}}">{{ $contractor->contractor_name}}</option>
									@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="text">ملاحظات المقطورة</label>
									<textarea class="form-control form-control-lg" id="trailer_notes" name="trailer_notes"></textarea>
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

			   <div class="modal" id="modaldemo9">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">حذف المقطورة</h6><button aria-label="Close" class="close" data-dismiss="modal"
								type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<form action="trailer/destroy" method="post">
							{{ method_field('delete') }}
							{{ csrf_field() }}
							<div class="modal-body">
								<p>هل انت متاكد من عملية الحذف للمقطورة ؟</p><br>
								<input type="hidden" name="id" id="id" value="">
								<input class="form-control form-control-lg" name="tplate_num" id="tplate_num" type="text" readonly>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
								<button type="submit" class="btn btn-danger">تاكيد</button>
							</div>
					</div>
					</form>
				</div>
			</div>
			</div>
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
{{--    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>--}}
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
            var tplate_num = button.data('tplate_num')
            var trailer_type = button.data('trailer_type')
			var trailer_notes = button.data('trailer_notes')
			var entry_date = button.data('entry_date')
			var contractor_id = button.data('contractor_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #tplate_num').val(tplate_num);
            modal.find('.modal-body #trailer_type').val(trailer_type);
			modal.find('.modal-body #trailer_notes').val(trailer_notes);
			modal.find('.modal-body #entry_date').val(entry_date);
			modal.find('.modal-body #contractor_id').val(contractor_id);
        })
    </script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var tplate_num = button.data('tplate_num')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #tplate_num').val(tplate_num);
    })
</script>
@endsection
