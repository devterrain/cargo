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
        تقرير عمليات تخزين البضائع الواردة - كايرو ثري ايه للشحن والتفريغ
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقارير تخزين البضائع الواردة</span>
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

                    <form action="/Search_storage" method="POST" role="search" autocomplete="off">
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
                            <div class="col-sm-2 col-md-2">
                                <button class="btn btn-success btn-lg btn-block">عرض التقرير</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($policies))
                            <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">م</th>
                                    <th class="wd-10p border-bottom-0">رقم البوليصة</th>
                                    <th class="wd-10p border-bottom-0">تاريخ الشحن</th>
                                    <th class="wd-10p border-bottom-0">الحمولة</th>
                                    <th class="wd-10p border-bottom-0">رقم السيارة</th>
                                    <th class="wd-10p border-bottom-0">رقم المقطورة</th>
                                    <th class="wd-10p border-bottom-0">اسم السائق</th>
                                    <th class="wd-10p border-bottom-0">ميزان الصادر (الصافي)</th>
                                    <th class="wd-10p border-bottom-0">وزن المصنع (الصافي)</th>
                                    <th class="wd-10p border-bottom-0">المقاول</th>
                                    <th class="wd-10p border-bottom-0">وقت الخروج من المصنع</th>
                                    <th class="wd-10p border-bottom-0">توقيت الوزن القائم</th>
                                    <th class="wd-10p border-bottom-0">توقيت الوزن الفارغ</th>
                                    <th class="wd-10p border-bottom-0">مسئول الميزان (القائم)</th>
                                    <th class="wd-10p border-bottom-0">مسئول الميزان (الفارغ)</th>
                                    <th class="wd-10p border-bottom-0">توقيت بدء التفريغ</th>
                                    <th class="wd-10p border-bottom-0">توقيت انتهاء التفريغ</th>
                                    <th class="wd-10p border-bottom-0">موظف تشغيل المخزن(بدء التخزين)</th>
                                    <th class="wd-10p border-bottom-0">موظف تشغيل المخزن (انتهاء التخزين)</th>
                                    <th class="wd-10p border-bottom-0">ملاحظات الميزان</th>
                                    <th class="wd-10p border-bottom-0">ملاحظات أخرى</th>
                                </tr>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($policydetails as $policydetail)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>U {{$policydetail->policy->id}}</td>
                                        <td>{{$policydetail->policy->shipping_date}}</td>
                                        <td>{{$policydetail->policy->cargo->cargo_name}}</td>
                                        <td>{{$policydetail->policy->vehicle->plate_num}}</td>
                                        <td>{{$policydetail->policy->trailer->tplate_num}}</td>
                                        <td>{{$policydetail->policy->driver->driver_name}}</td>
                                        <td>{{number_format($policydetail->dnet_weight)}}</td>
                                        <td class="text-primary">{{number_format($policydetail->policy->net_weight)}}</td>
                                        <td>{{$policydetail->policy->vehicle->contractor->contractor_name}}</td>
                                        <td>{{$policydetail->policy->created_at}}</td>
                                        <td>{{$policydetail->first_scale}}</td>
                                        <td>{{$policydetail->second_scale}}</td>
                                        <td>{{$policydetail->scale_user1->name}}</td>
                                        <td>{{$policydetail->scale_user2->name}}</td>
                                        <td>{{$policydetail->unload_start}}</td>
                                        <td>{{$policydetail->unload_end}}</td>
                                        <td>{{$policydetail->shipping_user1->name}}</td>
                                        <td>{{$policydetail->shipping_user2->name}}</td>
                                        <td>{{$policydetail->scale_notes}}</td>
                                        <td>{{$policydetail->other_notes}}</td>
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
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
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
