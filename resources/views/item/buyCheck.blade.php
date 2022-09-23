<x-app-layout>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <div>
        <p>{{ __('Confirmation') }}</p>
        <p>注文確定</p>
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
          <div>
            <p>合計金額</p>
            <input type="text" value="0" name="sum_price" readonly>
          </div>
          <div>
            <button type="submit" id="order_button" class="order_button">注文確定</button>
          </div>
          <div>
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // グラフ作成(chartjs)
    $(function () {
      const item = @json($item); // phpデータをjsデータに変換
      const a = Object.values(item); // valuesだけを格納
      const result = a.splice(0, 6); // parameterの値だけを格納
      const parameter_array = result.map(Number);
      console.log(parameter_array);
      drawChart();

      function drawChart() {
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
    });
  </script>

</x-app-layout>