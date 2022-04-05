@extends('admin.admin_master')

@section('admin')


  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">State List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Division Name</th>
                              <th>District Name</th>
                              <th>State Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($state as $state)
                          <tr>
                              <td>{{ $state->division_id }}</td>
                              <td>{{ $state->district_id }}</td>
                              <td>{{ $state->state_name }}</td>
                              
                              
                              <td width="40%">

                                {{-- <a href="{{ route('district.edit',$district->id) }}" class="btn btn-info"><i class="fa fa-pencil" title="Edit Data"></i></a>
                                <a href="{{ route('district.delete',$district->id) }}" id="delete" class="btn btn-danger"><i class="fa fa-trash" title="Delete Data"></i></a> --}}

                                

                              </td>
                          </tr>
                          @endforeach
                          
                      
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->division

            
            <!-- /.box -->          
          </div>


{{-- ---------------------Add Brands------------------ --}}


<div class="col-4">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add State</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
                
            
            <form method="POST" action="{{ route('state.store') }}" >
                @csrf 
                <div class="row">
                   <div class="col-12">						
                       
                    <div class="form-group">
                        <h5>Division Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="division_id" id="select" required class="form-control">
                                <option value="" selected="" disabled="" >Select Your Division</option>
                                @foreach($division as $divi)
                                <option value="{{ $divi -> id }}" >{{ $divi ->division_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('division_id')
                        <span class="text-danger">{{ $message}}</span>
                            
                        @enderror
                    </div> 

                    <div class="form-group">
                        <h5>District Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="district_id" id="select" required class="form-control">
                                <option value="" selected="" disabled="" >Select Your District</option>
                                @foreach($district as $dis)
                                <option value="{{ $dis -> id }}" >{{ $dis ->district_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('district_id')
                        <span class="text-danger">{{ $message}}</span>
                            
                        @enderror
                    </div> 



                            <div class="form-group">
                                <h5>State Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="state_name"  class="form-control"  > </div>
                                    @error('state_name')
                                    <span class="text-danger">{{ $message}}</span>
                                        
                                    @enderror
                            
                                </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                            </div>
           
       <!-- /.box-body -->
     </div>
     <!-- /.box -->

     
     <!-- /.box -->          
   </div>


          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>

<!-- /.content-wrapper -->

@endsection