@extends ('layouts.dashboard')

@section('title', ' {{__('Create')}}')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                     
                        <p class="card-category"> {{__('Create')}}</p>
                    </div>
                    
                    <div class="card-body">
                      
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('dashboard.users.store') }}">
                            @csrf 
                            
                          
                            @php $user = new \App\Models\User(); @endphp
                            
                            @include('dashboard.pages.users._form',['user'=>$user])
                            
                            <button type="submit" class="btn btn-primary pull-right">{{__('Save')}} </button>
                            
                         
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-default pull-right">{{__('Cancel')}}</a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection