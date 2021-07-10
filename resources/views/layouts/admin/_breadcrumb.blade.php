<!-- Content Header (Page header) -->
<div class="content-header bg-white border-bottom py-2 mb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 font-weight-bold text-dark">{{ @$data['title'] }} <span class="small text-muted">{{ @$data['subtitle'] }}</span></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right small">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Beranda</a></li>
                    @if ($data['npage'] !== 0)
                        <li class='breadcrumb-item active'>{{ @$data['title'] }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>