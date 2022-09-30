<link rel="stylesheet" media="all" href="{{ asset('css/login_register.css') }}" />

<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

    <!-- ログイン -->
    <form method="POST" action="{{ route('user.login') }}">
    @csrf

      <div class="login-form">
        <div class="sign-in-htm">
          <div class="group">
            <label for="user" class="label">お名前</label>
            <input id="user" type="text" class="input" name="email" :value="old('email')" required autofocus>
          </div>

          <div class="group">
            <label for="pass" class="label">パスワード</label>
            <input id="pass" type="password" class="input" data-type="password" name="password" required autocomplete="current-password">
          </div>

          <div class="group">
            <input id="check" type="checkbox" class="check" name="remember" checked>
            <label for="check"><span class="icon"></span> ログイン情報を保存する</label>
          </div>
    
          <div class="group">
            <input type="submit" class="button" value="Sign In">
          </div>

          <div class="hr"></div>
          <div class="foot-lnk">
            @if (Route::has('user.password.request'))
              <a href="{{ route('user.password.request') }}">Forgot Password?</a>
            @endif
          </div>
        </div>

      </form>

      <!-- register -->
      <div class="sign-up-htm">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="user" type="text" class="input">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="pass" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="pass" class="label">Repeat Password</label>
          <input id="pass" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="pass" class="label">Email Address</label>
          <input id="pass" type="text" class="input">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign Up">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1">Already Member?</a>
        </div>
      </div>
    </div>
  </div>
</div>