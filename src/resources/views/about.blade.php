@extends('web::layouts.grids.4-4-4')

@section('title', trans('moonbot::moonbot.moonbot'))
@section('page_header', trans('moonbot::moonbot.moonbot'))
@section('page_description', trans('moonbot::moonbot.moonbot_about'))

@push('head')
<link rel = "stylesheet"
   type = "text/css"
   href = "https://snoopy.crypta.tech/snoopy/seat-moonbot-about.css" />
@endpush

@section('left')

  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Functionality</h3>
    </div>
    <div class="card-body">

     <p>This plugin provides a very simple and configurable API that provides details on moon mining extractions</p>

     
    </div>
  </div>
@stop

@section('center')

  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">THANK YOU!</h3>
    </div>
    <div class="card-body">
      <div class="box-body">

        <p> Both <strong>SeAT</strong> and <strong>MoonBot</strong> are community creations designed to benefit you! I sincerely hope you enjoy using them. If you are feeling generous then please feel free to front up some isk to either of the projects.</p>

        <p>
            <table class="table table-borderless">
                <tr> <td>MoonBot</td> <td> <a href="https://evewho.com/character/96057938"> {!! img('characters', 'portrait', 96057938, 64, ['class' => 'img-circle eve-icon small-icon']) !!} Crypta Electrica</a></td></tr>

                <tr> <td>Seat</td> <td> <a href="https://evewho.com/corporation/98482334"> {!! img('corporations', 'logo', 98482334, 64, ['class' => 'img-circle eve-icon small-icon']) !!} eveseat.net</a></td></tr>
            </table>
        </p>

        <p> If you are one of those people who feels ISK is never enough..... I will just drop this here.... my <a href="https://www.patreon.com/cryptaelectrica"> patreon</a>.</p>
        </div>
    </div>
    <div class="card-footer text-muted">
        Plugin maintained by <a href="{{ route('moonbot.about') }}"> {!! img('characters', 'portrait', 96057938, 64, ['class' => 'img-circle eve-icon small-icon']) !!} Crypta Electrica</a>. <span class="float-right snoopy" style="color: #fa3333;"><i class="fas fa-signal"></i></span>
    </div>
  </div>

@stop
@section('right')

  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Info</h3>
    </div>
    <div class="card-body">

      <legend>Bugs and Feature Requests</legend>

      <p>If you encounter a bug or have a suggestion, either contact Crypta-Eve on <a href="https://eveseat.github.io/docs/about/contact/">SeAT-Slack</a> or submit an <a href="https://github.com/Crypta-Eve/seat-moonbot/issues/new">issue on Github</a></p>

    </div>
  </div>

@stop