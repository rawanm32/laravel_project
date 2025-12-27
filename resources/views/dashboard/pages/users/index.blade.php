@extends ('layouts.dashboard')

@section('title', 'إدارة المستخدمين')

@section('content')
    <div class="content">

        <x-alert/> 
        
        <a href="{{ route('dashboard.users.create') }}" ><button class="btn btn-primary m-3">{{__('New')}}</button></a>
         
        <form action="{{ URL::current() }}" method="GET" class="row g-3 align-items-end m-2 mt-3">
    
   
    <div class="col-md-4 mb-3"> 
        <x-form.input 
            type="text" 
            name="name" 
            placeholder="{{__('name')}}" 
            label="Name" 
            value="{{ request('name') }}"  
        />
      
        <div class="col-auto d-flex align-items-end m-4">
        <button type="submit" class="btn btn-primary">
             <i class="material-icons">search</i> {{__('Search')}}
        </button><a href="{{ route('dashboard.users.index') }}" id="resetbtn" class="btn btn-primary">
         {{__('Cancel')}}
        </a>
  
        
    </div>
    </div>


   
</form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                       
                        <div class="card-header card-header-primary">
                            
                  
                            <h4 class="card-title "> إجمالي عدد الموظفين: {{ $users->count() }}</h4>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                              
                                    <thead class=" text-primary">
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Bio')}}</th>
                                        <th >{{__('Total Books')}}</th>  
                                        <th>{{__('Edit')}}</th>
                                        <th>{{__('Delete')}}</th>
                                    </thead>
                                    
                                    <tbody>
                              
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>Empty</td> 
                                            <td> {{ $user->books_count }}</td> 
                                            
                           

                                           

                                        
                                            <td>
                                                <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="material-icons">edit</i> {{__('name')}}
                                                </a>
                                            </td>
                                            
                                      
                                            <td>
                                                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('{{__('Are you sure you want to delete this user?')}}')">
                                                        <i class="material-icons">close</i> {{__('Delete')}}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                   <div class="card-footer py-4">
                            <nav class="d-flex justify-content-between align-items-center" aria-label="Table navigation">
                                
                                <div class="pagination pagination-primary mb-0">
                                    {{ $users->withQueryString()->links('pagination::bootstrap-4') }}
                                </div>
                            </nav>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection