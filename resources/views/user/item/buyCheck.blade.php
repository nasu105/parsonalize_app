<x-app-layout>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <div>
        <p>{{ __('Confirmation') }}</p>
        <p>カスタマイズ詳細</p>
      </div>      
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hiddn shadow-sm sm:rounded-lg">
        <div class="bg-white border-b border-gray-200">
          <div result_content>
            <p>リラックス<label for="">{{$item->relax}}</label></p>
            <p>炎症鎮痛<label for="">{{$item->inflammation}}</label></p>
            <p>精神作用<label for="">{{$item->paschoactive}}</label></p>
            <p>活力<label for="">{{$item->vitality}}</label></p>
            <p>頭痛<label for="">{{$item->headache}}</label></p>
            <p>不眠<label for="">{{$item->insomnia}}</label></p>
          </div>
          <form action="{{ route('user.item.cart_add',$item->id) }}" method="POST">
            @method('put')
            @csrf
            <div>
              <p>合計金額</p>
              <input type="text" value="0" name="sum_price"  id="sum_price" readonly>
            </div>
            <div>
              <button type="submit" id="cart_button" class="cart_button">カートに追加</button>
            </div>
          </form>
          <div>
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function () {
      const item = @json($item); // phpデータをjsデータに変換
      const a = Object.values(item); // valuesだけを格納
      const result = a.splice(0, 6); // parameterの値だけを格納
      // console.log(result);
      const parameter_array = result.map(Number);
      const result_array = [0, 0, 0, 0, 0]; // 調合結果の配列 [cbd,cbg,cbn,cbc,terpen]の順番
      const unit_price_object = @json($unit_price); // 単価オブジェクトを変数に格納
      const unit_price_str = Object.values(unit_price_object); // 単価を変数に格納
      const unit_price = unit_price_str.map(Number);

      drawChart(); // グラフ作成
      mixing_percent(); // 調合結果を作成
      // total_amount(result_array[0], result_array[1], result_array[2], result_array[3], result_array[4]);
      const sum_price = total_amount(result_array[0], result_array[1], result_array[2], result_array[3], result_array[4]);
      $('#sum_price').val(sum_price);
      // console.log(sum_price);
      // console.log(result_array);
      // console.log(unit_price);

      function drawChart() {  // グラフ作成(chartjs)
        let ctx = document.getElementById("myChart");
        window.myChart = new Chart(ctx, { // インスタンスをグローバル変数で作成
          type: 'radar',
          data: {
            labels: ["リラックス", "炎症鎮痛", "精神作用", "活力", "頭痛", "不眠"],
            datasets: [{
              label: "パラメーター値",
              data: [parameter_array[0],
              parameter_array[1],
              parameter_array[2],
              parameter_array[3],
              parameter_array[4],
              parameter_array[5],
              ],
              backgroundColor: "rgba(67, 133, 215, 0.5)",  //グラフ背景色
              borderColor: "rgba(67, 133, 215, 1)",        //グラフボーダー色
            }]
          },
          options: {
            scales: {
              r: {
                max: 18,        //グラフの最大値
                min: 0,        //グラフの最小値
                ticks: {
                  stepSize: 3  //目盛間隔
                }
              }
            },
          }
        });
      }

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

      }


      
      function total_amount (cbd_num, cbg_num, cbn_num, cbc_num, terpene_num) { //　合計金額計算
        let sum_price = 0;
        const parameter_array = [cbd_num, cbg_num, cbn_num, cbc_num, terpene_num]; // 引数を配列に格納

        for (let i = 0; i <= 4; i++) {
          sum_price += parameter_array[i] * unit_price[i];
        }

        return sum_price;
      }


      


    });
  </script>

</x-app-layout>