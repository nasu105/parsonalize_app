<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Tweet Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <p>注文ID     {{$order_item->id}}</p>
            <p>リラックス  {{$order_item->relax}}</p>
            <p>炎症鎮痛    {{$order_item->inflammation}}</p>
            <p>精神作用    {{$order_item->paschoactive}}</p>
            <p>活力       {{$order_item->vitality}}</p>
            <p>頭痛       {{$order_item->headache}}</p>
            <p>不眠       {{$order_item->insomnia}}</p>
            <p>金額       {{$order_item->price}}</p>
          </div>
          <div>
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
          </p>
          </div>
          <div>購入者情報
          <p>名前:{{$order_item->user->name}}</p>
          <p>電話番号:{{$order_item->user->phone}}</p>
          <p>住所:{{$order_item->user->address}}</p>
          </div>
          <div>
            <a href="{{ route('admin.usersitem.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              対応済
            </a>
          </div>
          <div>
            <a href="{{ route('admin.usersitem.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function () {
      const order_item = @json($order_item); // phpデータをjsデータに変換
      const a = Object.values(order_item); // valuesだけを格納
      console.log(a);
      const result = a.splice(2, 6); // parameterの値だけを格納
      console.log(result);
      const parameter_array = result.map(Number);
      const result_array = [0, 0, 0, 0, 0]; // 調合結果の配列 [cbd,cbg,cbn,cbc,terpen]の順番
      // const unit_price_object = @json($unit_price); // 単価オブジェクトを変数に格納
      // const unit_price_str = Object.values(unit_price_object); // 単価を変数に格納
      // const unit_price = unit_price_str.map(Number);

      mixing_percent(); // 調合結果を作成
      // total_amount(result_array[0], result_array[1], result_array[2], result_array[3], result_array[4]);
      // console.log(price);
      // console.log(result_array);
      // console.log(unit_price);

      function mixing_percent() { // 調合結果を作成
        const multiplier_relax_array = [];
        const multiplier_inflammation_array = [];
        const multiplier_paschoactive_array = [];
        const multiplier_vitality_array = [];
        const multiplier_headach_array = [];
        const multiplier_insomnia_array = [];

        // cbd_modelを変数に格納
        const model_relax = @json($model_relax);
        const model_inflammation = @json($model_inflammation);
        const model_paschoactive = @json($model_paschoactive);

        // objectのvalueを取得
        const model_relax_value = Object.values(model_relax);
        const model_inflammation_value = Object.values(model_inflammation);
        const model_paschoactive_value = Object.values(model_paschoactive);

        // 文字列を数値に変換
        const model_relax_array = model_relax_value.map(Number);
        const model_inflammation_array = model_inflammation_value.map(Number);
        const model_paschoactive_array = model_paschoactive_value.map(Number);

        for (let i = 0; i < 4; i++) {
          multiplier_relax_array.push(model_relax_array[i] * parameter_array[0]);
          multiplier_inflammation_array.push(model_inflammation_array[i] * parameter_array[1]);
          multiplier_paschoactive_array.push(model_paschoactive_array[i] * parameter_array[2]);
          multiplier_vitality_array.push(model_relax_array[i] * parameter_array[3]);
          multiplier_headach_array.push(model_inflammation_array[i] * parameter_array[4]);
          multiplier_insomnia_array.push(model_paschoactive_array[i] * parameter_array[5]);
        }

        result_array[0] += Math.round((multiplier_relax_array[0] + multiplier_inflammation_array[0] + multiplier_paschoactive_array[0] + multiplier_vitality_array[0] + multiplier_headach_array[0] + multiplier_insomnia_array[0]) / 18);
        result_array[1] += Math.round((multiplier_relax_array[1] + multiplier_inflammation_array[1] + multiplier_paschoactive_array[1] + multiplier_vitality_array[1] + multiplier_headach_array[1] + multiplier_insomnia_array[1]) / 18);
        result_array[2] += Math.round((multiplier_relax_array[2] + multiplier_inflammation_array[2] + multiplier_paschoactive_array[2] + multiplier_vitality_array[2] + multiplier_headach_array[2] + multiplier_insomnia_array[2]) / 18);
        result_array[3] += Math.round((multiplier_relax_array[3] + multiplier_inflammation_array[3] + multiplier_paschoactive_array[3] + multiplier_vitality_array[3] + multiplier_headach_array[3] + multiplier_insomnia_array[3]) / 18);
        result_array[4] += 100 - (result_array[0] + result_array[1] + result_array[2] + result_array[3]);

        document.getElementById('cbd').textContent = ' ' + result_array[0] + '%';
        document.getElementById('cbg').textContent = ' ' + result_array[1] + '%';
        document.getElementById('cbn').textContent = ' ' + result_array[2] + '%';
        document.getElementById('cbc').textContent = ' ' + result_array[3] + '%';
        document.getElementById('terpene').textContent = ' ' + result_array[4] + '%';

      }


      


    });
  </script>
</x-app-layout>
