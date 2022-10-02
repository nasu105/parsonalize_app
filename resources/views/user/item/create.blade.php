<!DOCTYPE html>
<html lang="en">

<head> 
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/create.style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/css/jquery.mb.YTPlayer.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/jquery.mb.YTPlayer.min.js"></script>
</head>

<body>
  <x-app-layout>

    <div class="py-0">


      <!-- <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12"> -->
        <div class="overflow-hiddn shadow-sm sm:rounded-lg">
          <div class="border-b border-gray-200">
            <form action="{{ route('user.item.store') }}" method="POST">
              @csrf
              <div>


                <!-- パラメーター -->
                <div class="flex justify-center">
                <div class="mixing_content">
                    <div class="relax_content">
                      <label for="relax">リラックス</label>
                      <p>
                        <input type="number" id="relax" name="relax" class="sm:rounded-lg" data-min="0" data-max="18"
                          value="3" readonly>
                      </p>
                      <p>
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
                          data-max="18" value="3" readonly>
                      </p>
                      <p>
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
                          data-max="18" value="3" readonly>
                      </p>
                      <p>
                        <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".paschoactive"
                          id="paschoactive_plus_button">
                        <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".paschoactive"
                          id="paschoactive_sub_button">
                      </p>
                    </div>
                    <div class="vitality_content">
                      <label for="vitality">集中力</label>
                      <p>
                        <input type="number" id="vitality" name="vitality" class="sm:rounded-lg" data-min="0"
                          data-max="18" value="3" readonly>
                      </p>
                      <p>
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
                          data-max="18" value="3" readonly>
                      </p>
                      <p>
                        <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".headache"
                          id="headache_plus_button">
                        <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".headache"
                          id="headache_sub_button">
                      </p>
                    </div>
                    <div class="insomnia_content">
                      <label for="insomnia">入眠</label>
                      <p>
                        <input type="number" id="insomnia" name="insomnia" class="sm:rounded-lg" data-min="0"
                          data-max="18" value="3" readonly>
                      </p>
                      <p>
                        <input type="button" value="+" class="btnspinner" data-cal="1" data-target=".insomnia"
                          id="insomnia_plus_button">
                        <input type="button" value="-" class="btnspinner" data-cal="-1" data-target=".insomnia"
                          id="insomnia_sub_button">
                      </p>
                    </div>
                    <input type="hidden" value="0" name="order">
                  </div>


                  <!-- グラフ -->
                  <div class="w-full mt-6 mr-3">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="submit_form">
                <button type="submit" id="button" class="button">作成</button>
              </div>
            </form>
          </div>
        </div>
      <!-- </div> -->
    </div>
        <div id="ytPlayer" data-property="{
      videoURL: 'https://youtu.be/JouMAHQXx-g',
      autoPlay: true,
      loop: 1,
      mute: true,
      showControls: false,
      showYTLogo: false,
    }">

    <script>
      $(function () {

        $("#ytPlayer").YTPlayer(); //youtubeリンク対応

        let ctx_relax_num = Number($("#relax").val());
        let ctx_inflammation_num = Number($('#inflammation').val());
        let ctx_paschoactive_num = Number($('#paschoactive').val());
        let ctx_vitality_num = Number($('#vitality').val());
        let ctx_headache_num = Number($('#headache').val());
        let ctx_insomnia_num = Number($('#insomnia').val());
        let ctx_parameter_array = [ctx_relax_num, ctx_inflammation_num, ctx_paschoactive_num, ctx_vitality_num, ctx_headache_num, ctx_insomnia_num];

        const model_relax = @json($model_relax);
        const model_inflammation = @json($model_inflammation);
        const model_paschoactive = @json($model_paschoactive);

        let arySpinnerCtrl = [];
        let spin_speed = 20; //変動スピード

        // ページ読み込み時にグラフを描画
        drawChart(); // グラフ描画処理よ呼び出す

        //長押し押下時 && グラフ作成
        $('.btnspinner').on('touchstart mousedown click', function (e) {
          if (arySpinnerCtrl['interval']) return false;
          let target = $(this).data('target');
          arySpinnerCtrl['target'] = target;
          arySpinnerCtrl['timestamp'] = e.timeStamp;
          arySpinnerCtrl['cal'] = Number($(this).data('cal'));
          //クリックは単一の処理に留める
          if (e.type == 'click') {
            spinnerCal();
            return false;
          }
          //長押し時の処理
          setTimeout(function () {
            //インターバル未実行中 + 長押しのイベントタイプスタンプ一致時に計算処理
            if (!arySpinnerCtrl['interval'] && arySpinnerCtrl['timestamp'] == e.timeStamp) {
              // すでに(インスタンス)が生成されている場合は、グラフを破棄する
              if (myChart) {
                myChart.destroy();
              }
              arySpinnerCtrl['interval'] = setInterval(spinnerCal, spin_speed);
            }
          }, 500);
        });

        //長押し解除時 画面スクロールも解除に含む
        $(document).on('touchend mouseup scroll', function (e) {
          if (arySpinnerCtrl['interval']) {
            clearInterval(arySpinnerCtrl['interval']);
            arySpinnerCtrl = [];
          }
        });

        /*   const a = Number($('#relax').val());
          const b = Number($('#inflammaiton').val());
          const c = Number($('#paschoactive').val());
          const d = Number($('#vitality').val());
          const e = Number($('#headache').val());
          const f = Number($('#insomnia').val());
          const parameter_array = [a, b, c, d, e, f];
          const parameter_sum = parameter_array.reduce((a, b) => {
          return a + b;
          }); */

        //変動計算関数
        function spinnerCal() {
          let target = $(arySpinnerCtrl['target']);
          // let target = arySpinnerCtrl['target'];
          let num = Number(target.val());
          num = num + arySpinnerCtrl['cal'];

          // if (num > Number(target.data('max'))) {
          //   target.val(Number(target.data('max')));
          // } else if (Number(target.data('min')) > num) {
          //   target.val(Number(target.data('min')));
          // } else {
          //   target.val(num);
          // }

          // プラスボタンを変数に代入
          const relax_plus_button = arySpinnerCtrl['target'] == '.relax' && arySpinnerCtrl['cal'] == '1';
          const inflammation_plus_button = arySpinnerCtrl['target'] == '.inflammation' && arySpinnerCtrl['cal'] == '1';
          const paschoactive_plus_button = arySpinnerCtrl['target'] == '.paschoactive' && arySpinnerCtrl['cal'] == '1';
          const vitality_plus_button = arySpinnerCtrl['target'] == '.vitality' && arySpinnerCtrl['cal'] == '1';
          const headache_plus_button = arySpinnerCtrl['target'] == '.headache' && arySpinnerCtrl['cal'] == '1';
          const insomnia_plus_button = arySpinnerCtrl['target'] == '.insomnia' && arySpinnerCtrl['cal'] == '1';

          // マイナスボタンを変数に代入
          const relax_sub_button = arySpinnerCtrl['target'] == '.relax' && arySpinnerCtrl['cal'] == '-1';
          const inflammation_sub_button = arySpinnerCtrl['target'] == '.inflammation' && arySpinnerCtrl['cal'] == '-1';
          const paschoactive_sub_button = arySpinnerCtrl['target'] == '.paschoactive' && arySpinnerCtrl['cal'] == '-1';
          const vitality_sub_button = arySpinnerCtrl['target'] == '.vitality' && arySpinnerCtrl['cal'] == '-1';
          const headache_sub_button = arySpinnerCtrl['target'] == '.headache' && arySpinnerCtrl['cal'] == '-1';
          const insomnia_sub_button = arySpinnerCtrl['target'] == '.insomnia' && arySpinnerCtrl['cal'] == '-1';

          // 各パラメータ値を取得、変数に代入
          let relax_num = Number($('#relax').val());
          let inflammation_num = Number($('#inflammation').val());
          let paschoactive_num = Number($('#paschoactive').val());
          let vitality_num = Number($('#vitality').val());
          let headache_num = Number($('#headache').val());
          let insomnia_num = Number($('#insomnia').val());
          let parameter_array = [relax_num, inflammation_num, paschoactive_num, vitality_num, headache_num, insomnia_num];

          /* 関数×5 で */
          // 入力データ
          // オブジェクト
          // 6項目ごとに値の増減関数

          if (relax_plus_button && inflammation_num > 0) { // リラックスプラスボタン押した時
            inflammation_num -= 1;
            $('#inflammation').val(inflammation_num);
            relax_num += 1;
            $('#relax').val(relax_num);
            newChert();
          } else if (relax_plus_button && inflammation_num == 0 && headache_num > 0) {
            headache_num -= 1;
            $('#headache').val(headache_num);
            relax_num += 1;
            $('#relax').val(relax_num);
            newChert();
          } else if (relax_plus_button && inflammation_num == 0 && headache_num == 0 && paschoactive_num > 0) {
            paschoactive_num -= 1;
            $('#paschoactive').val(paschoactive_num);
            relax_num += 1;
            $('#relax').val(relax_num);
            newChert();
          } else if (relax_plus_button && inflammation_num == 0 && headache_num == 0 && paschoactive_num == 0 && insomnia_num > 0) {
            insomnia_num -= 1;
            $('#insomnia').val(insomnia_num);
            relax_num += 1;
            $('#relax').val(relax_num);
            newChert();
          } else if (relax_plus_button && inflammation_num == 0 && headache_num == 0 && paschoactive_num == 0 && insomnia_num == 0 && vitality_num > 0) {
            vitality_num -= 1;
            $('#vitality').val(vitality_num);
            relax_num += 1;
            $('#relax').val(relax_num);
            newChert();
          } else if (inflammation_plus_button && paschoactive_num > 0) { // 炎症鎮痛プラスボタン押した時
            paschoactive_num -= 1;
            $('#paschoactive').val(paschoactive_num);
            inflammation_num += 1;
            $('#inflammation').val(inflammation_num);
            newChert();
          } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num > 0) {
            insomnia_num -= 1;
            $('#insomnia').val(insomnia_num);
            inflammation_num += 1;
            $('#inflammation').val(inflammation_num);
            newChert();
          } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num == 0 && relax_num > 0) {
            relax_num -= 1;
            $('#relax').val(relax_num);
            inflammation_num += 1;
            $('#inflammation').val(inflammation_num);
            newChert();
          } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num == 0 && relax_num == 0 && vitality_num > 0) {
            vitality_num -= 1;
            $('#vitality').val(vitality_num);
            inflammation_num += 1;
            $('#inflammation').val(inflammation_num);
            newChert();
          } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num == 0 && relax_num == 0 && vitality_num == 0 && headache_num > 0) {
            headache_num -= 1;
            $('#headache').val(headache_num);
            inflammation_num += 1;
            $('#inflammation').val(inflammation_num);
            newChert();
          } else if (paschoactive_plus_button && relax_num > 0) { // 精神作用プラスボタン押した時
            relax_num -= 1;
            $('#relax').val(relax_num);
            paschoactive_num += 1;
            $('#paschoactive').val(paschoactive_num);
            newChert();
          } else if (paschoactive_plus_button && relax_num == 0 && vitality_num > 0) {
            vitality_num -= 1;
            $('#vitality').val(vitality_num);
            paschoactive_num += 1;
            $('#paschoactive').val(paschoactive_num);
            newChert();
          } else if (paschoactive_plus_button && relax_num == 0 && vitality_num == 0 && inflammation_num > 0) {
            inflammation_num -= 1;
            $('#inflammation').val(inflammation_num);
            paschoactive_num += 1;
            $('#paschoactive').val(paschoactive_num);
            newChert();
          } else if (paschoactive_plus_button && relax_num == 0 && vitality_num == 0 && inflammation_num == 0 && headache_num > 0) {
            headache_num -= 1;
            $('#headache').val(headache_num);
            paschoactive_num += 1;
            $('#paschoactive').val(paschoactive_num);
            newChert();
          } else if (paschoactive_plus_button && relax_num == 0 && vitality_num == 0 && inflammation_num == 0 && headache_num == 0 && insomnia_num) {
            insomnia_num -= 1;
            $('#insomnia').val(insomnia_num);
            paschoactive_num += 1;
            $('#paschoactive').val(paschoactive_num);
            newChert();
          } else if (vitality_plus_button && headache_num > 0) { // 活力プラスボタン押した時
            headache_num -= 1;
            $('#headache').val(headache_num);
            vitality_num += 1;
            $('#vitality').val(vitality_num);
            newChert();
          } else if (vitality_plus_button && headache_num == 0 && inflammation_num > 0) {
            inflammation_num -= 1;
            $('#inflammation').val(inflammation_num);
            vitality_num += 1;
            $('#vitality').val(vitality_num);
            newChert();
          } else if (vitality_plus_button && headache_num == 0 && inflammation_num == 0 && insomnia_num > 0) {
            insomnia_num -= 1;
            $('#insomnia').val(insomnia_num);
            vitality_num += 1;
            $('#vitality').val(vitality_num);
            newChert();
          } else if (vitality_plus_button && headache_num == 0 && insomnia_num == 0 && insomnia_num == 0 && paschoactive_num > 0) {
            paschoactive_num -= 1;
            $('#paschoactive').val(paschoactive_num);
            vitality_num += 1;
            $('#vitality').val(vitality_num);
            newChert();
          } else if (vitality_plus_button && paschoactive_num == 0 && insomnia_num == 0 && insomnia_num == 0 && paschoactive_num == 0 && relax_num) {
            relax_num -= 1;
            $('#relax').val(relax_num);
            vitality_num += 1;
            $('#vitality').val(vitality_num);
            newChert();
          } else if (headache_plus_button && insomnia_num > 0) { // 頭痛プラスボタン押した時
            insomnia_num -= 1;
            $('#insomnia').val(insomnia_num);
            headache_num += 1;
            $('#headache').val(headache_num);
            newChert();
          } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num > 0) {
            paschoactive_num -= 1;
            $('#paschoactive').val(paschoactive_num);
            headache_num += 1;
            $('#headache').val(headache_num);
            newChert();
          } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num == 0 && vitality_num > 0) {
            vitality_num -= 1;
            $('#vitality').val(vitality_num);
            headache_num += 1;
            $('#headache').val(headache_num);
            newChert();
          } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num == 0 && vitality_num == 0 && relax_num > 0) {
            relax_num -= 1;
            $('#relax').val(relax_num);
            headache_num += 1;
            $('#headache').val(headache_num);
            newChert();
          } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num == 0 && vitality_num == 0 && relax_num == 0 && inflammation_num) {
            inflammation_num -= 1;
            $('#inflammation').val(inflammation_num);
            headache_num += 1;
            $('#headache').val(headache_num);
            newChert();
          } else if (insomnia_plus_button && vitality_num > 0) { // 不眠プラスボタン押した時
            vitality_num -= 1;
            $('#vitality').val(vitality_num);
            insomnia_num += 1;
            $('#insomnia').val(insomnia_num);
            newChert();
          } else if (insomnia_plus_button && vitality_num == 0 && relax_num > 0) {
            relax_num -= 1;
            $('#relax').val(relax_num);
            insomnia_num += 1;
            $('#insomnia').val(insomnia_num);
            newChert();
          } else if (insomnia_plus_button && vitality_num == 0 && relax_num == 0 && headache_num > 0) {
            headache_num -= 1;
            $('#headache').val(headache_num);
            insomnia_num += 1;
            $('#insomnia').val(insomnia_num);
            newChert();
          } else if (insomnia_plus_button && vitality_num == 0 && relax_num == 0 && headache_num == 0 && inflammation_num > 0) {
            inflammation_num -= 1;
            $('#inflammation').val(inflammation_num);
            insomnia_num += 1;
            $('#insomnia').val(insomnia_num);
            newChert();
          } else if (insomnia_plus_button && vitality_num == 0 && relax_num == 0 && headache_num == 0 && inflammation_num == 0 && paschoactive_num) {
            paschoactive_num -= 1;
            $('#paschoactive').val(paschoactive_num);
            insomnia_num += 1;
            $('#insomnia').val(insomnia_num);
            newChert();
          }

          // マイナスボタンが押された時、最大値をもつパラメーターに割り振る
          if (relax_sub_button && relax_num > 0) { // リラックスマイナスボタン押した時
            relax_num -= 1;
            $('#relax').val(relax_num);
            parameter_array.splice(0, 1);
            const a = maxIndex(parameter_array);
            // console.log(a);
            parameter_array[a] += 1;
            // $('#relax').val(parameter_array[0]);
            $('#inflammation').val(parameter_array[0]);
            $('#paschoactive').val(parameter_array[1]);
            $('#vitality').val(parameter_array[2]);
            $('#headache').val(parameter_array[3]);
            $('#insomnia').val(parameter_array[4]);
            newChert();
          } else if (inflammation_sub_button && inflammation_num > 0) { // 炎症鎮痛マイナスボタン押した時
            inflammation_num -= 1;
            $('#inflammation').val(inflammation_num);
            parameter_array.splice(1, 1);
            const a = maxIndex(parameter_array);
            // console.log(a);
            parameter_array[a] += 1;
            $('#relax').val(parameter_array[0]);
            // $('#inflammation').val(parameter_array[0]);
            $('#paschoactive').val(parameter_array[1]);
            $('#vitality').val(parameter_array[2]);
            $('#headache').val(parameter_array[3]);
            $('#insomnia').val(parameter_array[4]);
            newChert();
          } else if (paschoactive_sub_button && paschoactive_num > 0) { // 精神作用マイナスボタン押した時
            paschoactive_num -= 1;
            $('#paschoactive').val(paschoactive_num);
            parameter_array.splice(2, 1);
            const a = maxIndex(parameter_array);
            // console.log(a);
            parameter_array[a] += 1;
            $('#relax').val(parameter_array[0]);
            $('#inflammation').val(parameter_array[1]);
            // $('#paschoactive').val(parameter_array[1]);
            $('#vitality').val(parameter_array[2]);
            $('#headache').val(parameter_array[3]);
            $('#insomnia').val(parameter_array[4]);
            newChert();
          } else if (vitality_sub_button && vitality_num > 0) { // 活力マイナスボタン押した時
            vitality_num -= 1;
            $('#vitality').val(vitality_num);
            parameter_array.splice(3, 1);
            const a = maxIndex(parameter_array);
            // console.log(a);
            parameter_array[a] += 1;
            $('#relax').val(parameter_array[0]);
            $('#inflammation').val(parameter_array[1]);
            $('#paschoactive').val(parameter_array[2]);
            // $('#vitality').val(parameter_array[2]);
            $('#headache').val(parameter_array[3]);
            $('#insomnia').val(parameter_array[4]);
            newChert();
          } else if (headache_sub_button && headache_num > 0) { // 頭痛マイナスボタン押した時
            headache_num -= 1;
            $('#headache').val(headache_num);
            parameter_array.splice(4, 1);
            const a = maxIndex(parameter_array);
            // console.log(a);
            parameter_array[a] += 1;
            $('#relax').val(parameter_array[0]);
            $('#inflammation').val(parameter_array[1]);
            $('#paschoactive').val(parameter_array[2]);
            $('#vitality').val(parameter_array[3]);
            // $('#headache').val(parameter_array[3]);
            $('#insomnia').val(parameter_array[4]);
            newChert();
          } else if (insomnia_sub_button && insomnia_num > 0) { // 不眠マイナスボタン押した時
            insomnia_num -= 1;
            $('#insomnia').val(insomnia_num);
            parameter_array.splice(5, 1);
            const a = maxIndex(parameter_array);
            // console.log(a);
            parameter_array[a] += 1;
            $('#relax').val(parameter_array[0]);
            $('#inflammation').val(parameter_array[1]);
            $('#paschoactive').val(parameter_array[2]);
            $('#vitality').val(parameter_array[3]);
            $('#headache').val(parameter_array[4]);
            // $('#insomnia').val(parameter_array[4]);
            newChert();
          }

        }

        // グラフ作成(chartjs)
        function drawChart() {
          // Chart.defaults.default.fontcolor = 'red';
          // Chart.defaults.global.defaultFontColor = 'red';
          let ctx = document.getElementById("myChart");
          window.myChart = new Chart(ctx, { // インスタンスをグローバル変数で作成
            type: 'radar',
            data: {
              labels: ["リラックス", "炎症鎮痛", "精神作用", "活力", "頭痛", "入眠"],
              datasets: [{
                label: "パラメーター値",
                data: [ctx_parameter_array[0],
                ctx_parameter_array[1],
                ctx_parameter_array[2],
                ctx_parameter_array[3],
                ctx_parameter_array[4],
                ctx_parameter_array[5],
                ],
                backgroundColor: "rgba(67, 133, 215, 0.5)",  //グラフ背景色
                borderColor: "rgba(67, 133, 215, 1)",        //グラフボーダー色
              }]
            },
            options: {
              legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: 'black'
                }
              }
            }
            // options: {
              // scales: {
              //   r: {
              //     max: 18,        //グラフの最大値
              //     min: 0,        //グラフの最小値
              //     ticks: {
              //       stepSize: 6  //目盛間隔
              //     }
              //   }
              // },
            // }
          });
        }

        // 配列の最大値のインデックス取得
        function maxIndex(a) {
          let index = 0;
          let value = -Infinity
          for (let i = 0; i < a.length; i++) {
            if (value < a[i]) {
              value = a[i]
              index = i
            }
          }
          return index;
        }

        // chatdataに渡す値を格納
        function getParameter() {
          ctx_parameter_array[0] = Number($("#relax").val());
          ctx_parameter_array[1] = Number($('#inflammation').val());
          ctx_parameter_array[2] = Number($('#paschoactive').val());
          ctx_parameter_array[3] = Number($('#vitality').val());
          ctx_parameter_array[4] = Number($('#headache').val());
          ctx_parameter_array[5] = Number($('#insomnia').val());
        }

        function newChert() {
          // すでに(インスタンス)が生成されている場合は、グラフを破棄する
          if (myChart) {
            myChart.destroy();
          }
          getParameter();
          drawChart();

        }

      });

    </script>
  </x-app-layout>
</body>


</html>