@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    @section('title')
        بيانات السائقين
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ السائقين</span>
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
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8">اضافة سائق جديد</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">اسم السائق</th>
                                <th class="wd-10p border-bottom-0">العنوان</th>
                                <th class="wd-10p border-bottom-0">تاريخ الميلاد</th>
                                <th class="wd-20p border-bottom-0">درجة الرخصة</th>
                                <th class="wd-20p border-bottom-0">رقم الرخصة</th>
                                <th class="wd-10p border-bottom-0">رقم البطاقة</th>
                                <th class="wd-10p border-bottom-0">تاريخ التعيين</th>
                                <th class="wd-7p border-bottom-0">كود السائق</th>
                                <th class="wd-10p border-bottom-0">مقاول النقل</th>
                                <th class="wd-10p border-bottom-0">ملاحظات</th>
                                <th class="wd-10p border-bottom-0">المستخدم</th>
                                <th class="wd-10p border-bottom-0">تعديل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($drivers as $driver)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$driver->driver_name}}</td>
                                    <td>{{$driver->province}} - {{$driver->city}}- {{$driver->driver_address}}</td>
                                    <td>{{$driver->driver_birthday}}</td>
                                    <td>{{$driver->licence_type }}</td>
                                    <td>{{$driver->licence_num}}</td>
                                    <td>{{$driver->identity_num }}</td>

                                    <td>{{$driver->hiring_date }}</td>
                                    <td>{{$driver->driver_code }}</td>
                                    <td>{{$driver->contractor->contractor_name }}</td>
                                    <td>{{$driver->driver_notes }}</td>
                                    <td>{{$driver->user->name }}</td>
                                    <td>
                                        @can('تعديل سائقين')
                                            <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                               data-id="{{ $driver->id }}" data-driver_name="{{ $driver->driver_name }}"
                                               data-province="{{ $driver->province }}" data-city="{{ $driver->city }}"
                                               data-driver_address="{{ $driver->driver_address }} "
                                               data-driver_birthday="{{ $driver->driver_birthday }}"
                                               data-licence_type="{{ $driver->licence_type }}"
                                               data-licence_num="{{ $driver->licence_num }}"
                                               data-hiring_date="{{ $driver->hiring_date }}"
                                               data-driver_code="{{ $driver->driver_code }}"
                                               data-contractor_id="{{ $driver->contractor_id }}"
                                               data-identity_num="{{ $driver->identity_num }}"
                                               data-driver_notes="{{ $driver->driver_notes }}" data-toggle="modal"
                                               href="#exampleModal2"
                                               title="بيانات السائق"><i class="las la-pen"></i></a>
                                        @endcan
                                        @can('حذف سائقين')
                                            <a class="modal-effect btn btn-lg btn-danger" data-effect="effect-scale"
                                               data-id="{{ $driver->id }}" data-driver_name="{{ $driver->driver_name }}"
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
                        <h6 class="modal-title">اضافة سائق جديد</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('driver.store')}}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="text">اسم السائق</label>
                                <input type="text" class="form-control form-control-lg" id="driver_name"
                                       name="driver_name" required>
                            </div>
                            <div class="form-group">
                                <label for="text">المحافظة</label>
                                <select name="province" id="province" class="form-control form-control-lg">
                                    <option disable selected>--حدد المحافظة --</option>
                                    <option value="الغربية">الغربية</option>
                                    <option value="الجيزة">الجيزة</option>
                                    <option value="الإسماعيلية">الإسماعيلية</option>
                                    <option value="كفر الشيخ">كفر الشيخ</option>
                                    <option value="مطروح">مطروح</option>
                                    <option value="المنيا">المنيا</option>
                                    <option value="المنوفية">المنوفية</option>
                                    <option value="الوادي الجديد">الوادي الجديد</option>
                                    <option value="شمال سيناء">شمال سيناء</option>
                                    <option value="بورسعيد">بورسعيد</option>
                                    <option value="القليوبية">القليوبية</option>
                                    <option value="قنا">قنا</option>
                                    <option value="البحر الأحمر">البحر الأحمر</option>
                                    <option value="الشرقية">الشرقية</option>
                                    <option value="سوهاج">سوهاج</option>
                                    <option value="جنوب سيناء">جنوب سيناء</option>
                                    <option value="السويس">السويس</option>
                                    <option value="الأقصر">الأقصر</option>
                                    <option value="القاهرة">القاهرة</option>
                                    <option value="الإسكندرية">الإسكندرية</option>
                                    <option value="الفيوم">الفيوم</option>
                                    <option value="أسوان">أسوان</option>
                                    <option value="أسيوط">أسيوط</option>
                                    <option value="البحيرة">البحيرة</option>
                                    <option value="بني سويف">بني سويف</option>
                                    <option value="الدقهلية">الدقهلية</option>
                                    <option value="دمياط">دمياط</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">مدينة / قرية</label>
                                <input type="text" class="form-control form-control-lg" id="city" name="city">
                            </div>
                            <div class="form-group">
                                <label for="text">العنوان</label>
                                <input type="text" class="form-control form-control-lg" id="driver_address"
                                       name="driver_address">
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ الميلاد</label>
                                <input type="date" class="form-control form-control-lg" id="driver_birthday"
                                       name="driver_birthday">
                            </div>
                            <div class="form-group">
                                <label for="text">فئة الرخصة</label>
                                <select name="licence_type" id="licence_type" class="form-control form-control-lg">
                                    <option value="" disabled selected>حدد فئة الرخصة</option>
                                    <option value="درجة أولى">درجة أولى</option>
                                    <option value="درجة ثانية">درجة ثانية</option>
                                    <option value="درجة ثالثة">درجة ثالثة</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" text"">رقم الرخصة</label>
                                <input type="number" class="form-control form-control-lg" id="licence_num"
                                       name="licence_num">
                            </div>
                            <div class="form-group">
                                <label for="text">رقم البطاقة</label>
                                <input type="number" class="form-control form-control-lg" id="identity_num"
                                       name="identity_num">
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ التعيين</label>
                                <input type="date" class="form-control form-control-lg" id="hiring_date"
                                       name="hiring_date">
                            </div>
                            <div class="form-group">
                                <label for="text">كود السائق</label>
                                <input type="num" class="form-control form-control-lg" id="driver_code"
                                       name="driver_code">
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
                                <label for="text">ملاحظات </label>
                                <textarea class="form-control form-control-lg" id="driver_notes"
                                          name="driver_notes"></textarea>
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
                        <h6 class="modal-title">تعديل بيانات السائق</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="driver/update" method="post">
                            {{method_field('patch')}}
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="text" class="form-control form-control-lg" id="driver_name"
                                       name="driver_name" required>
                            </div>
                            <div class="form-group">
                                <label for="text">المحافظة</label>
                                <select name="province" id="province" class="form-control form-control-lg">
                                    <option disable selected>--حدد المحافظة --</option>
                                    <option value="الغربية">الغربية</option>
                                    <option value="الجيزة">الجيزة</option>
                                    <option value="الإسماعيلية">الإسماعيلية</option>
                                    <option value="كفر الشيخ">كفر الشيخ</option>
                                    <option value="مطروح">مطروح</option>
                                    <option value="المنيا">المنيا</option>
                                    <option value="المنوفية">المنوفية</option>
                                    <option value="الوادي الجديد">الوادي الجديد</option>
                                    <option value="شمال سيناء">شمال سيناء</option>
                                    <option value="بورسعيد">بورسعيد</option>
                                    <option value="القليوبية">القليوبية</option>
                                    <option value="قنا">قنا</option>
                                    <option value="البحر الأحمر">البحر الأحمر</option>
                                    <option value="الشرقية">الشرقية</option>
                                    <option value="سوهاج">سوهاج</option>
                                    <option value="جنوب سيناء">جنوب سيناء</option>
                                    <option value="السويس">السويس</option>
                                    <option value="الأقصر">الأقصر</option>
                                    <option value="القاهرة">القاهرة</option>
                                    <option value="الإسكندرية">الإسكندرية</option>
                                    <option value="الفيوم">الفيوم</option>
                                    <option value="أسوان">أسوان</option>
                                    <option value="أسيوط">أسيوط</option>
                                    <option value="البحيرة">البحيرة</option>
                                    <option value="بني سويف">بني سويف</option>
                                    <option value="الدقهلية">الدقهلية</option>
                                    <option value="دمياط">دمياط</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">مدينة / قرية</label>
                                <input type="text" class="form-control form-control-lg" id="city" name="city">
                            </div>
                            <div class="form-group">
                                <label for="text">العنوان</label>
                                <input type="text" class="form-control form-control-lg" id="driver_address"
                                       name="driver_address">
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ الميلاد</label>
                                <input type="date" class="form-control form-control-lg" id="driver_birthday"
                                       name="driver_birthday">
                            </div>
                            <div class="form-group">
                                <label for="text">فئة الرخصة</label>
                                <select name="licence_type" id="licence_type" class="form-control form-control-lg">
                                    <option value="" disabled selected>حدد فئة الرخصة</option>
                                    <option value="درجة أولى">درجة أولى</option>
                                    <option value="درجة ثانية">درجة ثانية</option>
                                    <option value="درجة ثالثة">درجة ثالثة</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" text"">رقم الرخصة</label>
                                <input type="number" class="form-control form-control-lg" id="licence_num"
                                       name="licence_num">
                            </div>
                            <div class="form-group">
                                <label for="text">رقم البطاقة</label>
                                <input type="number" class="form-control form-control-lg" id="identity_num"
                                       name="identity_num">
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ التعيين</label>
                                <input type="date" class="form-control form-control-lg" id="hiring_date"
                                       name="hiring_date">
                            </div>
                            <div class="form-group">
                                <label for="text">كود السائق</label>
                                <input type="num" class="form-control form-control-lg" id="driver_code"
                                       name="driver_code">
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
                                <label for="text">ملاحظات </label>
                                <textarea class="form-control form-control-lg" id="driver_notes"
                                          name="driver_notes"></textarea>
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
                        <h6 class="modal-title">حذف سائق</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="driver/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية حذف السائق ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control form-control-lg" name="driver_name" id="driver_name" type="text"
                                   readonly>
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
    {{-- <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script> --}}
    {{-- <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script> --}}
    {{-- <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script> --}}
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    {{-- <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script> --}}
    {{-- <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script> --}}
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var driver_name = button.data('driver_name')
            var province = button.data('province')
            var city = button.data('city')
            var driver_address = button.data('driver_address')
            var driver_birthday = button.data('driver_birthday')
            var licence_type = button.data('licence_type')
            var licence_num = button.data('licence_num')
            var identity_num = button.data('identity_num')
            var hiring_date = button.data('hiring_date')
            var driver_code = button.data('driver_code')
            var contractor_id = button.data('contractor_id')
            var driver_notes = button.data('driver_notes')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #driver_name').val(driver_name);
            modal.find('.modal-body #province').val(province);
            modal.find('.modal-body #city').val(city);
            modal.find('.modal-body #driver_address').val(driver_address);
            modal.find('.modal-body #driver_birthday').val(driver_birthday);
            modal.find('.modal-body #licence_type').val(licence_type);
            modal.find('.modal-body #licence_num').val(licence_num);
            modal.find('.modal-body #identity_num').val(identity_num);
            modal.find('.modal-body #hiring_date').val(hiring_date);
            modal.find('.modal-body #driver_code').val(driver_code);
            modal.find('.modal-body #contractor_id').val(contractor_id);
            modal.find('.modal-body #driver_notes').val(driver_notes);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var driver_name = button.data('driver_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #driver_name').val(driver_name);
        })
    </script>
@endsection
