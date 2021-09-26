<section class="mb_overview_hd {{isset($tabname)?'short':''}} waypoint">
    <div class="common_wrap">
      <div class="mb_hd_top">
        <div class="mb_hd_pic"><img src="{{basefunction::RealFiles($memberdata['avatar'])}}" alt=""/></div>
        <div class="mb_hd_ct">
          <div class="hd_title"> 
            <p>{{$memberdata['name']}}, </p>
            <p>{{$Setting['MemberCenter']->bak_title_1}}</p>
          </div>
          <div class="hd_p">{{$Setting['MemberCenter']->bak_title_2}}</div>
        </div>
      </div>
      <div class="mb_hd_btn"><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberCenter']->bak_title_3}}" logoutact>{{$Setting['MemberCenter']->bak_title_3}}</a><a class="czbtn" href="{{basefunction::b_url('Member')}}" data-text="{{$Setting['MemberCenter']->bak_title_4}}">{{$Setting['MemberCenter']->bak_title_4}}</a></div>
    </div>
</section>