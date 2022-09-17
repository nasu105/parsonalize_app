<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/create.style.css') }}">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create New Pasonarize') }}
      </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
        <div class="bg-white overflow-hiddn shadow-sm sm:rounded-lg">
          <div class="bg-white border-b border-gray-200">
            <form action="{{ route('item.store') }}" method="POST">
              @csrf
              <div class="relax_content">
                <label for="relax">リラックス</label>
                <p>
                  <input type="number" id="relax" name="relax" class="sm:rounded-lg" data-min="0"
                    data-max="18" value="3" disabled>
                  <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".relax"
                    id="relax_plus_button">
                  <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".relax"
                    id="relax_sub_button">
                </p>
              </div>
              <div class="inflammation_content">
                <label for="inflammation">炎症鎮痛</label>
                <p>
                  <input type="number" id="inflammation" name="inflammation" class="sm:rounded-lg" data-min="0"
                    data-max="18" value="3" disabled>
                  <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".inflammation"
                    id="inflammation_plus_button">
                  <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".inflammation"
                    id="inflammation_sub_button">
                </p>
              </div>
              <div class="paschoactive_content">
                <label for="paschoactive">精神作用</label>
                <p>
                  <input type="number" id="paschoactive" name="paschoactive" class="sm:rounded-lg" data-min="0"
                    data-max="18" value="3" disabled>
                  <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".paschoactive"
                    id="paschoactive_plus_button">
                  <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".paschoactive"
                    id="paschoactive_sub_button">
                </p>
              </div>
              <div class="vitality_content">
                <label for="vitality">活力</label>
                <p>
                  <input type="number" id="vitality" name="vitality" class="sm:rounded-lg" data-min="0"
                    data-max="18" value="3" disabled>
                  <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".vitality"
                    id="vitality_plus_button">
                  <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".vitality"
                    id="vitality_sub_button">
                </p>
              </div>
              <div class="headache_content">
                <label for="headache">頭痛</label>
                <p>
                  <input type="number" id="headache" name="headache" class="sm:rounded-lg" data-min="0"
                    data-max="18" value="3" disabled>
                  <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".headache"
                    id="headache_plus_button">
                  <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".headache"
                    id="headache_sub_button">
                </p>
              </div>
              <div class="insomnia_content">
                <label for="insomnia">不眠</label>
                <p>
                  <input type="number" id="insomnia" name="insomnia" class="sm:rounded-lg" data-min="0"
                    data-max="18" value="3" disabled>
                  <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".insomnia"
                    id="insomnia_plus_button">
                  <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".insomnia"
                    id="insomnia_sub_button">
                </p>
              </div>
              <button id="button">調合</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    {{-- <p>
      現在合計値 <span id="sum_now"></span>
    </p>
    <p>※合計値が18になるように設定してください</p>
    <h1>調合成分結果</h1>
    <p>
      CBD<span id="cbd"></span>
    </p>
    <p>
      CBG<span id="cbg"></span>
    </p>
    <p>
      CBN<span id="cbn"></span>
    </p>
    <p>
      CBC<span id="cbc"></span>
    </p>
    <p>
      TERPENE<span id="terpene"></span>
    </p> --}}

    <script src="{{ asset('/js/parsonarize.js') }}"></script>
  </x-app-layout>
</body>


</html>
