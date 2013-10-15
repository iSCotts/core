@extends('core::admin.layout')

@section('title')
  {{ Lang::get('core::lazychef.forgot_password') }}
@stop

@section('content')
  <div id="login-region">
    <h1>{{ Lang::get('core::lazychef.forgot_password') }}</h1>
    @if (Session::has('error'))
      <div class="alert alert-block alert-error">
        <p>{{ trans(Session::get('core::reason')) }}</p>
      </div>
    @elseif (Session::has('success'))
      <div class="alert alert-block alert-success">
        <p>{{ Lang::get('core::lazychef.forgot_sent') }}</p>
      </div>
    @endif

    <form method="post" action="/lazychef/login/remind" class="form-horizontal">
      <p><input type="text" id="inputEmail" name="email" placeholder="{{ Lang::get('core::lazychef.account_email') }}"></p>
      <button type="submit" class="btn">{{ Lang::get('core::lazychef.forgot_send') }}</button>
      </div>
    </form>
  </div>
@stop
