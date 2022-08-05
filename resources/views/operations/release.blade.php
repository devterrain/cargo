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
        بيانات أرقام الافراج
    @stop

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أرقام الافراج الجمركي</span>
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
                           data-toggle="modal" href="#modaldemo8">اضافة رقم افراج</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">م</th>
                                <th class="wd-10p border-bottom-0">رقم الافراج</th>
                                <th class="wd-10p border-bottom-0">رحلة السفينة</th>
                                <th class="wd-10p border-bottom-0">كيمية الافراج</th>
                                <th class="wd-10p border-bottom-0">بداية الافراج</th>
                                <th class="wd-10p border-bottom-0">نهاية الافراج</th>
                                <th class="wd-10p border-bottom-0">المستخدم الذي اضاف</th>
                                <th class="wd-20p border-bottom-0">التعديل - الحذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($releases as $release)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><p class="text-primary font-weight-bold">{{$release->release_num}}</p></td>
                                    <td>{{$release->shiptrip->ship->ship_name}}
                                        - {{$release->shiptrip->arrival_date}}</td>
                                    <td><p class="text-info font-weight-bold">{{$release->release_quantitiy}}</p></td>
                                    <td>{{$release->release_opening}}</td>
                                    <td>{{$release->release_ending}}</td>
                                    <td>{{$release->user->name }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                           data-id="{{ $release->id }}" data-release_num="{{ $release->release_num }}"
                                           data-ship_trip_id="{{ $release->ship_trip_id }}"
                                           data-release_quantitiy="{{ $release->release_quantitiy }}"
                                           data-release_opening="{{ $release->release_opening }}"
                                           data-release_ending="{{ $release->release_ending }}"
                                           data-toggle="modal" href="#exampleModal2" title="بيانات الافراج"><i
                                                class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-lg btn-danger" data-effect="effect-scale"
                                           data-id="{{ $release->id }}" data-release_num="{{ $release->release_num }}"
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
                        <h6 class="modal-title">اضافة رقم افراج جمركي</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('release.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="text">رقم الافراج</label>
                                <input type="text" class="form-control" id="release_num" name="release_num">
                            </div>
                            <div class="form-group">
                                <label for="text">رحلة السفينة</label>
                                <select name="ship_trip_id" id="ship_trip_id" class="category">
                                    <option disable selected>--حدد رحلة السفينة--</option>
                                    @foreach($shiptrips as $shiptrip)
                                        <option value="{{ $shiptrip->id}}">{{ $shiptrip->arrival_date}}
                                            - {{ $shiptrip->ship->ship_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">كمية الافراج</label>
                                <input type="number" class="form-control" id="release_quantitiy"
                                       name="release_quantitiy" step="0.001" pattern="^\d*(\.\d{0,3})?$" min="0"
                                       max="{{$shiptrip->quantitiy}}"
                                       placeholder="يجب أن لا تزيد كمية الافراج عن كمية رحلة السفينة">
                            </div>
                            <div class="form-group">
                                <label for="text">بداية الافراج</label>
                                <input type="datetime-local" id="release_opening" name="release_opening"
                                       min="2018-06-07T00:00">
                            </div>
                            <div class="form-group">
                                <label for="text"> نهاية الافراج</label>
                                <input type="datetime-local" id="release_ending" name="release_ending"
                                       min="2018-06-07T00:00">
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
                        <h6 class="modal-title">تعديل رقم الافراج</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="release/update" method="post">
                            {{method_field('patch')}}
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="text">رقم الافراج</label>
                                <input type="text" class="form-control" id="release_num" name="release_num">
                            </div>
                            <div class="form-group">
                                <label for="text">رحلة السفينة</label>
                                <select name="ship_trip_id" id="ship_trip_id" class="category">
                                    <option disable selected>--حدد رحلة السفينة--</option>
                                    @foreach($shiptrips as $shiptrip)
                                        <option value="{{ $shiptrip->id}}">{{ $shiptrip->arrival_date}}
                                            - {{ $shiptrip->ship->ship_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">كمية الافراج</label>
                                <input type="number" class="form-control" id="release_quantitiy"
                                       name="release_quantitiy" step="0.001" pattern="^\d*(\.\d{0,3})?$" min="0"
                                       value="0">
                            </div>
                            <div class="form-group">
                                <label for="text">بداية الافراج</label>
                                <input type="datetime-local" id="release_opening" name="release_opening"
                                       min="2018-06-07T00:00">
                            </div>
                            <div class="form-group">
                                <label for="text"> نهاية الافراج</label>
                                <input type="datetime-local" id="release_ending" name="release_ending"
                                       min="2018-06-07T00:00">
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
                        <h6 class="modal-title">حذف رقم الافراج</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="release/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من حذف رقم الافراج ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control form-control-lg" name="release_num" id="release_num" type="text"
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
            var release_num = button.data('release_num')
            var ship_trip_id = button.data('ship_trip_id')
            var release_quantitiy = button.data('release_quantitiy')
            var release_opening = button.data('release_opening')
            var release_ending = button.data('release_ending')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #release_num').val(release_num);
            modal.find('.modal-body #ship_trip_id').val(ship_trip_id);
            modal.find('.modal-body #release_quantitiy').val(release_quantitiy);
            modal.find('.modal-body #release_opening').val(release_opening);
            modal.find('.modal-body #release_ending').val(release_ending);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var release_num = button.data('release_num')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #release_num').val(release_num);
        })
    </script>
@endsection
