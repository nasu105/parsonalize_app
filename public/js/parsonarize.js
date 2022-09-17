// リラックス、活力パラメーターのモデル作成
const model_relax = {
  cbd: 45,
  cbg: 45,
  cbn: 0,
  cbc: 0,
}

// 炎症鎮痛、頭痛パラメーターのモデル作成
const model_inflammation = {
  cbd: 20,
  cbg: 0,
  cbn: 35,
  cbc: 35,
}

// 精神作用、不眠パラメーターのモデル作成
const model_paschoactive = {
  cbd: 0,
  cbg: 20,
  cbn: 70,
  cbc: 0,
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

$(function () {
      
  let arySpinnerCtrl = [];
  let spin_speed = 20; //変動スピード

  //長押し押下時
  $('.btnspinner').on('touchstart mousedown click', function (e) {
    if (arySpinnerCtrl['interval']) return false;
    let target = $(this).data('target');
    arySpinnerCtrl['target'] = target;
    arySpinnerCtrl['timestamp'] = e.timeStamp;
    arySpinnerCtrl['cal'] = Number($(this).data('cal'));
    //クリックは単一の処理に留める
    if (e.type == 'click') {
      spinnerCal();
      arySpinnerCtrl = [];
      return false;
    }
    //長押し時の処理
    setTimeout(function () {
      //インターバル未実行中 + 長押しのイベントタイプスタンプ一致時に計算処理
      if (!arySpinnerCtrl['interval'] && arySpinnerCtrl['timestamp'] == e.timeStamp) {
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
    let num = Number(target.val());
    console.log(num);
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
      target.val(num);
      console.log(target.val(num));
      console.log(relax_num);
      console.log(target);
      console.log(arySpinnerCtrl);
      console.log(num);
    } else if (relax_plus_button && inflammation_num == 0 && headache_num > 0) {
      headache_num -= 1;
      $('#headache').val(headache_num);
      target.val(num);
    } else if (relax_plus_button && inflammation_num == 0 && headache_num == 0 && paschoactive_num > 0) {
      paschoactive_num -= 1;
      $('#paschoactive').val(paschoactive_num);
      target.val(num);
    } else if (relax_plus_button && inflammation_num == 0 && headache_num == 0 && paschoactive_num == 0 && insomnia_num > 0) {
      insomnia_num -= 1;
      $('#insomnia').val(insomnia_num);
      target.val(num);
    } else if (relax_plus_button && inflammation_num == 0 && headache_num == 0 && paschoactive_num == 0 && insomnia_num == 0 && vitality_num > 0) {
      vitality_num -= 1;
      $('#vitality').val(vitality_num);
      target.val(num);
    } else if (inflammation_plus_button && paschoactive_num > 0) { // 炎症鎮痛プラスボタン押した時
      paschoactive_num -= 1;
      $('#paschoactive').val(paschoactive_num);
      target.val(num);
    } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num > 0) {
      insomnia_num -= 1;
      $('#insomnia').val(insomnia_num);
      target.val(num);
    } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num == 0 && relax_num > 0) {
      relax_num -= 1;
      $('#relax').val(relax_num);
      target.val(num);
    } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num == 0 && relax_num == 0 && vitality_num > 0) {
      vitality_num -= 1;
      $('#vitality').val(vitality_num);
      target.val(num);
    } else if (inflammation_plus_button && paschoactive_num == 0 && insomnia_num == 0 && relax_num == 0 && vitality_num == 0 && headache_num > 0) {
      headache_num -= 1;
      $('#headache').val(headache_num);
      target.val(num);
    } else if (paschoactive_plus_button && relax_num > 0) { // 精神作用プラスボタン押した時
      relax_num -= 1;
      $('#relax').val(relax_num);
      target.val(num);
    } else if (paschoactive_plus_button && relax_num == 0 && vitality_num > 0) {
      vitality_num -= 1;
      $('#vitality').val(vitality_num);
      target.val(num);
    } else if (paschoactive_plus_button && relax_num == 0 && vitality_num == 0 && inflammation_num > 0) {
      inflammation_num -= 1;
      $('#inflammation').val(inflammation_num);
      target.val(num);
    } else if (paschoactive_plus_button && relax_num == 0 && vitality_num == 0 && inflammation_num == 0 && headache_num > 0) {
      headache_num -= 1;
      $('#headache').val(headache_num);
      target.val(num);
    } else if (paschoactive_plus_button && relax_num == 0 && vitality_num == 0 && inflammation_num == 0 && headache_num == 0 && insomnia_num) {
      insomnia_num -= 1;
      $('#insomnia').val(insomnia_num);
      target.val(num);
    } else if (vitality_plus_button && headache_num > 0) { // 活力プラスボタン押した時
      headache_num -= 1;
      $('#headache').val(headache_num);
      target.val(num);
    } else if (vitality_plus_button && headache_num == 0 && inflammation_num > 0) {
      inflammation_num -= 1;
      $('#inflammation').val(inflammation_num);
      target.val(num);
    } else if (vitality_plus_button && headache_num == 0 && inflammation_num == 0 && insomnia_num > 0) {
      insomnia_num -= 1;
      $('#insomnia').val(insomnia_num);
      target.val(num);
    } else if (vitality_plus_button && headache_num == 0 && insomnia_num == 0 && insomnia_num == 0 && paschoactive_num > 0) {
      paschoactive_num -= 1;
      $('#paschoactive').val(paschoactive_num);
      target.val(num);
    } else if (vitality_plus_button && paschoactive_num == 0 && insomnia_num == 0 && insomnia_num == 0 && paschoactive_num == 0 && relax_num) {
      relax_num -= 1;
      $('#relax').val(relax_num);
      target.val(num);
    } else if (headache_plus_button && insomnia_num > 0) { // 頭痛プラスボタン押した時
      insomnia_num -= 1;
      $('#insomnia').val(insomnia_num);
      target.val(num);
    } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num > 0) {
      paschoactive_num -= 1;
      $('#paschoactive').val(paschoactive_num);
      target.val(num);
    } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num == 0 && vitality_num > 0) {
      vitality_num -= 1;
      $('#vitality').val(vitality_num);
      target.val(num);
    } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num == 0 && vitality_num == 0 && relax_num > 0) {
      relax_num -= 1;
      $('#relax').val(relax_num);
      target.val(num);
    } else if (headache_plus_button && insomnia_num == 0 && paschoactive_num == 0 && vitality_num == 0 && relax_num == 0 && inflammation_num) {
      inflammation_num -= 1;
      $('#inflammation').val(inflammation_num);
      target.val(num);
    } else if (insomnia_plus_button && vitality_num > 0) { // 不眠プラスボタン押した時
      vitality_num -= 1;
      $('#vitality').val(vitality_num);
      target.val(num);
    } else if (insomnia_plus_button && vitality_num == 0 && relax_num > 0) {
      relax_num -= 1;
      $('#relax').val(relax_num);
      target.val(num);
    } else if (insomnia_plus_button && vitality_num == 0 && relax_num == 0 && headache_num > 0) {
      headache_num -= 1;
      $('#headache').val(headache_num);
      target.val(num);
    } else if (insomnia_plus_button && vitality_num == 0 && relax_num == 0 && headache_num == 0 && inflammation_num > 0) {
      inflammation_num -= 1;
      $('#inflammation').val(inflammation_num);
      target.val(num);
    } else if (insomnia_plus_button && vitality_num == 0 && relax_num == 0 && headache_num == 0 && inflammation_num == 0 && paschoactive_num) {
      paschoactive_num -= 1;
      $('#paschoactive').val(paschoactive_num);
      target.val(num);
    }

    // マイナスボタンが押された時、最大値をもつパラメーターに割り振る
    if (relax_sub_button && relax_num > 0) { // リラックスマイナスボタン押した時
      target.val(num);
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
    } else if (inflammation_sub_button && inflammation_num > 0) { // 炎症鎮痛マイナスボタン押した時
      target.val(num);
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
    } else if (paschoactive_sub_button && paschoactive_num > 0) { // 精神作用マイナスボタン押した時
      target.val(num);
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
    } else if (vitality_sub_button && vitality_num > 0) { // 活力マイナスボタン押した時
      target.val(num);
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
    } else if (headache_sub_button && headache_num > 0) { // 頭痛マイナスボタン押した時
      target.val(num);
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
    } else if (insomnia_sub_button && insomnia_num > 0) { // 不眠マイナスボタン押した時
      target.val(num);
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
    }
 
  }

  const model_relax_array = Object.values(model_relax);
  const model_inflammation_array = Object.values(model_inflammation);
  const model_paschoactive_array = Object.values(model_paschoactive);
  // const result_array = [0, 0, 0, 0, 0]; // 調合結果の配列 [cbd,cbg,cbn,cbc,terpen]の順番

  console.log(model_relax_array);
  console.log(model_inflammation_array);
  console.log(model_paschoactive_array);

  // 調合ボタンクリックで数値取得
  $('#button').on('click', function () {
    const result_array = [0, 0, 0, 0, 0]; // 調合結果の配列 [cbd,cbg,cbn,cbc,terpen]の順番

    const relax_text = document.getElementById('relax');
    const inflammation_text = document.getElementById('inflammation');
    const paschoactive_text = document.getElementById('paschoactive');
    const vitality_text = document.getElementById('vitality');
    const headache_text = document.getElementById('headache');
    const insomnia_text = document.getElementById('insomnia');

    // 各パラメータの値を変数に代入
    const relax_number = relax_text.value;
    const inflammation_number = inflammation_text.value;
    const paschoactive_number = paschoactive_text.value;
    const vitality_number = vitality_text.value;
    const headache_number = headache_text.value;
    const insomnia_number = insomnia_text.value;

    const sum = Number(relax_number) + Number(inflammation_number) + Number(paschoactive_number)
      + Number(vitality_number) + Number(headache_number) + Number(insomnia_number);
    
    console.log(sum);

    const multiplier_relax_array = [];
    const multiplier_inflammation_array = [];
    const multiplier_paschoactive_array = [];
    const multiplier_vitality_array = [];
    const multiplier_headach_array = [];
    const multiplier_insomnia_array = [];

    // 空配列に値を代入
    for (let i = 0; i < 4; i++) {
      multiplier_relax_array.push(model_relax_array[i] * relax_number);
      multiplier_inflammation_array.push(model_inflammation_array[i] * inflammation_number);
      multiplier_paschoactive_array.push(model_paschoactive_array[i] * paschoactive_number);
      multiplier_vitality_array.push(model_relax_array[i] * vitality_number);
      multiplier_headach_array.push(model_inflammation_array[i] * headache_number);
      multiplier_insomnia_array.push(model_paschoactive_array[i] * insomnia_number);
    }

    console.log(multiplier_relax_array);
    console.log(multiplier_inflammation_array);
    console.log(multiplier_paschoactive_array);
    console.log(multiplier_vitality_array);
    console.log(multiplier_headach_array);
    console.log(multiplier_insomnia_array);
    result_array[0] += Math.round((multiplier_relax_array[0] + multiplier_inflammation_array[0] + multiplier_paschoactive_array[0] + multiplier_vitality_array[0] + multiplier_headach_array[0] + multiplier_insomnia_array[0]) / 18);
    result_array[1] += Math.round((multiplier_relax_array[1] + multiplier_inflammation_array[1] + multiplier_paschoactive_array[1] + multiplier_vitality_array[1] + multiplier_headach_array[1] + multiplier_insomnia_array[1]) / 18);
    result_array[2] += Math.round((multiplier_relax_array[2] + multiplier_inflammation_array[2] + multiplier_paschoactive_array[2] + multiplier_vitality_array[2] + multiplier_headach_array[2] + multiplier_insomnia_array[2]) / 18);
    result_array[3] += Math.round((multiplier_relax_array[3] + multiplier_inflammation_array[3] + multiplier_paschoactive_array[3] + multiplier_vitality_array[3] + multiplier_headach_array[3] + multiplier_insomnia_array[3]) / 18);
    result_array[4] += 100 - (result_array[0] + result_array[1] + result_array[2] + result_array[3]);
    // console.log(relax_number);
    // console.log(inflammation_number);
    // console.log(paschoactive_number);
    // console.log(multiplier_relax_array);
    // console.log(multiplier_inflammation_array);
    // console.log(multiplier_paschoactive_array);
    console.log(result_array);
    document.getElementById('cbd').textContent = ' ' + result_array[0] + '%';
    document.getElementById('cbg').textContent = ' ' + result_array[1] + '%';
    document.getElementById('cbn').textContent = ' ' + result_array[2] + '%';
    document.getElementById('cbc').textContent = ' ' + result_array[3] + '%';
    document.getElementById('terpene').textContent = ' ' + result_array[4] + '%';
  });

});
