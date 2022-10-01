<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AYDAY LP</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" media="all" href="{{ asset('css/ress.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('css/style.css') }}" />
<script src="js/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/style.js') }}"></script>
	
<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    
</head>
<body>
<header>    
  <div class="container">
    <div class="row">
      <div class="col span-12 header">
        <h1><a href="">AYDAY WELLPHARMA</a></h1>
        <!-- <div class="header-box"><a href=""><span class="contact-button">ログイン</span></a></div> -->
      </div>
    </div>
    <div class="row">
      <div class="col span-12">
        <nav>
          <div id="open"></div>
          <div id="close"></div>   
          <div id="navi">
            <ul>
              <li><a href="">ホーム</a></li>
              <li><a href="#1">CBDについて</a></li>
              <li><a href="#2">パーソナライズサービス</a></li>
              <!-- <li><a href="#3">申し込みの流れ</a></li> -->
              <!-- <li><a href="#4">アクセス</a></li> -->
              <li><a href="#5">お問い合わせ</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>
  <div class="mainimg">
    <img src="{{ asset('img/mainimg.jpg') }}" alt="メイン画像">  
  </div>
  <main>
    <section id="2">  
      <div class="catch">
        <h2><span class="under">オリジナルCBDリキッドをパーソナライズ！</span></h2>
        <p>個々の悩みに最もリーチする結果になるように、視覚的にカスタマイズが出来るアルゴリズムを開発。
          <br>それぞれの成分が持つ期待効果を自分に合った配合でカクテル。世界にひとつだけあなた専用の癒しリキッドが完成します。
        </p>
      </div>

      <div class="lp-button">
        <!-- <a href="http://127.0.0.1:8001/" class="lp-c-button lp-c-button-large">調合開始</a> -->
        <!--@if (Route::has('user.login'))
          <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth('users')
              <a href="{{ url('user/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
              <a href="{{ route('user.login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

              {{-- @if (Route::has('register')) --}}
                  <a href="{{ route('user.register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
              {{-- @endif --}}
            @endauth
          </div>
        @endif -->

        @if (Route::has('user.login'))
          @auth('users')
            <a href="{{ route('user.item.create') }}" class="lp-c-button lp-c-button-large">調合開始</a>
          @else
            <!-- <a href="{{ route('user.login') }}" class="lp-c-button lp-c-button-large">調合開始</a> -->
            <a href="{{ route('user.register') }}" class="lp-c-button lp-c-button-large">調合開始</a>
          @endauth
        @endif
      </div>

      <div class="container center">
        <h2 class="center"><span class="under">パーソナライズに用いるカンナビノイドについて</span></h2>
        <div class="row">
          <!-- <div class="col span-4"> -->
          <div>
            <img src="{{ asset('img/staff.jpg') }}" alt="スタッフ">
            <h3>CBD・CBG・CBN・CBC</h3>
            <p>各カンナビノイドには上記のようにそれぞれ<br>
              特色がありこれらの配合量を独自にカスタマイズ<br>
              することにより個々の欲する効果効能が期待出来ます。
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="1" class="gray-back">
      <h2 class="center"><span class="under">世界でひとつだけ、あなた専用リキッド！</span></h2>
      <div class="container center">
        <div class="row">
          <div class="col span-4">
            <img src="{{ asset('img/product.jpg') }}" alt="ここに商品">
            <h3>PERSONALISE LIQUID</h3>
            <p>お客様がカスタマイズした世界でひとつだけの<br>オリジナルリキッド！</p>
          </div>
          <div class="col span-4">
            <img src="{{ asset('img/product.jpg') }}" alt="ここに商品">
            <h3>PERSONALISE LIQUID</h3>
            <p>お客様がカスタマイズした世界でひとつだけの<br>オリジナルリキッド！</p>
          </div>
          <div class="col span-4">
            <img src="{{ asset('img/product.jpg') }}" alt="ここに商品">
            <h3>PERSONALISE LIQUID</h3>
            <p>お客様がカスタマイズした世界でひとつだけの<br>オリジナルリキッド！</p>
          </div>
        </div>
      </div>
    </section>

    <section id="3" class="gray-back">
      <h2 class="center"><span class="under">オーダーの流れ</span></h2>
      <div class="container">
        <div class="row flow">
          <div class="col span-3">
            <img src="{{ asset('img/flow.jpg') }}" alt="申し込み">
          </div>
          <div class="col span-9"><p>上記リンクよりパーソナライズページへ移動します。</p>
          </div>
        </div>	
        <div class="row flow">
          <div class="col span-3">
            <img src="{{ asset('img/flow.jpg') }}" alt="申し込み">
          </div>
          <div class="col span-9"><p>お客様個々の抱える悩みや症状に最も効果を発揮する製品になるように<br>
            6つのパラメーターを調整しながらカスタマイズが可能です。<br>
            その際、本来の効果効能を得られないような無茶なカスタマイズにならないように<br>
            AYDAY WELLPHARMAが独自開発したアルゴリズムによってバランスが保護されます。<br>
            既製品ではどの商品が自分の症状を改善・緩和してくれるのかわからないお客様に<br>
            是非お試しいただきたいサービスです。</p>
          </div>
        </div>
        <div class="row flow">
          <div class="col span-3">
            <img src="{{ asset('img/flow.jpg') }}" alt="申し込み">
          </div>
          <div class="col span-9"><p>パーソナライズ完了後、カートに追加 → 購入へとお進みください。<br>
          支払いページへと切り替わります。</p>
          </div>
        </div>
      </div>
    </section>
        
    <section id="4">
      <h2 class="center"><span class="under">アクセス</span></h2>
      <div class="container">
        <div class="row">
          <div class="col span-12">
            <!-- GoogleMap -->
            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27814443.96425483!2d120.28897720705172!3d31.679877148840735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34674e0fd77f192f%3A0xf54275d47c665244!2z5pel5pys!5e0!3m2!1sja!2sjp!4v1555153587836!5m2!1sja!2sjp" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.7213907801383!2d130.3944697!3d33.5865824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3541918695a762f1%3A0x4cd666427ea8220!2z44CSODEwLTAwNDEg56aP5bKh55yM56aP5bKh5biC5Lit5aSu5Yy65aSn5ZCN77yR5LiB55uu77yT4oiS77yU77yRIOODl-ODquOCquWkp-WQjeODk-ODqyAxZg!5e0!3m2!1sja!2sjp!4v1664506051628!5m2!1sja!2sjp"
              width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <!-- /GoogleMap -->
          </div>
        </div>	
      </div>
    </section>
        
    <section id="5">
      <h2 class="center"><span class="under">お問い合わせ</span></h2>
      <div class="container">
        <div class="row">
          <div class="col span-6">
            <!-- <div class="contact-box">
            <p><img src="img/tel.png" alt="電話"></p>
            <p>012-345-6789</p>
            </div>
            </div>
            <div class="col span-6">
            <div class="contact-box">
            <p><img src="img/mail.png" alt="Eメール"></p>
            <p>simple@mail.com</p>
            </div> -->
          </div>
        </div>	
        <div class="row">
          <div class="col span-12">
            <form method="" action="">
              <table class="table full-width">
                <tbody>
                  <tr>
                    <th><label for="name">お名前</label></th>
                    <td><input class="full-width" type="text" name="お名前" placeholder="名前を記入" id="exampNameInput"></td>
                  </tr>
                  <tr>
                    <th><label for="email">メールアドレス</label></th>
                    <td><input class="full-width" type="email" name="Email" placeholder="メールアドレスを記入" id="exampleEmailInput"></td>
                  </tr>
                  <tr>
                    <th><label for="tel">お電話番号</label></th>
                    <td><input class="full-width" type="tel" name="お電話番号" placeholder="お電話番号を記入" id="exampleTellInput"></td>
                  </tr>
                  <tr>
                    <th><label for="exampleMessage">お問い合わせ内容</label></th>
                    <td><textarea class="full-width textarea" name="お問い合わせ内容" placeholder="用件をご記入ください …" id="exampleMessage"></textarea></td>
                  </tr>
                </tbody>
              </table>
              <p class="center"><input class="button" type="submit" value="送 信"></p>
            </form>	
          </div>
        </div>
      </div>
    </section>    
  </main>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col span-4">
        <h4>会社概要</h4>
        <p>NASDIRT AYDAYWELLPHARMA</p>
      </div>
      <div class="col span-4">
        <h4>会社概要</h4>
        <p>NASDIRT AYDAYWELLPHARMA</p>
      </div>
      <div class="col span-4">
        <h4>会社概要</h4>
        <p>NASDIRT AYDAYWELLPHARMA</p>
      </div>
    </div>
  </footer>
  <div class="copyright">
    <a href="https://" target="_blank">Copyright © AYDAY WELLPHARMA</a> 
  </div>
  <p id="pagetop"><a href="#">TOP</a></p>
</body>
</html>