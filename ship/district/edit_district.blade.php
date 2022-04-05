@extends('admin.admin_master')

@section('admin')


<br>

<div class="col-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add District</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
                
            
            <form method="POST" action="{{ route('district.update','$dis->id') }}" >
                @csrf 
                <input type="hidden" name="id" value="{{ $dis->id }}">
                <div class="row">
                   <div class="col-12">						
                       
                    <div class="form-group">
                        <h5>Division Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="division_id" id="select" required class="form-control">
                                <option value="" selected="" disabled="" >Select Your Division</option>
                                @foreach($division as $divi)
                                <option value="{{ $divi -> id }}"  {{ $divi->id == $dis->division_id ? 'selected' : ''}}>{{ $divi ->division_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('division_id')
                        <span class="text-danger">{{ $message}}</span>
                            
                        @enderror
                    </div> 



                            <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="district_name"  class="form-control" value="{{ $dis->district_name }}"> </div>
                                    @error('division_name')
                                    <span class="text-danger">{{ $message}}</span>
                                        
                                    @enderror
                            
                                </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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