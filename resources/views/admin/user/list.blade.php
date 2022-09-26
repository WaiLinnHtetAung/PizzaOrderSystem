@extends('admin.layouts.master')

@section('title', 'Order List')

@section('search-bar')
    <form class="form-header" action="{{route('products#list')}}" method="get">
        <input class="au-input au-input--xl" type="text" name="search_product" value="{{request('search_product')}}" placeholder="Search for datas &amp; reports..." />
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
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>

                    <div class="table-data__tool-right">
                        <div class="h3 text-primary">
                            Total - {{$users->total()}}
                        </div>
                    </div>

                </div>

                {{-- @if (count($products) != 0 ) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" id="userId" value="{{$user->id}}">
                                    <td class="col-2" >
                                        @if ($user->image == null)
                                            @if($user->gender == 'male')
                                                <img src="{{asset('admin/images/default_user.png')}}" class="img-thumbnail shadow " alt="">
                                            @else
                                                <img src="{{asset('admin/images/female-default.jpg')}}" class="img-thumbnail shadow " alt="">
                                            @endif
                                        @else
                                        <img src="{{asset('storage/'.$user->image)}}" alt="" class="img-thumbnail shadow " >
                                        @endif
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->address}}</td>
                                    <td class="col-3">
                                        <select name="role" class="form-select userChange" >
                                            <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                                            <option value="user" @if($user->role=='user') selected @endif>User</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$users->links()}}
                    </div>
                </div>
                <!-- END DATA TABLE -->

                {{-- @else
                    <h3 class="text-secondary text-center mt-5">There is no products</h3>
                @endif --}}


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('adminScripts')
    <script>
        $(document).ready(function() {
            $('.userChange').click(function() {
                $role = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $.ajax({
                    type : 'get',
                    url : "{{route('user#change')}}",
                    data : {
                        'role' : $role,
                        'userId' : $userId,
                    },
                })
                location.reload();

            })
        })
    </script>
@endsection



