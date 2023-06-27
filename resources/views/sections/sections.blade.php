@extends('layouts.master')
@section('title')
    القسم
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    القسم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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
    <div class="row">
        <!--div-->


        @if (session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="col-xl-12">
            <div class="card ">
                <div class="col-sm-6 col-md-4 col-xl-12">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                        href="#modaldemo8"> اضافه قسم</a>
                </div>
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0"> اسم القسم</th>
                                <th class="border-bottom-0"> الوصف</th>
                                <th class="border-bottom-0"> actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($sections as $section)
                                <?php $i++; ?>

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $section->section_name }} </td>
                                    <td>{{ $section->description }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                            data-description="{{ $section->description }}" data-toggle="modal"
                                            href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                            data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                class="las la-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/div-->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> اضافه قسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sections.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="exampleInputEmail1"> اسم القسم</label>

                                <input type="text" class="form-control" id="section_name" name="section_name">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">وصف</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">حفظ</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- row closed -->
        <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> تعديل القسم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="sections/update" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label"> اسم القسم:</label>
                                <input class="form-control" name="section_name" id="section_name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">الوصف:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="sections/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل تريد حذف القسم?</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-danger">حفظ</button>
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
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
@endsection
{{-- @extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Form-Advanced</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">Single Select Style</h6>
                        <p class="text-muted card-sub-title">First import a latest version of jquery in your page. Then the
                            jquery.sumoselect.min.js and its css (sumoselect.css)</p>
                    </div>
                    <div class="mb-4">
                        <p class="mg-b-10">Single Select</p>
                        <select name="somename" class="form-control SlectBox" onclick="console.log($(this).val())"
                            onchange="console.log('change is firing')">
                            <!--placeholder-->
                            <option title="Volvo is a car" value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <p class="mg-b-10">Disabled Select</p>
                        <select class="SlectBox form-control" disabled>
                            <option value="volvo">Volvo</option>
                            <option selected value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option disabled value="opt1">option1</option>
                            <option value="opt2">option2</option>
                            <option value="opt3">option3</option>
                        </select>
                    </div>
                    <div>
                        <p class="mg-b-10">Inline Select</p>
                        <select class="SlectBox form-control">
                            <option>selected</option>
                            <option>Volvo</option>
                            <option>Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option>Volvo</option>
                            <option>Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option>Volvo</option>
                            <option>Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option>Volvo</option>
                            <option>Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">Multiple Select Styles</h6>
                        <p class="text-muted card-sub-title">First import a latest version of jquery in your page. Then the
                            jquery.sumoselect.min.js and its css (sumoselect.css)</p>
                    </div>
                    <div class="mb-4">
                        <p class="mg-b-10">Multiple Select</p>
                        <select multiple="multiple" class="testselect2">
                            <option selected value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <p class="mg-b-10">Disabled Select</p>
                        <select multiple="multiple" class="testselect2" disabled>
                            <option selected value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option disabled="disabled" value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option value="bmw">BMW</option>
                            <option value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option class="someclass" value="audi">Audi</option>
                            <option class="someclass" value="bmw">BMW</option>
                            <option class="someclass" value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="audi">Audi</option>
                            <option value="bmw">BMW</option>
                            <option value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="hyundai">Hyundai</option>
                            <option value="mitsubishi">Mitsubishi</option>
                        </select>
                    </div>
                    <div>
                        <p class="mg-b-10">Optgroup Support</p>
                        <select multiple="multiple" class="testselect2">
                            <option selected value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option disabled="disabled" value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option value="bmw">BMW</option>
                            <option value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option class="someclass" value="audi">Audi</option>
                            <option class="someclass" value="bmw">BMW</option>
                            <option class="someclass" value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="audi">Audi</option>
                            <option value="bmw">BMW</option>
                            <option value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="hyundai">Hyundai</option>
                            <option value="mitsubishi">Mitsubishi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">Multiple Select Styles</h6>
                        <p class="text-muted card-sub-title">First import a latest version of jquery in your page. Then the
                            jquery.sumoselect.min.js and its css (sumoselect.css)</p>
                    </div>
                    <div class="mb-4">
                        <p class="mg-b-10">Multiple Select-1</p>
                        <select multiple="multiple" onchange="console.log($(this).children(':selected').length)"
                            class="selectsum1">
                            <option selected value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option disabled="disabled" value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option selected value="bmw">BMW</option>
                            <option value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="mitsubishi">Mitsubishi</option>
                        </select>
                    </div>
                    <div>
                        <p class="mg-b-10">Multiple Select-2</p>
                        <select multiple="multiple" onchange="console.log($(this).children(':selected').length)"
                            class="selectsum2">
                            <option selected value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option disabled="disabled" value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option selected value="bmw">BMW</option>
                            <option value="porsche">Porche</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="mitsubishi">Mitsubishi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">Telephone Input</h6>
                        <p class="text-muted card-sub-title">A JavaScript plugin for entering and validating international
                            telephone numbers. It adds a flag dropdown to any input, detects the user's country, displays a
                            relevant placeholder and provides formatting/validation methods.</p>
                    </div>
                    <div class="input-group">
                        <input class="form-control" id="phone" name="phone" type="tel">
                        <span class="input-group-btn">
                            <button class="btn ripple btn-primary bl-tl-0 bl-bl-0" type="button">Submit</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">File Upload</h6>
                        <p class="text-muted card-sub-title">Dropify is a jQuery plugin to create a beautiful file uploader
                            that converts a standard <code>input type="file"</code> into a nice drag & drop zone with
                            previews and custom styles.</p>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-4">
                            <input type="file" class="dropify" data-height="200" />
                        </div>
                        <div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
                            <input type="file" class="dropify"
                                data-default-file="{{ URL::asset('assets/img/photos/1.jpg') }}" data-height="200" />
                        </div>
                        <div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
                            <input type="file" class="dropify" disabled="disabled" />
                        </div>
                    </div>
                    <div>
                        <input id="demo" type="file" name="files"
                            accept=".jpg, .png, image/jpeg, image/png, html, zip, css,js" multiple>
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
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal TelephoneInput js-->
    <script src="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>
@endsection --}}
