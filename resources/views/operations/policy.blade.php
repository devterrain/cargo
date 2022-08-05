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
        بيانات بوالص الشحن
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تسجيل بوليصة شحن</span>
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
                           data-toggle="modal" href="#modaldemo8">اضافة بوليصة شحن جديدة</a>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">رقم البوليصة</th>
                                <th class="wd-10p border-bottom-0">الصنف</th>
                                <th class="wd-10p border-bottom-0">الكمية</th>
                                <th class="wd-10p border-bottom-0">الراسل</th>
                                <th class="wd-10p border-bottom-0">رقم السيارة</th>
                                <th class="wd-10p border-bottom-0">رقم المقطورة</th>
                                <th class="wd-5p border-bottom-0">مقاول النقل</th>
                                <th class="wd-10p border-bottom-0">تاريخ الشحن</th>
                                <th class="wd-10p border-bottom-0">المرسل إليه</th>
                                <th class="wd-10p border-bottom-0">العنوان</th>
                                <th class="wd-10p border-bottom-0">اسم السائق</th>
                                <th class="wd-10p border-bottom-0">عنوان السائق</th>
                                <th class="wd-10p border-bottom-0">رخصة القيادة</th>
                                <th class="wd-10p border-bottom-0">الفارغ</th>
                                <th class="wd-10p border-bottom-0">القائم</th>
                                <th class="wd-10p border-bottom-0">رقم الحافز</th>
                                <th class="wd-10p border-bottom-0">محرر البوليصة</th>
                                <th class="wd-20p border-bottom-0">إعداد</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($policies as $policy)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>U {{$policy->id}}</td>
                                    <td>{{$policy->cargo->cargo_name}}</td>
                                    <td>
                                        <b class="text-primary">{{number_format($policy->net_weight)}}</b>
                                    </td>
                                    <td>{{$policy->origin->origin_name}}</td>
                                    <td>{{$policy->vehicle->plate_num}}</td>
                                    <td>{{$policy->trailer->tplate_num}}</td>
                                    <td>{{$policy->contractor->contractor_name}}</td>
                                    <td>{{$policy->shipping_date}}</td>
                                    <td>{{$policy->destination->destination_name}}</td>
                                    <td>{{$policy->destination->destination_address}}</td>
                                    <td>{{$policy->driver->driver_name }}</td>
                                    <td>{{$policy->driver->province}} - {{$policy->driver->city}}
                                        - {{$policy->driver->driver_address}}</td>
                                    <td>{{$policy->driver->licence_num}}</td>
                                    <td>{{number_format($policy->empty_weight) }}</td>
                                    <td>{{number_format($policy->loaded_weight) }}</td>
                                    <td>{{$policy->driver->driver_code }}</td>
                                    <td>{{$policy->user->name }}</td>
                                    <td>
                                        @can('تعديل بوليصة شحن')
                                            <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                               data-id="{{ $policy->id }}" data-cargo_id="{{ $policy->cargo_id }}"
                                               data-shipping_date="{{ $policy->shipping_date }}"
                                               data-net_weight="{{ $policy->net_weight }}"
                                               data-vehicle_id="{{ $policy->vehicle_id }}"
                                               data-trailer_id="{{ $policy->trailer_id }}"
                                               data-contractor_id="{{ $policy->contractor_id }}"
                                               data-destination_id="{{ $policy->destination_id }}"
                                               data-origin_id="{{ $policy->origin_id }}"
                                               data-driver_id="{{ $policy->driver_id }}"
                                               data-empty_weight="{{ $policy->empty_weight }}"
                                               data-loaded_weight="{{ $policy->loaded_weight }}"
                                               data-toggle="modal" href="#exampleModal2" title="بيانات البوليصة"><i
                                                    class="las la-pen"></i></a>
                                        @endcan
                                        <a class="modal-effect btn btn-lg btn-success"
                                           href="print_policy/{{ $policy->id }}"><i
                                                class="fas fa-print"></i> </a>
                                        @can('حذف بوليصة شحن')
                                            <a class="modal-effect btn btn-lg btn-danger" data-effect="effect-scale"
                                               data-id="{{ $policy->id }}" data-toggle="modal" href="#modaldemo9"
                                               title="حذف البوليصة"><i class="las la-trash"></i></a>
                        @endcan
                    </div>
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
                    <h6 class="modal-title">بيانات بوليصة الشحن</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('policy.store')}}" method="post" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="text">تاريخ الشحن</label>
                            <input type="date" class="form-control form-control-lg" id="shipping_date"
                                   name="shipping_date">
                        </div>
                        <div class="form-group">
                            <label for="text" class="text-secondary">مقاول النقل</label>
                            <select name="contractor_id" id="contractor_id" class="form-control form-control-lg">
                                <option disable selected>حدد مقاول النقل</option>
                                @foreach($contractors as $contractor)
                                    <option value="{{ $contractor->id}}">{{ $contractor->contractor_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">رقم السيارة</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control form-control-lg">
                                <option disable selected>اختر رقم السيارة</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id}}">{{ $vehicle->plate_num}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">رقم المقطورة</label>
                            <select name="trailer_id" id="trailer_id" class="form-control form-control-lg">
                                <option disable selected>اختر رقم المقطورة</option>
                                @foreach($trailers as $trailer)
                                    <option value="{{ $trailer->id}}">{{ $trailer->tplate_num}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">الحمولة</label>
                            <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                <option disable selected>حدد حمولة السيارة</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id}}">{{ $cargo->cargo_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">الراسل</label>
                            <select name="origin_id" id="origin_id" class="form-control form-control-lg">
                                <option disable selected>حدد الراسل</option>
                                @foreach($origins as $origin)
                                    <option value="{{ $origin->id}}">{{ $origin->origin_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">المرسل اليه</label>
                            <select name="destination_id" id="destination_id" class="form-control form-control-lg">
                                <option disable selected>حدد المرسل اليه</option>
                                @foreach($destinations as $destination)
                                    <option
                                        value="{{ $destination->id}}" {{ (old("destination_id") == $destination ? "selected" : "") }}> {{ ($destination->destination_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">السائق</label>
                            <select name="driver_id" id="driver_id" class="form-control form-control-lg">
                                <option disable selected>اختر السائق</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id}}">{{ $driver->driver_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <fieldset class="form-group">
                            <legend class="h5 text-center text-danger">الوزن الفارغ</legend>
                            <div class="form-group">
                                <label for="text">الوزن الفارغ (بالكيلو جرام)</label>
                                <input type="number" class="form-control form-control-lg" id="empty_weight"
                                       name="empty_weight" min="15000" max="35000" step="20" oncopy="return false"
                                       onpaste="return false">
                            </div>
                            <div class="form-group">
                                <label for="text">تأكيد الوزن الفارغ (بالكيلو جرام)</label>
                                <input type="number"
                                       class="form-control @error('empty_weight_confirmation') is-invalid @enderror form-control-lg"
                                       id="empty_weight_confirmation"
                                       name="empty_weight_confirmation" min="15000" max="35000" maxlength="5" step="20"
                                       oncopy="return false" onpaste="return false">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="h5 text-center text-danger">الوزن القائم</legend>
                            <div class="form-group">
                                <label for="text">الوزن القائم (بالكيلو جرام)</label>
                                <input type="number" class="form-control form-control-lg" id="loaded_weight"
                                       name="loaded_weight" min="35000" max="120000" maxlength="6" step="20"
                                       oncopy="return false" onpaste="return false">
                            </div>
                            <div class="form-group">
                                <label for="text">تأكيد الوزن القائم (بالكيلو جرام)</label>
                                <input type="number"
                                       class="form-control @error('loaded_weight_confirmation') is-invalid @enderror form-control-lg"
                                       id="loaded_weight_confirmation"
                                       name="loaded_weight_confirmation" min="35000" max="120000" maxlength="6" step="20"
                                       oncopy="return false" onpaste="return false">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="h5 text-center text-danger">الوزن الصافي</legend>
                            <div class="form-group">
                                <label for="text">صافي الوزن (بالكيلو جرام)</label>
                                <input type="number" class="form-control form-control-lg" id="net_weight"
                                       onclick="validate()" name="net_weight" maxlength="5" step="20" oncopy="return false"
                                       onpaste="return false">
                            </div>
                            <div class="form-group">
                                <label for="text">تأكيد الوزن الصافي (بالكيلو جرام)</label>
                                <input type="number"
                                       class="form-control @error('net_weight_confirmation') is-invalid @enderror form-control-lg"
                                       id="net_weight_confirmation"
                                       name="net_weight_confirmation" maxlength="5" step="20" oncopy="return false"
                                       onpaste="return false">
                            </div>
                        </fieldset>
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
                    <h6 class="modal-title">تعديل بيانات بوليصة الشحن <i class="fas fa-file"></i></h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="policy/update" method="post">
                        {{method_field('patch')}}
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="text">تاريخ الشحن</label>
                            <input type="date" value="{{old('shipping_date')}}" class="form-control form-control-lg"
                                   id="shipping_date"
                                   name="shipping_date">
                        </div>
                        <div class="form-group">
                            <label for="text">مقاول النقل</label>
                            <select name="contractor_id" id="contractor_id" class="form-control form-control-lg">
                                <option disable selected>اختر مقاول النقل</option>
                                @foreach($contractors as $contractor)
                                    <option
                                        value="{{ $contractor->id}}" {{ old('contractor_id') == $contractor->id ? 'selected' : '' }}>{{ $contractor->contractor_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">رقم السيارة</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control form-control-lg">
                                <option disable selected>اختر رقم السيارة</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id}}">{{ $vehicle->plate_num}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">رقم المقطورة</label>
                            <select name="trailer_id" id="trailer_id" class="form-control form-control-lg">
                                <option disable selected>اختر رقم المقطورة</option>
                                @foreach($trailers as $trailer)
                                    <option value="{{ $trailer->id}}">{{ $trailer->tplate_num}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">الحمولة</label>
                            <select name="cargo_id" id="cargo_id" class="form-control form-control-lg">
                                <option disable selected>حدد حمولة السيارة</option>
                                @foreach($cargos as $cargo)
                                    <option
                                        value="{{ $cargo->id}}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>{{ $cargo->cargo_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">الراسل</label>
                            <select name="origin_id" id="origin_id" class="form-control form-control-lg">
                                <option disable selected>حدد الراسل</option>
                                @foreach($origins as $origin)
                                    <option
                                        value="{{ $origin->id}}" {{ old('origin_id') == $origin->id ? 'selected' : '' }}>{{ $origin->origin_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">المرسل اليه</label>
                            <select name="destination_id" id="destination_id" class="form-control form-control-lg">
                                <option disable selected>حدد المرسل اليه</option>
                                @foreach($destinations as $destination)
                                    <option
                                        value="{{ $destination->id}}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>{{ $destination->destination_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">السائق</label>
                            <select name="driver_id" id="driver_id" class="form-control form-control-lg">
                                <option disable selected>اختر السائق</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id}}">{{ $driver->driver_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <fieldset class="form-group">
                            <legend class="h5 text-center text-danger">الوزن الفارغ</legend>
                            <div class="form-group">
                                <label for="text">الوزن الفارغ (بالكيلو جرام)</label>
                                <input type="number" class="form-control form-control-lg" id="empty_weight"
                                       name="empty_weight" min="15000" max="35000" step="20" oncopy="return false"
                                       onpaste="return false">
                            </div>
                            <div class="form-group">
                                <label for="text">تأكيد الوزن الفارغ (بالكيلو جرام)</label>
                                <input type="number"
                                       class="form-control @error('empty_weight_confirmation') is-invalid @enderror form-control-lg"
                                       id="empty_weight_confirmation"
                                       name="empty_weight_confirmation" min="15000" max="35000" maxlength="5" step="20"
                                       oncopy="return false" onpaste="return false">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="h5 text-center text-danger">الوزن القائم</legend>
                            <div class="form-group">
                                <label for="text">الوزن القائم (بالكيلو جرام)</label>
                                <input type="number" class="form-control form-control-lg" id="loaded_weight"
                                       name="loaded_weight" min="35000" max="120000" maxlength="6" step="20"
                                       oncopy="return false" onpaste="return false">
                            </div>
                            <div class="form-group">
                                <label for="text">تأكيد الوزن القائم (بالكيلو جرام)</label>
                                <input type="number"
                                       class="form-control @error('loaded_weight_confirmation') is-invalid @enderror form-control-lg"
                                       id="loaded_weight_confirmation"
                                       name="loaded_weight_confirmation" min="35000" max="120000" maxlength="6" step="20"
                                       oncopy="return false" onpaste="return false">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="h5 text-center text-danger">الوزن الصافي</legend>
                            <div class="form-group">
                                <label for="text">صافي الوزن (بالكيلو جرام)</label>
                                <input type="number" class="form-control form-control-lg" id="net_weight"
                                       onclick="validate()" name="net_weight" maxlength="5" step="20" oncopy="return false"
                                       onpaste="return false">
                            </div>
                            <div class="form-group">
                                <label for="text">تأكيد الوزن الصافي (بالكيلو جرام)</label>
                                <input type="number"
                                       class="form-control @error('net_weight_confirmation') is-invalid @enderror form-control-lg"
                                       id="net_weight_confirmation"
                                       name="net_weight_confirmation" maxlength="5" step="20" oncopy="return false"
                                       onpaste="return false">
                            </div>
                        </fieldset>
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
                    <h6 class="modal-title">حذف بوليصة</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="policy/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف للبوليصة ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control form-control-lg" name="id" id="id" type="text" readonly>
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
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        function validate() {
            let loaded = document.getElementById('loaded_weight').value;
            let empty = document.getElementById('empty_weight').value;
            let net = document.getElementById('net_weight');
            net.value = parseInt(loaded) - parseInt(empty);
        }
    </script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let cargo_id = button.data('cargo_id')
            let shipping_date = button.data('shipping_date')
            let origin_id = button.data('origin_id')
            let contractor_id = button.data('contractor_id')
            let driver_id = button.data('driver_id')
            let vehicle_id = button.data('vehicle_id')
            let trailer_id = button.data('trailer_id')
            let destination_id = button.data('destination_id')
            let empty_weight = button.data('empty_weight')
            let loaded_weight = button.data('loaded_weight')
            let net_weight = button.data('net_weight')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #cargo_id').val(cargo_id);
            modal.find('.modal-body #shipping_date').val(shipping_date);
            modal.find('.modal-body #origin_id').val(origin_id);
            modal.find('.modal-body #contractor_id').val(contractor_id);
            modal.find('.modal-body #driver_id').val(driver_id);
            modal.find('.modal-body #vehicle_id').val(vehicle_id);
            modal.find('.modal-body #trailer_id').val(trailer_id);
            modal.find('.modal-body #destination_id').val(destination_id);
            modal.find('.modal-body #empty_weight').val(empty_weight);
            modal.find('.modal-body #loaded_weight').val(loaded_weight);
            modal.find('.modal-body #net_weight').val(net_weight);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
