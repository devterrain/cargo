@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    سيور الرفع
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">سير رفع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معدات رفع</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!--Row-->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">جدول سيور الرفع الخاصة بعمليات الشحن والتفريغ</h4>
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                               data-toggle="modal" href="#modaldemo8">إضافة سير جديد</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="wd-lg-8p"><span>م</span></th>
                                <th class="wd-lg-20p"><span>رقم السير</span></th>
                                <th class="wd-lg-20p"><span>النوع</span></th>
                                <th class="wd-lg-20p"><span>الطول</span></th>
                                <th class="wd-lg-20p"><span>القدرة</span></th>
                                <th class="wd-lg-20p"><span>ملاحظات</span></th>
                                <th class="wd-lg-20p"><span>مقاول التشغيل</span></th>
                                <th class="wd-lg-20p"><span>المستخدم</span></th>
                                <th class="wd-lg-20p">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($convairs as $convair)
                                <tr>
                                    <td>{{$convair->id}}</td>
                                    <td>{{$convair->convair_num}}</td>
                                    <td>{{$convair->type}}</td>
                                    <td>{{$convair->length}} متر </td>
                                    <td>{{$convair->convair_power}}</td>
                                    <td>{{$convair->convair_notes}}</td>
                                    <td>{{$convair->shipingcontractor->SCName}}</td>
                                    <td>{{$convair->user->name}}</td>
                                    <td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-id="{{ $convair->id }}" data-convair_num="{{ $convair->convair_num }}"
                                           data-convair_power="{{ $convair->convair_power }}"
                                           data-type="{{ $convair->type }}"
                                           data-length="{{ $convair->length }}"
                                           data-convair_notes="{{ $convair->convair_notes }}"
                                           data-shiping_contractor_id="{{ $convair->shiping_contractor_id }}"
                                           data-toggle="modal" href="#exampleModal2"
                                           title="بيانات السير"><i class="las la-pen"></i></a>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- row closed  -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة سير رفع جديد</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('convair.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="text">رقم السير</label>
                            <input type="number" class="form-control" id="convair_num" name="convair_num" min="1"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="text">النوع</label>
                            <input type="text" class="form-control" id="type" name="type" min="1"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="text">الطول</label>
                            <input type="text" class="form-control" id="length" name="length" min="1"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="text">القدرة</label>
                            <input type="number" class="form-control" id="convair_power" name="convair_power" min="1">
                        </div>
                        <div class="form-group">
                            <label for="text">ملاحظات</label>
                            <input type="text" class="form-control" id="convair_notes" name="convair_notes">
                        </div>
                        <div class="form-group">
                            <label for="text">مقاول الشحن</label>
                            <select name="shiping_contractor_id" id="shiping_contractor_id" class="form-control">
                                <option disable selected>--حدد مقاول الشحن والتفريغ--</option>
                                @foreach($shipingcontractors as $shipingcontractor)
                                    <option value="{{ $shipingcontractor->id}}">{{ $shipingcontractor->SCName}}</option>
                                @endforeach
                            </select>
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
    <!-- insert modal closed -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل بيانات سير الرفع </h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="convair/update" method="post">
                        {{method_field('patch')}}
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="text">رقم السير</label>
                            <input type="number" class="form-control" id="convair_num" name="convair_num" min="1"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="text">النوع</label>
                            <input type="text" class="form-control" id="type" name="type" min="1"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="text">الطول</label>
                            <input type="text" class="form-control" id="length" name="length" min="1"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="text">القدرة</label>
                            <input type="number" class="form-control" id="convair_power" name="convair_power" min="1">
                        </div>
                        <div class="form-group">
                            <label for="text">ملاحظات</label>
                            <input type="text" class="form-control" id="convair_notes" name="convair_notes">
                        </div>
                        <div class="form-group">
                            <label for="text">مقاول الشحن</label>
                            <select name="shiping_contractor_id" id="shiping_contractor_id" class="category">
                                <option disable selected>--حدد مقاول الشحن والتفريغ--</option>
                                @foreach($shipingcontractors as $shipingcontractor)
                                    <option value="{{ $shipingcontractor->id}}">{{ $shipingcontractor->SCName}}</option>
                                @endforeach
                            </select>
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
    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let convair_num = button.data('convair_num')
            let type = button.data('type')
            let length = button.data('length')
            let convair_power = button.data('convair_power')
            let convair_notes = button.data('convair_notes')
            let shiping_contractor_id = button.data('shiping_contractor_id')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #convair_num').val(convair_num);
            modal.find('.modal-body #convair_power').val(convair_power);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #length').val(length);
            modal.find('.modal-body #convair_notes').val(convair_notes);
            modal.find('.modal-body #shiping_contractor_id').val(shiping_contractor_id);
        })
    </script>
@endsection
