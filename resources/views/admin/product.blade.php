@extends('layouts.admin._admin')

@section('content')
<section class="content col">
    <div class="card">
        <div class="card-header">
        @if(Auth::user()->role == 1)
            <h3 class="card-title"><a href="{{ route('product.add') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a></h3>
        @endif
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table width="100%" class='datatables table table-striped table-bordered table-hover dt-responsive' id='dataproduct'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Leader</th>
                        <th>Leader NIM</th>
                        <th>Member</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Semester / Class</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Platform</th>
                        <th>Featured Image</th>
                        <th>Link Video</th>
                        <th>Link Web</th>
                        <th>Link Mobile</th>
                        <th>Link Desktop</th>
                        <th>Link Instagram</th>
                        <th>Screenshot</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin akan menghapus data ini?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Batal</button>
                <form id="delete-form" action="" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger" id="delete">
                        <i class="icon-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection