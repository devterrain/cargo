@extends('layouts.master')
@section('title')
	مقاول نقل - تخزين
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">مقاول نقل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مقاولي نقل</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة مقاول نقل</a>

                                </div>

                            </div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">م</th>
												<th class="wd-15p border-bottom-0">مقاول النقل</th>
												<th class="wd-15p border-bottom-0">ملاحظات</th>
												<th class="wd-15p border-bottom-0">Created By</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($contractors as $contractor)
											<tr>
												<td>{{$contractor->id}}</td>
												<td>{{$contractor->contractor_name}}</td>
												<td>{{$contractor->contractor_notes}}</td>
												<td>{{$contractor->created_by}}</td>
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
								<h6 class="modal-title">اضافة مقاول نقل</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form action="{{ route('contractor.store') }}" method="post">
									@csrf
									<div class="form-group">
										<label for="text">اسم مقاول النقل</label>
										<input type="text" class="form-control" id="contractor_name" name="contractor_name">
									</div>
									<div class="form-group">
										<label for="text">ملاحظات</label>
										<textarea class="form-control" id="contractor_notes" name="contractor_notes" rows="3"></textarea>
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
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
