@extends('admin.layouts.master')

@section('title', 'Admin List')

@section('search-bar')
    <form class="form-header" action="{{route('admin#list')}}" method="get">
        <input class="au-input au-input--xl" type="text" name="search_account" value="{{request('search_account')}}" placeholder="Search for datas &amp; reports..." />
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

                <div class=" text-center my-3">
                    <h2 class="title-1">Admin List</h2>

                </div>

                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    {{-- <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>


                    <div class="table-data__tool-right">
                        <a href="{{ route('products#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div> --}}

                    {{-- total category  --}}
                    <div class="h3 text-primary">
                        Total - {{$admins->total()}}
                    </div>

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

                {{-- change role message  --}}
                <div class="col-6 offset-6">
                    @if (session('changeRoleSuccess'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fa-solid fa-thumbs-up me-2"></i>&nbsp;<span>{{session('changeRoleSuccess')}}</span>
                        <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                    </div>
                    @endif
                </div>

                @if (count($admins) != 0 )
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr class="tr-shadow">
                                <td class="col-2" >
                                    @if ($admin->image == null)
                                        @if($admin->gender == 'male')
                                            <img src="{{asset('admin/images/default_user.png')}}" class="img-thumbnail shadow " alt="">
                                        @else
                                            <img src="{{asset('admin/images/female-default.jpg')}}" class="img-thumbnail shadow " alt="">
                                        @endif
                                    @else
                                    <img src="{{asset('storage/'.$admin->image)}}" alt="" class="img-thumbnail shadow " >
                                    @endif
                                </td>
                                <td class="col-2">{{$admin->name}}</td>
                                <td class="col-2">{{$admin->email}}</td>
                                <td class="col-2">{{$admin->gender}}</td>
                                <td class="col-2">{{$admin->address}}</td>
                                <td class="col-2">
                                    {{-- delete acc except owner  --}}
                                    @if (Auth::user()->id == $admin->id)

                                    @else
                                        <div class="d-flex">
                                            {{-- ------change role-----  --}}
                                            <div class="dropdown me-3">
                                                <a href="#" class="btn btn-sm btn-primary rounded dropdown-toggle"  data-bs-toggle="dropdown">
                                                Change Role
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-dark">
                                                    <a href="{{route('admin#changeRole',['user',$admin->id])}}"  name="user" class="dropdown-item">User</a>
                                                    <a href="{{route('admin#changeRole',['admin', $admin->id])}}"  name="admin" class="dropdown-item">Admin</a>
                                                </div>
                                            </div>
                                            {{-- ---------change role end-----------  --}}

                                            <div class="table-data-feature">
                                                <button id="delete-btn" onclick="location='{{route('admin#delete', $admin->id)}}'" class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete fs-4"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                </td>

                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$admins->links()}}
                    </div>
                </div>
                <!-- END DATA TABLE -->

                @else
                    <h3 class="text-secondary text-center mt-5">There is no products</h3>
                @endif


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


