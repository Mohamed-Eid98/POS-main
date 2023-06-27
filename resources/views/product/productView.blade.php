
@extends('layouts.master')

@section('title')
    عرض المنتجات
@endsection

@section('css')
    <!-- DataTables -->
    <link
        href="{{ asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css') }}" />
    <link
        href="{{ asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css') }}" />


    <!-- Responsive datatable examples -->
    <link href="{{ asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
{{--
        <style>
            td strong a {
              text-decoration: underline;
              color:black;

            }
          </style> --}}
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            عرض
        @endslot
        @slot('title')
            المنتجات
        @endslot
    @endcomponent

    @if (session('delete'))
    <div class="alert alert-success">
        {{ session('delete') }}
    </div>
    @endif

    @if (session('edit'))
    <div class="alert alert-success">
        {{ session('edit') }}
    </div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">عرض المنتجات </h4>
                    <p class="card-title-desc">

                    </p>

                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length"><label>عرض <select
                                            name="datatable_length" aria-controls="datatable"
                                            class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="datatable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="datatable"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                    role="grid" aria-describedby="datatable_info" style="width: 1566px;">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>الصوره</th>
                                            <th>اسم المنتج</th>
                                            <th>الكود</th>
                                            <th>القسم الفرعي</th>
                                            <th>السعر (دينار عراقي)</th>
                                            <th>الحد الادني (دينار عراقي)</th>
                                            <th>معدل الزياده (دينار عراقي)</th>
                                            <th>عدد التكرار</th>
                                            <th>الحد الاقصي (دينار عراقي)</th>
                                            <th>جديد </th>
                                            <th>الافضل مبيعاً </th>
                                            <th>عليه عرض </th>
                                            <th>وصل حديثاً </th>
                                            <th>التعديلات</th>
                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php $i = 0; ?>
                                        @foreach ($products as $product)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                     @if($product->image)
                                                      <img src="{{ $product->image }}" alt="" style="width: 40px; height:50px">
                                                     @else
                                                     <img src="{{asset('uploads/on-C100969_Image_01.jpeg') }}" alt="" style="width: 40px; height:50px">

                                                     @endif
                                                </td>
                                                <td> <strong> {{ $product->name }} </strong> </td>
                                                <td>
                                                    <span class="badge text-bg-danger">{{ $product->code }}</span>

                                                </td>
                                                <td> <strong> <a href="{{ route('product.show.subcategory' , $product->id) }}"> {{ $product->subcategory->name }} </a></strong></td>
                                                <td> <strong> {{ $product->price }} د.ع. </strong></td>
                                                <td> <strong> {{ $product->min_price }} د.ع. </strong></td>
                                                <td><strong> {{ $product->increase_ratio }} د.ع. </strong></td>
                                                <td> <b> {{ $product->repeat_times }} </b> </td>
                                                <td>
                                                    <strong>{{  ($product->min_price) +  (($product->repeat_times +1) * $product->increase_ratio) }} د.ع.
                                                    </strong>
                                                </td>
                                                <td>
                                                    @if($product->is_new == 1)
                                                    <span class="badge text-bg-secondary">نعم</span>
                                                    @else
                                                    <span class="badge text-bg-danger">لا</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->is_best_seller == 1)
                                                    <span class="badge text-bg-secondary">نعم</span>
                                                    @else
                                                    <span class="badge text-bg-danger">لا</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->is_on_sale == 1)
                                                    <span class="badge text-bg-secondary">نعم</span>
                                                    @else
                                                    <span class="badge text-bg-danger">لا</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->is_new_arrival == 1)
                                                    <span class="badge text-bg-secondary">نعم</span>
                                                    @else
                                                    <span class="badge text-bg-danger">لا</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('product.edit',$product->id) }}" title="تعديل"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('product.delete', $product->id) }}"
                                                        class="btn btn-danger" title="حذف">
                                                        <i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div> --}}

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    @endsection








