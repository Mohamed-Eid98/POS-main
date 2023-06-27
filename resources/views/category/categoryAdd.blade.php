@extends('layouts.master')

@section('title') إضافة قسم رئيسي @endsection

@section('css')
    <!-- Plugins css -->
    <link href="{{ URL::asset('build/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

asda


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') إضافة @endslot
        @slot('title') قسم رئيسي @endslot
    @endcomponent










    @if (session('Add'))
<div class="alert alert-success">
    {{ session('Add') }}
</div>
@endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">القسم الرئيسي</h4>
                    <p class="card-title-desc">
                    </p>

                    <div>

                        <form action="{{ route('category.store') }}" class="dropzone" method="POST" enctype="multipart/form-data">
                            @csrf

                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label">اسم القسم الرئيسي<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="formrow-firstname-input" name="name" placeholder="ادخل اسم القسم الرئيسي من فضلك">
                                        @error('name')
                                            <span class="text-danger" >{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="fallback">
                                    <img  id="mainThmb"  alt="">
                                    <br><br>
                                        <input type="file" name="pic"  onChange="mainThamUrl(this)">
                                        @error('pic')
                                            <span class="text-danger" >{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                    </div>

                                    <h4>ادخل الصوره هنا</h4>
                                </div>
                            </div>
                                <div class="text-center mt-4">
                                    <input type="submit" class="btn btn-primary waves-effect waves-light" value="حفظ">
                                </div>
                            </form>






                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection





@section('script')
    <!-- Plugins js -->
    {{-- <script src="{{ URL::asset('build/libs/dropzone/min/dropzone.min.js') }}"></script> --}}



            <!-- JAVASCRIPT -->
            {{-- <script src="{{ asset('build/libs/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('build/libs/metismenu/metisMenu.min.js') }}"></script>
            <script src="{{ asset('build/libs/simplebar/simplebar.min.js') }}"></script>
            <script src="{{ asset('build/libs/node-waves/waves.min.js') }}"></script>

            <!-- Plugins js -->
            <script src="{{ asset('build/libs/dropzone/min/dropzone.min.js') }}"></script>

            <script src="{{ asset('build/js/app.js') }}"></script> --}}


            <script type="text/javascript">
                function mainThamUrl(input){
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('#mainThmb').attr('src',e.target.result).width(130).height(150);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>



@endsection







{{-- @section('content')




<section class="content">
    <div class="row">


      <div class="col-12">

        <div class="box">
          <div class="box-body">
              <div class="table-responsive">

            <form method="post" action="{{ route('category.store') }}">
            @csrf
                <div class="form-group">
                    <h5 for="name">أسم القسم  <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" id="name" name="name" class="form-control">
                        @error('name')
                            <span class="text-danger" >{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="text-center">
                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="إضافه">
                </div>

            </form>

              </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>


    </div>
    <!-- /.row -->
</section>

@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection --}}
