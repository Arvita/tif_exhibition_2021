@extends('layouts.admin._admin')

@section('content')
<section class="content col">
    <form method="post" enctype="multipart/form-data" action="{{ isset($product) ? route('product.update', $id) : route('product.store') }}">
        {{ csrf_field() }}
        <!-- {{ method_field('PATCH') }} -->
        {!! isset($product) ? method_field('PATCH') : '' !!}
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
                    <label for="name" class="col-sm-2 control-label">Nama Group</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nama Group" value="{{ isset($product)? $product->group_name : '' }}">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('name') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="leader" class="col-sm-2 control-label">Ketua Kelompok</label>
                            <div class="col-sm-4">
                                <input type="text" id="leader" name="leader" class="form-control{{ $errors->has('leader') ? ' is-invalid' : '' }}" placeholder="Ketua Kelompok" value="{{ isset($product) ? $product->group_leader : '' }}">
                                @if ($errors->has('leader'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('leader') }}</p>
                                </span>
                                @endif
                            </div>
                            <label for="nim" class="col-sm-1 control-label">NIM Ketua</label>
                            <div class="col-sm-5">
                                <input type="text" id="nim" name="nim" class="form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" placeholder="NIM Ketua" value="{{ isset($product)? $product->group_leader_nim : ''}}">
                                @if ($errors->has('nim'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('nim') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="semester" class="col-sm-2 control-label">Semester</label>
                            <div class="col-sm-4">
                                <!-- <input type="text" id="semester" name="semester" class="form-control{{ $errors->has('semester') ? ' is-invalid' : '' }}" placeholder="Semester" value="{{  isset($product)? $product->semester : '' }}"> -->
                                <select name="semester" id="semester" class="select2 form-control{{ $errors->has('semester') ? ' is-invalid' : '' }}">
                                    <option value="2" {{ isset($product) && $product->semester == '2' ? 'selected' : '' }}>2</option>
                                    <option value="4" {{ isset($product) && $product->semester == '4' ? 'selected' : '' }}>4</option>
                                    <option value="6" {{ isset($product) && $product->semester == '6' ? 'selected' : '' }}>6</option>
                                </select>
                                @if ($errors->has('semester'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('semester') }}</p>
                                </span>
                                @endif
                            </div>
                            <label for="group_class" class="col-sm-1 control-label">Golongan</label>
                            <div class="col-sm-5">
                                <input type="text" id="group_class" name="group_class" class="form-control{{ $errors->has('group_class') ? ' is-invalid' : '' }}" placeholder="Golongan" value="{{  isset($product)? $product->group_class : ''}}">
                                @if ($errors->has('group_class'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('group_class') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member" class="col-sm-2 control-label">Anggota Kelompok</label>
                    <div class="col-sm-10">
                        <textarea id="member" name="member" class="form-control{{ $errors->has('member') ? ' is-invalid' : '' }}" placeholder="Anggota Kelompok" rows="2">{{ isset($product)? $product->group_member : '' }}</textarea>
                        @if ($errors->has('member'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('member') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Judul" value="{{  isset($product)? $product->title : '' }}">
                        @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('title') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea id="description" name="description" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" rows="3">{{ isset ($product) ? $product->description : '' }}</textarea>
                        @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('description') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="platform" class="col-sm-2 control-label">Platform</label>
                            <div class="col-sm-4">
                                <input type="text" id="platform" name="platform" class="form-control{{ $errors->has('platform') ? ' is-invalid' : '' }}" placeholder="Platform" value="{{  isset($product)? $product->platform : '' }}">
                            </div>
                            <label for="category" class="col-sm-1 control-label">Category</label>
                            <div class="col-sm-5">
                                <select name="category" id="category" class="select2 form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                                    @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}" {{   isset($product) && $product->category == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('category') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">Group Email</label>
                            <div class="col-sm-4">
                                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Group Email" value="{{  isset($product)? $product->group_email : ''}}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('email') }}</p>
                                </span>
                                @endif
                            </div>
                            <label for="phone" class="col-sm-1 control-label">Group Phone</label>
                            <div class="col-sm-5">
                                <input type="text" id="phone" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Group Phone" value="{{  isset($product)? $product->group_phone : '' }}">
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('phone') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="link_web" class="col-sm-2 control-label">Link Web</label>
                            <div class="col-sm-4">
                                <input type="text" id="link_web" name="link_web" class="form-control{{ $errors->has('link_web') ? ' is-invalid' : '' }}" placeholder="Link Web" value="{{  isset($product)? $product->link_web : '' }}">
                                @if ($errors->has('link_web'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('link_web') }}</p>
                                </span>
                                @endif
                            </div>
                            <label for="link_mobile" class="col-sm-1 control-label">Link Mobile</label>
                            <div class="col-sm-5">
                                <input type="text" id="link_mobile" name="link_mobile" class="form-control{{ $errors->has('link_mobile') ? ' is-invalid' : '' }}" placeholder="Link Mobile" value="{{  isset($product)? $product->link_mobile : '' }}">
                                @if ($errors->has('link_mobile'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('link_mobile') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="link_desktop" class="col-sm-2 control-label">Link Desktop</label>
                            <div class="col-sm-4">
                                <input type="text" id="link_desktop" name="link_desktop" class="form-control{{ $errors->has('link_desktop') ? ' is-invalid' : '' }}" placeholder="Link Desktop" value="{{  isset($product)? $product->link_desktop : '' }}">
                                @if ($errors->has('link_desktop'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('link_desktop') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="link_video" class="col-sm-2 control-label">ID Youtube Video</label>
                            <div class="col-sm-4">
                                <input type="text" id="link_video" name="link_video" class="form-control{{ $errors->has('link_video') ? ' is-invalid' : '' }}" placeholder="ID Youtube Video" value="{{  isset($product)? $product->link_video : ''}}">
                                @if ($errors->has('link_video'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('link_video') }}</p>
                                </span>
                                @endif
                            </div>
                            <label for="picture" class="col-sm-1 control-label">Featured Picture</label>
                            <div class="col-sm-5">
                                <input type="file" id="picture" name="picture" class="form-control{{ $errors->has('picture') ? ' is-invalid' : '' }}" value="{{  isset($product)? old('picture') : '' }}">
                                @if ($errors->has('picture'))
                                <span class="invalid-feedback">
                                    <p>{{ $errors->first('picture') }}</p>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="showthumbnail" class="col-sm-2 control-label">Thumbnail</label>
                            <div class="col-sm-4">
                                @isset($product)
                                <a href="https://youtu.be/{{ $product->link_video }}" target="_blank" id="youtube_link">
                                    <img src="https://img.youtube.com/vi/{{ $product->link_video }}/0.jpg" id="showthumbnail" alt=" " height="100">
                                </a>
                                @endisset
                            </div>
                            <label for="showgambar" class="col-sm-1 control-label">Preview</label>
                            <div class="col-sm-5">
                                @isset($product)
                                <img src="{{ url(asset('img/products/'.$product->featured_picture)) }}" id="showgambar" alt=" " height="100">
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="link_instagram" class="col-sm-4 control-label">Link Instagram</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="link_instagram" name="link_instagram" class="form-control{{ $errors->has('link_instagram') ? ' is-invalid' : '' }}" placeholder="Link Instagram" value="{{  isset($product)? $product->link_ig_poster : '' }}">
                                        @if ($errors->has('link_instagram'))
                                        <span class="invalid-feedback">
                                            <p>{{ $errors->first('link_instagram') }}</p>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="showinstagram" class="col-sm-4 control-label">Instagram Preview</label>
                                    <div class="col-sm-8">
                                        @isset($product)
                                        <iframe id="instagram-embed-0" class="instagram-media instagram-media-rendered border" src="{{ $product->link_ig_poster }}embed" height="581px" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen" data-instgrm-payload-id="instagram-media-payload-0" style="min-height: 506px"></iframe>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                @isset($product)
                                <?php $gallery = App\Models\Gallery::where('product_id', $product->id)->orderBy('picture', 'asc')->get() ?>
                                @endisset
                                {{-- Screenshot 1 --}}
                                <div class="form-group row">
                                    <label for="ss_1" class="col-sm-2 control-label">Screenshot 1</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="ss_1" name="ss_1" data-id="1" class="form-control{{ $errors->has('ss_1') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('ss_1'))
                                        <span class="invalid-feedback">
                                            <p>{{ $errors->first('ss_1') }}</p>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <img src="{{ url(asset('img/screenshots/'.@$gallery[0]->picture)) }}" id="showss1" alt=" " height="100">
                                    </div>
                                </div>
                                {{-- Screenshot 2 --}}
                                <div class="form-group row">
                                    <label for="ss_2" class="col-sm-2 control-label">Screenshot 2</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="ss_2" name="ss_2" data-id="2" class="form-control{{ $errors->has('ss_2') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('ss_2'))
                                        <span class="invalid-feedback">
                                            <p>{{ $errors->first('ss_2') }}</p>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <img src="{{ url(asset('img/screenshots/'.@$gallery[1]->picture)) }}" id="showss2" alt=" " height="100">
                                    </div>
                                </div>
                                {{-- Screenshot 3 --}}
                                <div class="form-group row">
                                    <label for="ss_3" class="col-sm-2 control-label">Screenshot 3</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="ss_3" name="ss_3" data-id="3" class="form-control{{ $errors->has('ss_3') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('ss_3'))
                                        <span class="invalid-feedback">
                                            <p>{{ $errors->first('ss_3') }}</p>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <img src="{{ url(asset('img/screenshots/'.@$gallery[2]->picture)) }}" id="showss3" alt=" " height="100">
                                    </div>
                                </div>
                                {{-- Screenshot 4 --}}
                                <div class="form-group row">
                                    <label for="ss_3" class="col-sm-2 control-label">Screenshot 4</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="ss_4" name="ss_4" data-id="4" class="form-control{{ $errors->has('ss_4') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('ss_4'))
                                        <span class="invalid-feedback">
                                            <p>{{ $errors->first('ss_4') }}</p>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <img src="{{ url(asset('img/screenshots/'.@$gallery[3]->picture)) }}" id="showss4" alt=" " height="100">
                                    </div>
                                </div>
                            </div>
                        </div>
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
@push('content-css')
@endpush
@push('content-js')
@endpush