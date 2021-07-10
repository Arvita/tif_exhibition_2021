@extends('layouts.admin._admin')

@section('content')
<section class="content col">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['dua_num'] }}</h3>
    
                    <p>Semester 2</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{ url('admin/product') }}" class="small-box-footer">Goto Product <i class="icofont-circled-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                <h3>{{ $data['empat_num'] }}</h3>
    
                    <p>Semester 4</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{ url('admin/product') }}" class="small-box-footer">Goto Product <i class="icofont-circled-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{ $data['enam_num'] }}</h3>
    
                    <p>Semester 6</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{ url('admin/agenda') }}" class="small-box-footer">Goto Product <i class="icofont-circled-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{ $data['user_num'] }}</h3>
    
                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="{{ url('admin/user') }}" class="small-box-footer">Goto User <i class="icofont-circled-right"></i></a>
            </div>
        </div> 
        
    </div>
</section>
@endsection