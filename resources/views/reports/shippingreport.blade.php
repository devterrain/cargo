@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @section('title')
        تقرير عمليات الشحن - كايرو ثري ايه للشحن والتفريغ
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقارير شحن السفن</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
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
                    <form action="/Search_shipping" method="POST" role="search" autocomplete="off">
                        {{ csrf_field() }}
                            <div class="row">

                                <div class="col-lg-3" id="start_at">
                                    <label for="exampleFormControlSelect1">من تاريخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                               name="start_at" placeholder="YYYY-MM-DD" type="text">
                                    </div><!-- input-group -->
                                </div>

                                <div class="col-lg-3" id="end_at">
                                    <label for="exampleFormControlSelect1">الي تاريخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" name="end_at"
                                               value="" placeholder="YYYY-MM-DD" type="text">
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-3 col-md-3">
                                    <button class="btn btn-gray-700 btn-lg btn-block"><i class="fa fa-ship">عرض تقرير شحن السفن</i> </button>
                                </div>
                            </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($shippings))
                            <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">م</th>
                                    <th class="wd-5p border-bottom-0">كود العملية</th>
                                    <th class="wd-5p border-bottom-0">قلاب</th>
                                    <th class="wd-5p border-bottom-0">سائق بدء العملية</th>
                                    <th class="wd-5p border-bottom-0">سائق انتهاء العملية</th>
                                    <th class="wd-5p border-bottom-0">توقيت بدء العملية</th>
                                    <th class="wd-5p border-bottom-0">مخزن التحميل</th>
                                    <th class="wd-5p border-bottom-0">اسم السفينة</th>
                                    <th class="wd-5p border-bottom-0">الكمية</th>
                                    <th class="wd-5p border-bottom-0">لودر</th>
                                    <th class="wd-5p border-bottom-0">مشغل اللودر</th>
                                    <th class="wd-5p border-bottom-0">عنبر</th>
                                    <th class="wd-5p border-bottom-0">رقم السير</th>
                                    <th class="wd-5p border-bottom-0">موظف تشغيل مخزن التحميل</th>
                                    <th class="wd-5p border-bottom-0">موظف تشغيل السفينة</th>
                                    <th class="wd-5p border-bottom-0">وردية التحميل</th>
                                    <th class="wd-5p border-bottom-0">وردية الشحن</th>
                                    <th class="wd-5p border-bottom-0">توقيت التحميل</th>
                                    <th class="wd-5p border-bottom-0">بدء الشحن</th>
                                    <th class="wd-5p border-bottom-0">انتهاء الشحن</th>
                                    <th class="wd-5p border-bottom-0">ملاحظات التحميل</th>
                                    <th class="wd-5p border-bottom-0">ملاحظات الشحن</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($shippings as $shipping)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$shipping->id}}</td>
                                        <td>{{$shipping->vehicle->plate_num}}</td>
                                        <td>{{$shipping->operator->operator_name}}</td>
                                        <td>{{$shipping->operatortwo->operator_name}}</td>
                                        <td>{{$shipping->created_at}}</td>
                                        <td>{{$shipping->store->store_name}}</td>
                                        <td>{{$shipping->shiptrip->ship->ship_name}}</td>
                                        <td>{{number_format($shipping->weight)}}</td>
                                        <td>{{$shipping->loader->loader_num}}</td>
                                        <td>{{$shipping->loaderoperator->operator_name}}</td>
                                        <td>{{$shipping->gate_num}}</td>
                                        <td>{{$shipping->convair->convair_num}}</td>
                                        <td>{{$shipping->user->name}}</td>
                                        <td>{{$shipping->shipuser->name}}</td>
                                        <td>{{$shipping->start_shift}}</td>
                                        <td>{{$shipping->end_shift}}</td>
                                        <td>{{$shipping->load_end}}</td>
                                        <td>{{$shipping->shipping_start}}</td>
                                        <td>{{$shipping->shipping_end}}</td>
                                        <td>{{$shipping->load_notes}}</td>
                                        <td>{{$shipping->shipping_notes}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

@endsection
