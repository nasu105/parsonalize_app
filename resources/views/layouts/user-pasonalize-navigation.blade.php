<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
<!-- Logo -->
<div class="logo">
  <a href="{{ route('user.item.create') }}">
    <img src="{{ asset('img/ayday_logo_transparency.png')}}" alt="" width="72" heigth="72" class="logo_img">
  </a>
</div>
<nav x-data="{ open: false }">
  <!-- Primary Navigation Menu -->
  <ul>
    <li class="li1">
      <!-- 🔽 作成ページへのリンクを追加 -->
      <a href="{{ route('user.item.create') }}">オーダー</a>
    </li>
    <li class="li2">
      <!-- 🔽 一覧ページへのリンクを追加 -->
      <a href="{{ route('user.item.index') }}" class="order_history">注文履歴</a>
    </li>
    <li class="li3">
      <!-- 🔽 カートへのリンクを追加 -->
      <a href="{{ route('user.cart') }}">カートの中身</a>
    </li>
    <li class="li4">
      <!-- 🔽 ログアウトへのリンクを追加 -->
      <form method="POST" action="{{ route('user.logout') }}">
      @csrf
          
      <a href="" onclick="event.preventDefault();
                        this.closest('form').submit();">ログアウト</a>
      </form>
    </li>
    <li class="li5">
      <!-- 🔽 ユーザーネームを追加 -->
      <a href="">{{ Auth::user()->name }}</a>
    </li>
  </ul>

  <div class="animation start-home"></div>

</nav>
