@extends('backend.app')

@section('title', 'Bn Site Settings')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Bn Site Settings</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <!-- form start -->
                    <form action="{{ route('bn-site-settings.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="nav-tabs-custom mb0">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Site Info </a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Meta Info</a></li>
                                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Copyright &amp; Address</a></li>
                                    <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Social Links</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="form-group">
                                            <label for="siteName" class="col-sm-2 control-label">Site Name</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="siteName" id="siteName" placeholder="Site Name" type="text" value="{{ $siteSettings->site_name }}">
                                                @if($errors->has('siteName')) <span class="text-danger">{{ $errors->first('siteName') }}</span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="siteTitle" class="col-sm-2 control-label">Site Title</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="siteTitle" id="siteTitle" placeholder="Site Title">{{ $siteSettings->title }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="favicon" class="col-sm-2 control-label">Favicon</label>
                                            <div class="col-sm-3">
                                                @if($siteSettings->favicon)
                                                    <img src="{{ asset(config('appconfig.commonImagePath').$siteSettings->favicon) }}" alt="Logo" class="img-thumbnail">
                                                @endif
                                                @if($errors->has('favicon'))<span class="text-danger">{{ $errors->first('favicon') }}</span> @endif
                                                <input class="form-control height-auto" name="favicon" id="favicon" type="file" style="height: auto">

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="logo" class="col-sm-2 control-label">Logo</label>
                                            <div class="col-sm-3">
                                                @if($siteSettings->logo)
                                                    <img src="{{ asset(config('appconfig.commonImagePath').$siteSettings->logo) }}" alt="Logo" class="img-thumbnail">
                                                @endif
                                                @if($errors->has('logo'))<span class="text-danger">{{ $errors->first('logo') }}</span> @endif
                                                <input class="form-control height-auto" name="logo" id="logo" type="file" style="height: auto">
                                                <span class="text-muted">(Maximum in 50Kb)</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox pt0">
                                                    <label style="margin-right:40px;"><input name="logoHeader" id="logoHeader" type="checkbox"{{ $siteSettings->logo_header == 1 ? ' checked' : '' }}> Show at header</label>
                                                    <label><input name="logoFooter" id="logoFooter" type="checkbox"{{ $siteSettings->logo_footer == 1 ? ' checked' : '' }}> Show at footer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ogImage" class="col-sm-2 control-label">OG Image</label>
                                            <div class="col-sm-6">
                                                @if($siteSettings->og_image)
                                                    <img src="{{ asset(config('appconfig.commonImagePath').$siteSettings->og_image) }}" alt="Facebook Image" class="img-thumbnail">
                                                @endif
                                                <input class="form-control height-auto" name="ogImage" id="ogImage" type="file" style="height: auto">
                                                    <span class="text-muted">(Dimensions: 600 X 315 pixels | Maximum in 100Kb)</span>
                                                @if($errors->has('ogImage'))<br><span class="text-danger">{{ $errors->first('ogImage') }}</span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="post_ogimage" class="col-sm-2 control-label">Post OG Image</label>
                                            <div class="col-sm-6">
                                                @if($siteSettings->post_ogimage)
                                                    <img src="{{ asset(config('appconfig.ogImagePath').$siteSettings->post_ogimage) }}" alt="Post Og Image" class="img-thumbnail">
                                                @endif
                                                <input class="form-control height-auto" name="post_ogimage" id="post_ogimage" type="file" style="height: auto">
                                                @if($errors->has('post_ogimage'))<br><span class="text-danger">{{ $errors->first('post_ogimage') }}</span> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
                                            <label for="metaKeyword" class="col-sm-2 control-label">Meta Keyword</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="metaKeyword" id="metaKeyword" placeholder="Meta Keyword" type="text" value="{{ $siteSettings->meta_keywords }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="metaDescription" class="col-sm-2 control-label">Meta Description</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="metaDescription" id="metaDescription" placeholder="Meta Description" rows="2">{{ $siteSettings->meta_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        <div class="form-group">
                                            <label for="editorMeta" class="col-sm-2 control-label">Editor Meta</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="editorMeta" id="editorMeta" placeholder="Editor details here" rows="2">{{ $siteSettings->editor_meta }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="copyright" class="col-sm-2 control-label">Copyright</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="copyright" id="copyright" placeholder="Copyright text here" rows="2">{{ $siteSettings->copyright }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="address" id="address" placeholder="Address" rows="2">{{ $siteSettings->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    @php($socialLinks = unserialize($siteSettings->social_links))
                                    <div class="tab-pane" id="tab_4">
                                        <div class="form-group">
                                            <label for="socialLinks[facebook]" class="col-sm-2 control-label">
                                                Facebook
                                            </label>
                                            <div class="col-sm-6" id="fbShow">
                                                <input class="form-control" name="socialLinks[facebook]" id="socialLinks[facebook]" placeholder="Facebook Link" type="text" value="{{ $socialLinks['facebook'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="socialLinks[twitter]" class="col-sm-2 control-label">
                                                Twiiter
                                            </label>
                                            <div class="col-sm-6" id="twitShow">
                                                <input class="form-control" name="socialLinks[twitter]" id="socialLinks[twitter]" placeholder="Twiiter Link" type="text" value="{{ $socialLinks['twitter'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="socialLinks[google]" class="col-sm-2 control-label">
                                                Google Plus
                                            </label>
                                            <div class="col-sm-6" id="gPlusShow">
                                                <input class="form-control" name="socialLinks[google]" id="socialLinks[google]" placeholder="Google Plus Link" type="text" value="{{ $socialLinks['google'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="socialLinks[youtube]" class="col-sm-2 control-label">
                                                Youtube
                                            </label>
                                            <div class="col-sm-6" id="youtubeShow">
                                                <input class="form-control" name="socialLinks[youtube]" id="socialLinks[youtube]" placeholder="Youtube Link" type="text" value="{{ $socialLinks['youtube'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="socialLinks[instagram]" class="col-sm-2 control-label">
                                                Instagram
                                            </label>
                                            <div class="col-sm-6" id="instagramShow">
                                                <input class="form-control" name="socialLinks[instagram]" id="socialLinks[instagram]" placeholder="Instagram Link" type="text" value="{{ $socialLinks['instagram'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="socialLinks[linkedin]" class="col-sm-2 control-label">
                                                Linked In
                                            </label>
                                            <div class="col-sm-6" id="linkedInShow">
                                                <input class="form-control" name="socialLinks[linkedin]" id="socialLinks[linkedin]" placeholder="Linked In Link" type="text" value="{{ $socialLinks['linkedin'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <button type="submit" class="btn btn-info btn-block">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
