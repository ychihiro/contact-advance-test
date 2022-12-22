@extends('layouts.default')

@section('title', 'お問い合わせ')

@section('pageCss')
<link rel="stylesheet" href="../../../css/index.css">
@endsection

@section('content')
<div class="form-wrapper">
  <form action="{{ route('contact.confirm') }}" method="POST">
    @csrf
    <div class="form-item">
      <label class="form-label">
        お名前<span class="form-required">※</span>
      </label>
      <div>
        <input type="text" id="firstname" name="firstname" class="input-name" value="{{ old('firstname') }}">
        <input type="text" id="lastname" name="lastname" class="input-name" value="{{ old('lastname') }}">
        <input type="hidden" name="fullname" id="fullname" value="{{ old('fullname') }}">
      </div>
    </div>
    @error('fullname')
    <p class="error-name">{{$message}}</p>
    @enderror
    <div class="example-wrapper-name">
      <p class="example-firstname">
        <span class="example">例)</span>山田
      </p>
      <p class="example-lastname">
        <span class="example">例)</span>太郎
      </p>
    </div>
    <div class="form-item-gender">
      <label class="form-label-gender">
        性別<span class="form-required">※</span>
      </label>
      <div class="gender-check-wrapper">
        <div class="gender-check">
          <input type="radio" name="gender" id="radio-man" value="1" class="radio-input" checked {{ old('gender') == '1' ? 'checked' : '' }}>
          <label for="radio-man" class="radio-label">男性</label>
        </div>
        <div class="form-check">
          <input type="radio" name="gender" id="radio-woman" value="2" class="radio-input" {{ old('gender')=='2' ? 'checked' : '' }}>
          <label for="radio-woman" class="radio-label">女性</label>
        </div>
      </div>
    </div>
    @error('gender')
    <p class="error-gender">{{$message}}</p>
    @enderror
    <div class="form-item">
      <label class="form-label">
        メールアドレス<span class="form-required">※</span>
      </label>
      <input type="email" name="email" class="input-email" value="{{ old('email') }}">
    </div>
    @error('email')
    <p class="error-email">{{$message}}</p>
    @enderror
    <p class="example-email">
      <span class="example">例)</span>test@example.com
    </p>
    <div class="form-item">
      <label class="form-label">
        郵便番号<span class="form-required">※</span>
      </label>
      <div>
        <span class="postcode-mark">〒</span>
        <input type="text" name="postcode" class="input-postcode" value="{{ old('postcode') }}">
      </div>
    </div>
    @error('postcode')
    <p class="error-postcode">{{$message}}</p>
    @enderror
    <p class="example-postcode">
      <span class="example">例)</span>123-4567
    </p>
    <div class="form-item">
      <label class="form-label">
        住所<span class="form-required">※</span>
      </label>
      <input type="text" name="address" id="address" class="input-address" value="{{ old('address') }}">
    </div>
    @error('address')
    <p class="error-address">{{$message}}</p>
    @enderror
    <p class="example-address"><span class="example">例)</span>東京都渋谷区千駄ヶ谷1-2-3</p>
    <div class="form-item">
      <label class="form-label">
        建物名
      </label>
      <input type="text" name="building_name" class="input-building" value="{{ old('building_name') }}">
    </div>
    <p class="example-building">
      <span class="example">例)</span>例)千駄ヶ谷マンション101
    </p>
    <div class="form-item-opinion">
      <label class="form-label">
        ご意見<span class="form-required">※</span>
      </label>
      <textarea name="opinion" class="input-opinion">{{ old('opinion') }}</textarea>
    </div>
    @error('opinion')
    <p class="error-opinion">{{$message}}</p>
    @enderror
    <input type="submit" value="確認" class="confirm-btn">
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
<script src="../../../../js/main.js"></script>
@endsection