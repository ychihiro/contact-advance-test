@extends('layouts.default')

@section('title', '管理システム')

@section('pageCss')
<link rel="stylesheet" href="../../../css/admin.css">
@endsection

@section('content')
<div class="admin-wrapper">
  <div class="search-wrapper">
    <form action="{{ route('contact.search') }}" method="GET">
      @csrf
      <div class="item-wrapper">
        <div class="input-wrapper">
          <label class="name-label">お名前</label>
          <input type="text" name="fullname" class="input-item">
        </div>
        <div class="gender-item">
          <label class="radio-label">性別</label>
          <input type="radio" name="gender" id="radio-all" value="all" class="radio-input" checked>
          <label for="radio-all" class="radio-label">全て</label>
          <input type="radio" name="gender" id="radio-man" value="1" class="radio-input">
          <label for="radio-man" class="radio-label">男性</label>
          <input type="radio" name="gender" id="radio-woman" value="2" class="radio-input">
          <label for="radio-woman" class="radio-label">女性</label>
        </div>
      </div>
      <div class="item-wrapper">
        <div class="input-wrapper-create">
          <label class="register-label">登録日</label>
          <input type="date" name="date_first" class="input-item-create">
          <span class="range">~</span>
          <input type="date" name="date_last" class="input-item-create">
        </div>
      </div>
      <div class="item-wrapper">
        <div class="input-wrapper">
          <label class="email-label">メールアドレス</label>
          <input type="text" name="email" class="input-item">
        </div>
      </div>
      <button type="submit" name="action" value="search" class="search-btn">
        検索
      </button>
      <button type="submit" name="action" value="reset" class="reset-btn">
        リセット
      </button>
    </form>
  </div>
  <div class="list-wrapper">
    <div class="page-wrapper">
      <div class="paginate-count">
        @if (count($forms) > 0)
        <p>全{{ $forms->total() }}件中
          <span>
            {{ ($forms->currentPage() -1) * $forms->perPage() + 1}} -
            {{ (($forms->currentPage() -1) * $forms->perPage() + 1) + (count($forms) -1) }}件
          </span>
        </p>
        @endif
      </div>
      <div class="paginate">
        {{ $forms->appends(request()->input())->links() }}
      </div>
    </div>
    <table class="contact-list">
      <tr>
        <th class="list-ttl-id">ID</th>
        <th class="list-ttl-name">お名前</th>
        <th class="list-ttl-gender">性別</th>
        <th class="list-ttl-email">メールアドレス</th>
        <th class="list-ttl-opinion">ご意見</th>
        <th class="list-ttl-delete"></th>
      </tr>
      @foreach( $forms as $form )
      <tr class="test">
        <td class="list-id">{{ $form->id }}</td>
        <td class="list-name">{{ $form->fullname }}</td>
        <td class="list-gender">
          @if($form->gender == 1)
          <p>男性</p>
          @elseif($form->gender == 2)
          <p>女性</p>
          @endif
        </td>
        <td class="list-email">{{ $form->email}}</td>
        <td class="list-opinion">{{ $form->opinion}}</td>
        <td>
          <form action="/contact/delete/{{ $form->id }}" method="POST">
            @csrf
            <input type="submit" value="削除" class="del-btn">
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<script>
  const opinion = document.querySelectorAll('.list-opinion');

  opinion.forEach(e => {
    const show = e.textContent.substring(0, 25);
    const hidden = e.textContent.substring(25);
    const clamp = '...';
    if (e.textContent.length > 25) {
      e.textContent = show + clamp;
      e.addEventListener('mouseover', function() {
        e.textContent = show + hidden;
      });
      e.addEventListener('mouseleave', function() {
        e.textContent = show + clamp;
      })
    }
  })
</script>
@endsection