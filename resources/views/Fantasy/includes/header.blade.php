<div class="header">
  <div class="blockCover">
    <div class="blockLogo">
      <p>{{ $unitTitle }}</p>
    </div>
    @if(!empty($unitSubTitle))
      <div class="blockName">
        <p>{{ $unitSubTitle }}</p>
      </div>
    @endif
  </div>
    <div class="inforCover">
        <!-- START User Info-->
        <div class="projectName">{{ Config::get('app.name') }}</div>
        <a href="http://{{str_replace('www.','',preg_match("/preview./",$_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'preview.'.$_SERVER['HTTP_HOST'])}}" target="is_blank" class="previewButton" data-toggle="tooltip" data-placement="bottom" data-original-title="前往預覽未正式發佈的網站內容">PREVIEW</a>
        <div class="userName">
            <span class="">{{ Session::get('fantasy_user')['name'] }}</span>
        </div>
        <div class="userPhoto dropdown">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline">
                    <?php
                        $photo = BaseFunction::RealFiles($FantasyUser['photo_image']);
                        $realphoto = !empty($photo) ? $photo : asset('/vender/assets/img/profiles/wdd.jpg');
                    ?>
                    <img src="{{$realphoto}}" alt="" data-src="{{$realphoto}}" data-src-retina="{{$realphoto}}" width="32" height="32">
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                {{-- <a href="javascript:;" class="dropdown-item">
                <i class="pg-settings_small"></i> Settings</a>
                <a href="javascript:;" class="dropdown-item">
                <i class="pg-outdent"></i> Feedback</a>
                <a href="javascript:;" class="dropdown-item">
                <i class="pg-signals"></i> Help</a> --}}
                <a href="javascript:basic_logout();" class="clearfix bg-master-lighter dropdown-item">
                <span class="pull-left">Logout</span>
                <span class="pull-right">
                    <i class="pg-power"></i>
                </span>
                </a>
            </div>
        </div>
    </div>
</div>