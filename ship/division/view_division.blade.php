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
                <h3 class="box-title">Division List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Division Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($division as $division)
                          <tr>
                              <td>{{ $division->division_name }}</td>
                              
                              
                              <td width="40%">

                                <a href="{{ route('division.edit',$division->id) }}" class="btn btn-info"><i class="fa fa-pencil" title="Edit Data"></i></a>
                                <a href="{{ route('division.delete',$division->id) }}" id="delete" class="btn btn-danger"><i class="fa fa-trash" title="Delete Data"></i></a>

                                

                              </td>
                          </tr>
                          @endforeach
                          
                      
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            
            <!-- /.box -->          
          </div>


{{-- ---------------------Add Brands------------------ --}}


<div class="col-4">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add Divsion</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
                
            
            <form method="POST" action="{{ route('division.store') }}" >
                @csrf 
                <div class="row">
                   <div class="col-12">						
                       
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="division_name"  class="form-control"  > </div>
                                    @error('division_name')
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