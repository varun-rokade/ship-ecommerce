@extends('admin.admin_master')

@section('admin')


<br>
<br>
<div class="col-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add Divsion</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
                
            
            <form method="POST" action="{{ route('division.update',$div->id) }}" >
                @csrf 
                <input type="hidden" name="id" value="{{$div->id}}">
                <div class="row">
                   <div class="col-12">						
                       
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="division_name"  class="form-control" value="{{$div->division_name}}" > </div>
                                    @error('division_name')
                                    <span class="text-danger">{{ $message}}</span>
                                        
                                    @enderror
                            
                                </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Division">
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
<br>
@endsection