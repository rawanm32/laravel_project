@extends('layouts.dashboard')
@section('title')
{{__('Edit')}}
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
       
          <div class="col-md-12">
         
            <div class="card card-primary">
              
          
               @if($errors->any())
               <div class="alert alert-danger">
              
                  @foreach($errors->all() as $error)
                   <ul><li>{{$error}}</li></ul>
                  @endforeach
                  
                
               </div>
               @endif
              <form action="{{route('dashboard.users.update',[$user->id])}}" method="POST">
                @csrf
                 @method('PUT')
              @include('dashboard.pages.users._form')
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
  </div>
</div>

@endsection
@push('styles')
<style>
  .alert{
    margin-top:10px;
  }
</style>
@endpush