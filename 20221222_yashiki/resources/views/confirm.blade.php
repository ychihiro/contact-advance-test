@extends('layouts.default')

@section('title', '内容確認')

@section('pageCss')
<link rel="stylesheet" href="../../../css/confirm.css">
@endsection

@section('content')
<div class="confirm-wrapper">
  <form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <table class="confirm-table">
      <tr>
        <th class="confirm-ttl">お名前</th>
        <td class="confirm-item">{{$form['firstname']}}&emsp;{{$form['lastname']}}</td>
        <input type="hidden" name="firstname" value="{{$form['firstname'] }}">
        <input type="hidden" name="lastname" value="{{$form['lastname'] }}">
        <input type="hidden" name="fullname" value="{{ $form['fullname'] }}">
      </tr>
      <tr>
        <th class="confirm-ttl">性別</th>
        <td class="confirm-item">
          @if($form['gender'] == 1)
          <p>男性</p>
          @elseif($form['gender'] == 2)
          <p>女性</p>
          @endif
        </td>
        <input type="hidden" name="gender" value="{{ $form['gender'] }}">
      </tr>
      <tr>
        <th class="confirm-ttl">メールアドレス</th>
        <td class="confirm-item">{{$form['email']}}</td>
        <input type="hidden" name="email" value="{{ $form['email'] }}">
      </tr>
      <tr>
        <th class="confirm-ttl">郵便番号</th>
        <td class="confirm-item">〒{{$form['postcode']}}</td>
        <input type="hidden" name="postcode" value="{{ $form['postcode'] }}">
      </tr>
      <tr>
        <th class="confirm-ttl">住所</th>
        <td class="confirm-item">{{$form['address']}}</td>
        <input type="hidden" name="address" value="{{ $form['address'] }}">
      </tr>
      <tr>
        <th class="confirm-ttl">建物名</th>
        <td class="confirm-item">{{$form['building_name']}}</td>
        <input type="hidden" name="building_name" value="{{ $form['building_name'] }}">
      </tr>
      <tr class="confirm-opinion">
        <th class="confirm-ttl">ご意見</th>
        <td class="confirm-item">{{$form['opinion']}}</td>
        <input type="hidden" name="opinion" value="{{ $form['opinion'] }}">
      </tr>
    </table>
    <button type="submit" name="action" value="submit" class="send-btn">
      送信する
    </button>
    <button type="submit" name="action" value="back" class="back-btn">
      入力内容修正
    </button>
  </form>
</div>
@endsection