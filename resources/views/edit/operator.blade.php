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
        مشغلي المعدات
    @stop
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            });
        });
    </script>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مشغلي المعدات</span>
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
                        <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8">اضافة مشغل معدة</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">اسم مشغل المعدة</th>
                                <th class="wd-10p border-bottom-0">الكود</th>
                                <th class="wd-10p border-bottom-0">المقاول</th>
                                <th class="wd-10p border-bottom-0">التصنيف</th>
                                <th class="wd-10p border-bottom-0">ملاحظات</th>
                                <th class="wd-10p border-bottom-0">المستخدم</th>
                                <th class="wd-10p border-bottom-0">تعديل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($operators as $operator)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$operator->operator_name}}</td>
                                    <td>{{$operator->operator_code }}</td>
                                    <td>{{$operator->shipingcontractor->SCName }}</td>
                                    <td>{{$operator->classs }}</td>
                                    <td>{{$operator->operator_notes }}</td>
                                    <td>{{$operator->user->name }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-id="{{ $operator->id }}" data-operator_name="{{ $operator->operator_name }}"
                                           data-operator_code="{{ $operator->operator_code }}"
                                           data-shipping_contractor_id="{{ $operator->shipping_contractor_id }}"
                                           data-operator_notes="{{ $operator->operator_notes }}" data-toggle="modal"
                                           href="#exampleModal2"
                                           title="بيانات مشغل المعدة"><i class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-id="{{ $operator->id }}" data-operator_name="{{ $operator->operator_name }}"
                                           data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                class="las la-trash"></i></a>
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
                        <h6 class="modal-title">اضافة مشغل معدة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('operator.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="text">اسم المشغل</label>
                                <input type="text" class="form-control form-control-lg" id="operator_name"
                                       name="operator_name" required>
                            </div>
                            <div class="form-group">
                                <label for="text">الكود</label>
                                <input type="num" class="form-control form-control-lg" id="operator_code"
                                       name="operator_code">
                            </div>
                            <div class="form-group">
                                <label for="text">التصنيف</label>
                                <select name="classs" id="classs" class="form-control form-control-lg">
                                    <option disable selected>تصنيف المعدة</option>
                                        <option value="قلاب">قلاب</option>
                                        <option value="لودر">لودر</option>
                                        <option value="سير">سير</option>
                                        <option value="حفار">حفار</option>
                                        <option value="شفاط">شفاط</option>
                                        <option value="جرار">جرار</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">المقاول</label>
                                <select name="shipping_contractor_id" id="shipping_contractor_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد مقاول الشحن --</option>
                                    @foreach($shipingcontractors as $shipingcontractor)
                                        <option value="{{ $shipingcontractor->id}}">{{ $shipingcontractor->SCName}}</option>
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
                        <h6 class="modal-title">تعديل بيانات المشغل</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="operator/update" method="post">
                            {{method_field('patch')}}
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="text" class="form-control form-control-lg" id="driver_name"
                                       name="driver_name" required>
                            </div>
                            <div class="form-group">
                                <label for="" text"">رقم الرخصة</label>
                                <input type="number" class="form-control form-control-lg" id="licence_num"
                                       name="licence_num">
                            </div>
                            <div class="form-group">
                                <label for="text">كود السائق</label>
                                <input type="num" class="form-control form-control-lg" id="driver_code"
                                       name="driver_code">
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
                        <h6 class="modal-title">حذف مشغل معدة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="operator/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية حذف المشغل ؟</p><br>
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
