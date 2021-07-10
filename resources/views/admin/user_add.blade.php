@extends('layouts.admin._admin')

@section('content')
<section class="content col">
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $data['title'] }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('name') }}</p>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('email') }}</p>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="username" id="username" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('username') }}</p>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-2 control-label">User Role</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control select2nosearch{{ $errors->has('role') ? ' is-invalid' : '' }}" style="width: 100%;">
                        <option value="1">Officer</option>
                        <option value="0">Admin</option>
                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('role') }}</p>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                    <input type="file" id="avatar" name="avatar" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}" value="{{ old('avatar') }}">
                    @if ($errors->has('avatar'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('avatar') }}</p>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="showgambar" class="col-sm-2 control-label">Preview</label>
                <div class="col-sm-10">
                    <img src="{{ asset('img/no-picture.jpg') }}" id="showgambar" alt=" " height="100">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Simpan</button>
            <button type="button" class="btn btn-default" onclick="history.go(-1)" id="batal">Batal</button>
        </div>
    </div>
    </form>
</section>
@endsection