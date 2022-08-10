@extends('admin.layouts.master')

@section('title', 'Category List')

@section('search-bar')
    <form class="form-header" action="{{route('category#list')}}" method="get">
        <input class="au-input au-input--xl" type="text" name="search_category" value="{{request('search_category')}}" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">

                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>

                    {{-- total category  --}}
                    <div class="h3 text-primary">
                        Total - {{$categories->total()}}
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                {{-- created success message  --}}
                <div class="col-6 offset-6">
                    @if (session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fa-solid fa-circle-check"></i>&nbsp;<span>{{session('createSuccess')}}</span>
                            <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                        </div>
                    @endif
                </div>

                {{-- deleted success message  --}}
                <div class="col-6 offset-6" id="delete-alert">
                    @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            <i class="fa-solid fa-circle-check"></i>&nbsp;<span>{{session('deleteSuccess')}}</span>
                            <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                        </div>
                    @endif
                </div>

                @if (count($categories) != 0 )
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="tr-shadow">
                                <td>{{$category->id}}</td>
                                <td class="col-5">{{$category->name}}</td>
                                <td>{{$category->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </button> --}}
                                        <button onclick="window.location='{{route('category#edit',$category->id)}}'" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button id="delete-btn" onclick="window.location='{{route('category#delete',$category->id)}}'" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>

                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$categories->appends(request()->query())->links()}}
                    </div>
                </div>
                <!-- END DATA TABLE -->

                @else
                    <h3 class="text-secondary text-center mt-5">There is no category</h3>
                @endif


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


