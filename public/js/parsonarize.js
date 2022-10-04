$(function () {

  let ctx_relax_num = Number($("#relax").val());
  let ctx_inflammation_num = Number($('#inflammation').val());
  let ctx_paschoactive_num = Number($('#paschoactive').val());
  let ctx_vitality_num = Number($('#vitality').val());
  let ctx_headache_num = Number($('#headache').val());
  let ctx_insomnia_num = Number($('#insomnia').val());
  let ctx_parameter_array = [ctx_relax_num, ctx_inflammation_num, ctx_paschoactive_num, ctx_vitality_num, ctx_headache_num, ctx_insomnia_num];

  console.log(model_relax);



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
    } else if (vitality_plus_button && headache_num > 0) { // 集中力プラスボタン押した時
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
    } else if (vitality_sub_button && vitality_num > 0) { // 集中力マイナスボタン押した時
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
    let ctx = document.getElementById("myChart");
    window.myChart = new Chart(ctx, { // インスタンスをグローバル変数で作成
      type: 'radar',
      data: {
        labels: ["リラックス", "炎症鎮痛", "精神作用", "集中力", "頭痛", "不眠"],
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

  // 調合ボタンクリック時の処理
  $('#button').on('click', function () {
    // console.log('調合');
    const cbd = $('#cbd').val();
    const cbg = $('#cbg').val();
    const cbn = $('#cbn').val();
    const cbc = $('#cbc').val();

    const multiplier_relax_array = [];
    const multiplier_inflammation_array = [];
    const multiplier_paschoactive_array = [];
    const multiplier_vitality_array = [];
    const multiplier_headach_array = [];
    const multiplier_insomnia_array = [];


    console.log(model_relax);

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


  });

});
