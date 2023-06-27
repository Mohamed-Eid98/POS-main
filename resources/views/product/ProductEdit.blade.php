@extends('layouts.master')
@section('title')
    اضافة منتج
@stop
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اضافة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    منتج جديد</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection


@section('content')


    @if (session('add'))
        <div class="alert alert-success">
            {{ session('add') }}
        </div>
    @endif

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">


                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">إضافة منتج </h4>
                            </div>
                            <hr>
                            <!-- start 2nd row  -->


                            <div class="form-group">
                                <h5 for="name">أسم المنتج <span class="text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 for="desc">وصف المنتج <span class="text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <textarea name="desc"  class="form-control" id="desc" cols="10" rows="5">{{ $product->description }}</textarea>
                                    @error('desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6">

                                    <h5 for="code">الكود</h5>
                                    <div class="controls">
                                        <input type="text" name="code" value="{{ $product->code }}" class="form-control" />
                                        @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">


                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title"> الاقسام</h4>
                        </div>
                        <hr>
                        <!-- start 2nd row  -->


                    </div>


                    <div class="row"> <!-- start 1st row  -->

                        <div class="col-md-6">

                            <div class="form-group">
                                <h5>القسم الرئيسي <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="cate_id" id="select" class="form-control"  >
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name  }}</option>
                                        @endforeach
                                    </select>
                                    @error('cate_id')
                                    <span class="text-danger" >{{ $message }}</span>
                                    @enderror
                                 </div>
                                </div>

                        </div> <!-- end col md 6 -->


                        <div class="col-md-6">

                            <div class="form-group">
                                <h5>القسم الفرعي <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="subcate_id" id="select" class="form-control"  >
                                        <option value="" selected disabled >-- اختر القسم الفرعي--</option>
                                    </select>
                                    @error('subcate_id')
                                    <span class="text-danger" >{{ $message }}</span>
                                    @enderror
                                 </div>
                                </div>

                        </div> <!-- end col md 6 -->

                    </div> <!-- end 1st row  -->



                </div>
            </div>
        </div>
    </div>




            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title"> معلومات</h4>
                                </div>
                                <hr>
                                <!-- start 2nd row  -->


                            </div>
                            <div class="row">
                                <!-- start 1st row  -->

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5>اللون <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="color" id="select" class="form-control" required>
                                                <option value="" selected disabled>-- اختر اللون
                                                    --
                                                </option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">
                                                        {{ $color->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('color')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div> <!-- end col md 6 -->


                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5>المقاس <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="size" id="select" class="form-control" required>
                                                <option value="" selected disabled>-- اختر المقاس
                                                    --
                                                </option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}" >
                                                        {{ $size->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('size')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->

                            </div> <!-- end 1st row  -->
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">الاسعار   </h4>
                                </div>
                                <hr>
                                <!-- start 2nd row  -->

<div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5 for="price"> السعر <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" id="price" name="price" value="{{ $product->price }}" class="form-control">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

            </div>

<div class="row">

                            <div class="col-md-4">
                            <div class="form-group">
                                    <h5 for="min_price"> الحد الادني <span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" id="min_price" name="min_price" value="{{ $product->min_price }}" class="form-control">
                                        @error('min_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-4">
                            <div class="form-group">
                                    <h5 for="repeated_times"> عدد التكرار <span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" id="repeated_times" name="repeated_times" value="{{ $product->repeat_times }}" class="form-control">
                                        @error('repeated_times')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                            <div class="form-group">
                                    <h5 for="increase_ratio"> الزياده <span class="text-danger">*</span>
                                    </h5>
                                    <div class="controls">
                                        <input type="text" id="increase_ratio" name="increase_ratio" value="{{ $product->increase_ratio }}" class="form-control">
                                        @error('increase_ratio')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>








            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">إضافة صوره </h4>
                                </div>
                                <hr>
                                <!-- start 2nd row  -->



                                <div class="fallback">
                                    <img src="" id="mainThmb" alt="">
                                    <br><br>
                                        <input type="file" name="pic"  onChange="mainThamUrl(this)">
                                    @error('pic')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bxs-cloud-upload text-center"></i>
                                    </div>

                                    <h4>ادخل الصوره هنا</h4>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_1" name="new" value="1" {{ $product->is_new == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_1">جديد</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" name="sale" value="1" {{ $product->is_on_sale == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_2">عرض</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" name="new_arrival" value="1" {{ $product->is_new_arrival == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_3">لم يصل</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_4" name="best_seller" value="1" {{ $product->is_best_seller == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_4">الافضل مبيعاً</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="اضافة منتج">
            </div>


        </div>
        </div>
    </form>





    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

    </section>
    <!-- /.content -->
    </div>

@endsection




@section('js')



{{-- $(document).ready(function() {
    $('select[name="cate_id"]').on('change', function(){})
    var category_id = $(this).val();
    $.get('/ajax-' + category_id ,
    success:function(data) {
        var d =$('select[name="subcate_id"]').empty();
        $.each(data, function(key, value){
            $('select[name="subcate_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
        });
    },
});

});
</script> --}}

<script type="text/javascript">

$(document).ready(function() {
    $('select[name="cate_id"]').change(function() {
        var category_id = $(this).val();
        $.get('/ajax-' + category_id, function(data) {


            var d =$('select[name="subcate_id"]').empty();
        $.each(data, function(key, value){
            $('select[name="subcate_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
        });

        });
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('script')
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
