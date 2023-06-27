
@extends('layouts.master')

@section('title') تعديل قسم فرعي @endsection

@section('css')
    <!-- Plugins css -->
    <link href="{{ URL::asset('build/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection




@section('content')

    @component('components.breadcrumb')
        @slot('li_1') تعديل @endslot
        @slot('title') قسم فرعي @endslot
    @endcomponent










    @if (session('edit'))
<div class="alert alert-success">
    {{ session('edit') }}
</div>
@endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">القسم الفرعي</h4>
                    <p class="card-title-desc">
                    </p>

                    <div>

                        <form action="{{ route('subcategory.update') }}" class="dropzone" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $subcategory->id }}">
                            <input type="hidden" name="old_image" value="{{ $subcategory->image }}">

                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label">اسم القسم الفرعي<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="formrow-firstname-input" name="name" value="{{ $subcategory->name }}">
                                        @error('name')
                                            <span class="text-danger" >{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <h5>القسم الرئيسي <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="cate_id" id="select" class="form-control"  >
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ?? 'selected' }} >{{ $category->name  }}</option>
                                                @endforeach
                                            </select>
                                            @error('cate_id')
                                            <span class="text-danger" >{{ $message }}</span>
                                            @enderror
                                         </div>
                                        </div>
                                </div>

                                <div class="fallback">
                                    <img src="{{ $subcategory->image }}" style="width: 130px; height:150px" id="mainThmb" alt="">
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





