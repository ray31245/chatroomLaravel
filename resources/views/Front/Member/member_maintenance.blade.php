@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/member.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'member')
@section('bodyDataPage', 'member_maintenance')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      @include('Front.Member.Component.center_name_block')
      <section class="mb_ct">
        <div class="common_wrap">
          @include('Front.Member.Component.center_sub_unit')
          <div class="maintenance_ct waypoint">
            <div class="block">
              <div class="block_title">
                <div class="num"><span class="icon-repair"></span></div>
                <h1 class="block_name">{{$Setting['MemberMaintenance']->bak_title_1}}</h1>
              </div>
              <div class="maintenance_table">
                <div class="mt_tablehd">
                  <div class="mt_id"> 
                    <p>{{$Setting['MemberMaintenance']->bak_title_2}}</p>
                  </div>
                  <div class="mt_detail"></div>
                  <div class="mt_date">
                    <div class="dropdown member">
                      <div class="dropdown_click">
                        <div class="dropdown_title">{{$Setting['MemberMaintenance']->bak_title_3}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="dropdown_select">
                        <div class="dropdown_opt scroll scrollbar-inner theme-yellow">
                          <ul>
                            <li year="all">{{$Setting['MemberMaintenance']->bak_title_4}}</li>
                            @foreach ($year_list as $item)
                              <li year={{$item}}>{{$item}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt_status">
                    <div class="dropdown member">
                      <div class="dropdown_click">
                        <div class="dropdown_title">{{$Setting['MemberMaintenance']->bak_title_5}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="dropdown_select">
                        <div class="dropdown_opt scroll scrollbar-inner theme-yellow">
                          <ul>
                            <li status_id="all">{{$Setting['MemberMaintenance']->bak_title_6}}</li>
                            @foreach ($status as $key => $value)
                              <li status_id={{$key}}>{{$value->title}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt_tablect" caselist>
                  @foreach ($service_record as $key => $value)
                  <div caseid="{{$value->id}}" caseyear="{{$value->created_at->year}}" casestatus={{$value->status_id}} class="mt_list {{$value->status_id==$status->last()->id?'cancel':''}}">
                    <div class="mt_id"><a opcase class="mt_btn" href="javascript:;">{{$value->case_sn}}</a></div>
                    <div class="mt_detail">
                      <div class="dt_list">
                        <div class="dt_title">{{$Setting['MemberMaintenance']->bak_title_7}}</div>
                        <div class="dt_p">{{$model[$value->model_id]->title}}</div>
                      </div>
                      <div class="dt_list">
                        <div class="dt_title">{{$Setting['MemberMaintenance']->bak_title_8}}</div>
                        <div class="dt_p">{{$subject[$value->subject_id]->title}}</div>
                      </div>
                      <div class="dt_list">
                        <div class="dt_p">{{$value->message}}</div>
                      </div>
                      <div class="dt_list">
                        <div class="dt_title">{{$Setting['MemberMaintenance']->bak_title_9}}</div>
                        <div class="dt_p">{{$time[$value->time]->title}}</div>
                      </div>
                      @if ($value->warranty_card_number)
                      <div class="dt_list">
                        <div class="dt_title">{{$Setting['MemberMaintenance']->bak_title_10}}</div>
                        <div class="dt_p">{{$value->warranty_card_number}}</div>
                      </div>
                      @endif
                    </div>
                    <div class="mt_date">
                      <p>{{date('Y - m - d',strtotime($value->created_at))}}</p>
                    </div>
                    <div class="mt_status">
                      <p>{{$status[$value->status_id]->title}}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/member.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop