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
        بيانات سيارات النقل
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سيارات نقل البضائع</span>
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
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8">اضافة سيارة جديدة</a>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">رقم السيارة</th>
                                <th class="wd-5p border-bottom-0">النوع</th>
                                <th class="wd-10p border-bottom-0">الموديل</th>
                                <th class="wd-10p border-bottom-0">الشركة المنتجة</th>
                                <th class="wd-10p border-bottom-0">رقم المحرك</th>
                                <th class="wd-10p border-bottom-0">رقم الشاسيه</th>
                                <th class="wd-10p border-bottom-0">تاريخ دخول الخدمة</th>
                                <th class="wd-10p border-bottom-0">مقاول النقل</th>
                                <th class="wd-10p border-bottom-0">المستخدم الذي اضاف</th>
                                <th class="wd-20p border-bottom-0">التعديل - الحذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($vehicles as $vehicle)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$vehicle->plate_num}}</td>
                                    <td>{{$vehicle->type}}</td>
                                    <td>{{$vehicle->model}}</td>
                                    <td>{{$vehicle->manufacturer}}</td>
                                    <td>{{$vehicle->engine_num}}</td>
                                    <td>{{$vehicle->chasset_num}}</td>
                                    <td>{{$vehicle->entry_date}}</td>
                                    <td>{{$vehicle->contractor->contractor_name }}</td>
                                    <td>{{$vehicle->user->name }}</td>
                                    <td>
                                        @can('تعديل سيارات')
                                            <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                               data-id="{{ $vehicle->id }}" data-plate_num="{{ $vehicle->plate_num }}"
                                               data-type="{{ $vehicle->type }}" data-model="{{ $vehicle->model }}"
                                               data-manufacturer="{{ $vehicle->manufacturer }}"
                                               data-engine_num="{{ $vehicle->engine_num }}"
                                               data-chasset_num="{{ $vehicle->chasset_num }}"
                                               data-entry_date="{{ $vehicle->entry_date }}"
                                               data-contractor_id="{{ $vehicle->contractor_id }}" data-toggle="modal"
                                               href="#exampleModal2"
                                               title="بيانات السيارة"><i class="las la-pen"></i></a>
                                            @endcan
                                            @can('حذف سيارات')
                                                <a class="modal-effect btn btn-lg btn-danger" data-effect="effect-scale"
                                                   data-id="{{ $vehicle->id }}"
                                                   data-plate_num="{{ $vehicle->plate_num }}"
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
                        <h6 class="modal-title">اضافة سيارة جديدة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('vehicle.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="text">رقم السيارة</label>
                                <input type="text" class="form-control form-control-lg" id="plate_num" name="plate_num"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="text">النوع</label>
                                <select name="type" id="type" class="form-control form-control-lg">
                                    <option value="" disabled selected>حدد نوع السيارة</option>
                                    <option value="نقل ثقيل">نقل ثقيل</option>
                                    <option value="قلاب">قلاب</option>
                                    <option value="نقل متوسط">نقل متوسط</option>
                                    <option value="نقل خفيف">نقل خفيف</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الموديل</label>
                                <input type="text" class="form-control form-control-lg" id="model" name="model">
                            </div>
                            <div class="form-group">
                                <label for="text">الشركة المنتجة</label>
                                <input type="text" class="form-control form-control-lg" id="manufacturer"
                                       name="manufacturer">
                            </div>
                            <div class="form-group">
                                <label for="text">رقم المحرك</label>
                                <input type="number" class="form-control form-control-lg" id="engine_num"
                                       name="engine_num" min="1">
                            </div>
                            <div class="form-group">
                                <label for="text">رقم الشاسيه</label>
                                <input type="number" class="form-control form-control-lg" id="chasset_num"
                                       name="chasset_num" min="1">
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ دخول الخدمة</label>
                                <input type="date" class="form-control form-control-lg" id="entry_date"
                                       name="entry_date">
                            </div>
                            <div class="form-group">
                                <label for="text">مقاول النقل</label>
                                <select name="contractor_id" id="contractor_id" class="category">
                                    <option disable selected>--حدد مقاول النقل --</option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{ $contractor->id}}">{{ $contractor->contractor_name}}</option>
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
            <!-- End Modal effects-->
            <!-- edit -->
        </div>
        <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">تعديل بيانات السيارة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="vehicle/update')}}" method="post">
                            {{method_field('patch')}}
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text">رقم السيارة</label>
                                <input type="text" class="form-control form-control-lg" id="plate_num" name="plate_num"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="text">النوع</label>
                                <select name="type" id="type" class="form-control form-control-lg">
                                    <option value="" disabled selected>حدد نوع السيارة</option>
                                    <option value="نقل ثقيل">نقل ثقيل</option>
                                    <option value="قلاب">قلاب</option>
                                    <option value="نقل متوسط">نقل متوسط</option>
                                    <option value="نقل خفيف">نقل خفيف</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الموديل</label>
                                <input type="text" class="form-control form-control-lg" id="model" name="model">
                            </div>
                            <div class="form-group">
                                <label for="text">الشركة المنتجة</label>
                                <input type="text" class="form-control form-control-lg" id="manufacturer"
                                       name="manufacturer">
                            </div>
                            <div class="form-group">
                                <label for="text">رقم المحرك</label>
                                <input type="number" class="form-control form-control-lg" id="engine_num"
                                       name="engine_num" min="1">
                            </div>
                            <div class="form-group">
                                <label for="text">رقم الشاسيه</label>
                                <input type="number" class="form-control form-control-lg" id="chasset_num"
                                       name="chasset_num" min="1">
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ دخول الخدمة</label>
                                <input type="date" class="form-control form-control-lg" id="entry_date"
                                       name="entry_date">
                            </div>
                            <div class="form-group">
                                <label for="text">مقاول النقل</label>
                                <select name="contractor_id" id="contractor_id" class="category">
                                    <option disable selected>--حدد مقاول النقل --</option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{ $contractor->id}}">{{ $contractor->contractor_name}}</option>
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

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف السيارة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="vehicle/destroy" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف للسيارة ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control form-control-lg" name="plate_num" id="plate_num" type="text"
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
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var plate_num = button.data('plate_num')
            var type = button.data('type')
            var model = button.data('model')
            var manufacturer = button.data('manufacturer')
            var engine_num = button.data('engine_num')
            var chasset_num = button.data('chasset_num')
            var entry_date = button.data('entry_date')
            var contractor_id = button.data('contractor_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #plate_num').val(plate_num);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #model').val(model);
            modal.find('.modal-body #manufacturer').val(manufacturer);
            modal.find('.modal-body #engine_num').val(engine_num);
            modal.find('.modal-body #chasset_num').val(chasset_num);
            modal.find('.modal-body #entry_date').val(entry_date);
            modal.find('.modal-body #contractor_id').val(contractor_id);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var plate_num = button.data('plate_num')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #plate_num').val(plate_num);
        })
    </script>
@endsection
