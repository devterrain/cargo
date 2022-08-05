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
        بيانات رحلة السفينة
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ رحلة السفينة</span>
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
                           data-toggle="modal" href="#modaldemo8">اضافة رحلة سفينة</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">اسم السفينة</th>
                                <th class="wd-5p border-bottom-0">تاريخ الوصول</th>
                                <th class="wd-10p border-bottom-0">تاريخ التراكي</th>
                                <th class="wd-10p border-bottom-0">بداية الشحن</th>
                                <th class="wd-10p border-bottom-0">نهاية الشحن</th>
                                <th class="wd-10p border-bottom-0">رصيف الارساء</th>
                                <th class="wd-10p border-bottom-0">الحمولة</th>
                                <th class="wd-10p border-bottom-0">توكيل الشحن</th>
                                <th class="wd-10p border-bottom-0">الكمية المشحونة</th>
                                <th class="wd-10p border-bottom-0">المستخدم الذي اضاف</th>
                                <th class="wd-20p border-bottom-0">التعديل - الحذف</th>
                                <th class="wd-20p border-bottom-0">Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($shiptrips as $shiptrip)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$shiptrip->ship->ship_name}}</td>
                                    <td>{{$shiptrip->arrival_date}}</td>
                                    <td>{{$shiptrip->tracky_date}}</td>
                                    <td>{{$shiptrip->shpping_bdate}}</td>
                                    <td>{{$shiptrip->shpping_edate}}</td>
                                    <td>{{$shiptrip->dock->dock_name}}</td>
                                    <td>{{$shiptrip->cargo->cargo_name}}</td>
                                    <td>{{$shiptrip->shipping_agency }}</td>
                                    <td>{{number_format($shiptrip->quantitiy) }}</td>
                                    <td>{{$shiptrip->user->name }}</td>
                                    <td>{{$shiptrip->active }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                           data-id="{{ $shiptrip->id }}" data-ship_id="{{ $shiptrip->ship_id }}"
                                           data-arrival_date="{{ $shiptrip->arrival_date }}"
                                           data-tracky_date="{{ $shiptrip->tracky_date }}"
                                           data-shpping_bdate="{{ $shiptrip->shpping_bdate }}"
                                           data-shpping_edate="{{ $shiptrip->shpping_edate }}"
                                           data-dock_id="{{ $shiptrip->dock_id }}"
                                           data-cargo_id="{{ $shiptrip->cargo_id }}"
                                           data-shipping_agency="{{ $shiptrip->shipping_agency }}"
                                           data-quantitiy="{{ $shiptrip->quantitiy }}"
                                           data-toggle="modal" href="#exampleModal2"
                                           title="بيانات رحلة السفينة"><i class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-lg btn-danger" data-effect="effect-scale"
                                           data-id="{{ $shiptrip->id }}"
                                           data-ship_name="{{ $shiptrip->ship->ship_name }}"
                                           data-toggle="modal" href="#modaldemo9" title="حذف رحلة السفينة"><i
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
                        <h6 class="modal-title">اضافة رحلة سفينة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('shiptrip.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="text">اسم السفينة</label>
                                <select name="ship_id" id="ship_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد اسم السفينة--</option>
                                    @foreach($ships as $ship)
                                        <option value="{{ $ship->id}}">{{ $ship->ship_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ الوصول</label>
                                <input type="date" class="form-control form-control-lg" id="arrival_date"
                                       name="arrival_date" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ التراكي</label>
                                <input type="date" class="form-control form-control-lg" id="tracky_date"
                                       name="tracky_date" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ بداية الشحن</label>
                                <input type="date" class="form-control form-control-lg" id="shpping_bdate"
                                       name="shpping_bdate" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ نهاية الشحن</label>
                                <input type="date" class="form-control form-control-lg" id="shpping_edate"
                                       name="shpping_edate" required>
                            </div>
                            <div class="form-group">
                                <label for="text">رصيف الارساء</label>
                                <select name="dock_id" id="dock_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد اسم الرصيف--</option>
                                    @foreach($docks as $dock)
                                        <option value="{{ $dock->id}}">{{ $dock->dock_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الحمولة</label>
                                <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد نوع الحمولة--</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id}}">{{ $cargo->cargo_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الكمية</label>
                                <input type="number" class="form-control" id="quantitiy" name="quantitiy" step="0.001"
                                       pattern="^\d*(\.\d{0,3})?$" min="0" value="0">
                            </div>
                            <div class="form-group">
                                <label for="text">وكالة الشحن</label>
                                <input type="text" class="form-control form-control-lg" id="shipping_agency"
                                       name="shipping_agency">
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

        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة رحلة سفينة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('shiptrip.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="text">اسم السفينة</label>
                                <select name="ship_id" id="ship_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد اسم السفينة--</option>
                                    @foreach($ships as $ship)
                                        <option value="{{ $ship->id}}">{{ $ship->ship_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ الوصول</label>
                                <input type="date" class="form-control form-control-lg" id="arrival_date"
                                       name="arrival_date" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ التراكي</label>
                                <input type="date" class="form-control form-control-lg" id="tracky_date"
                                       name="tracky_date" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ بداية الشحن</label>
                                <input type="date" class="form-control form-control-lg" id="shpping_bdate"
                                       name="shpping_bdate" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ نهاية الشحن</label>
                                <input type="date" class="form-control form-control-lg" id="shpping_edate"
                                       name="shpping_edate" required>
                            </div>
                            <div class="form-group">
                                <label for="text">رصيف الارساء</label>
                                <select name="dock_id" id="dock_id" class="category">
                                    <option disable selected>--حدد اسم الرصيف--</option>
                                    @foreach($docks as $dock)
                                        <option value="{{ $dock->id}}">{{ $dock->dock_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الحمولة</label>
                                <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد نوع الحمولة--</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id}}">{{ $cargo->cargo_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الكمية</label>
                                <input type="number" class="form-control" id="quantitiy" name="quantitiy" step="0.001"
                                       pattern="^\d*(\.\d{0,3})?$" min="0" value="0">
                            </div>
                            <div class="form-group">
                                <label for="text">وكالة الشحن</label>
                                <input type="text" class="form-control form-control-lg" id="shipping_agency"
                                       name="shipping_agency">
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
                        <h6 class="modal-title">تعديل بيانات رحلة السفينة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="shiptrip/update'" method="post">
                            {{method_field('patch')}}
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text">اسم السفينة</label>
                                <select name="ship_id" id="ship_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد اسم السفينة--</option>
                                    @foreach($ships as $ship)
                                        <option value="{{ $ship->id}}">{{ $ship->ship_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ الوصول</label>
                                <input type="date" class="form-control form-control-lg" id="arrival_date"
                                       name="arrival_date" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ التراكي</label>
                                <input type="date" class="form-control form-control-lg" id="tracky_date"
                                       name="tracky_date" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ بداية الشحن</label>
                                <input type="date" class="form-control form-control-lg" id="shpping_bdate"
                                       name="shpping_bdate" required>
                            </div>
                            <div class="form-group">
                                <label for="text">تاريخ نهاية الشحن</label>
                                <input type="date" class="form-control form-control-lg" id="shpping_edate"
                                       name="shpping_edate" required>
                            </div>
                            <div class="form-group">
                                <label for="text">رصيف الارساء</label>
                                <select name="dock_id" id="dock_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد اسم الرصيف--</option>
                                    @foreach($docks as $dock)
                                        <option value="{{ $dock->id}}">{{ $dock->dock_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الحمولة</label>
                                <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                    <option disable selected>--حدد نوع الحمولة--</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id}}">{{ $cargo->cargo_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">الكمية</label>
                                <input type="number" class="form-control" id="quantitiy" name="quantitiy" step="0.001"
                                       pattern="^\d*(\.\d{0,3})?$" min="0" value="0">
                            </div>
                            <div class="form-group">
                                <label for="text">وكالة الشحن</label>
                                <input type="text" class="form-control form-control-lg" id="shipping_agency"
                                       name="shipping_agency">
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
                        <h6 class="modal-title">حذف رحلة السفينة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="shiptrip/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من حذف رحلة السفينة ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control form-control-lg" name="ship_name" id="ship_name" type="text"
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
            let button = $(event.relatedTarget);
            let id = button.data('id')
            let ship_id = button.data('ship_id')
            let arrival_date = button.data('arrival_date')
            let tracky_date = button.data('tracky_date')
            let shpping_bdate = button.data('shpping_bdate')
            let shpping_edate = button.data('shpping_edate')
            let dock_id = button.data('dock_id')
            let cargo_id = button.data('cargo_id')
            let shipping_agency = button.data('shipping_agency')
            let quantitiy = button.data('quantitiy')
            let active = button.data('active')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #ship_id').val(ship_id);
            modal.find('.modal-body #arrival_date').val(arrival_date);
            modal.find('.modal-body #tracky_date').val(tracky_date);
            modal.find('.modal-body #shpping_bdate').val(shpping_bdate);
            modal.find('.modal-body #shpping_edate').val(shpping_edate);
            modal.find('.modal-body #dock_id').val(dock_id);
            modal.find('.modal-body #cargo_id').val(cargo_id);
            modal.find('.modal-body #shipping_agency').val(shipping_agency);
            modal.find('.modal-body #quantitiy').val(quantitiy);
            modal.find('.modal-body #active').val(active);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let ship_name = button.data('ship_name')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #ship_name').val(ship_name);
        })
    </script>
@endsection
