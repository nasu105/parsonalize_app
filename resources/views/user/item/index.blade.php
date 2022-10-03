<link rel="stylesheet" href="{{ asset('css/index.style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/css/jquery.mb.YTPlayer.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/jquery.mb.YTPlayer.min.js"></script>

<x-app-layout>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <!-- <div class="bg-white overflow-hiddn shadow-sm sm:rounded-lg"> -->
        
        @if (count($items) == false) 
          過去の注文がありません。
        @else

          <!-- 作成済の商品を作成-->
          <div>
            @foreach ($items as $item)
              <div class="item_box">
                <div class="item_discription">

                
                  <h1 class="item_title">PERSONALIZE LIQUID 1ml</h1>
                  <p>リラックス{{ $item->relax }}</p>
                  <p>炎症鎮痛{{ $item->inflammation }}</p>
                  <p>精神作用{{ $item->paschoactive }}</p>
                  <p>活力{{ $item->vitality }}</p>
                  <p>頭痛{{ $item->headache }}</p>
                  <p>不眠{{ $item->insomnia }}</p>
                  <!-- <p>
                  <?php 
                  $updated_at = $item->created_at;
                  echo date('Y年n月j日', strtotime($updated_at));
                  ?></p> -->
                  <!-- 星レビューボタン -->
                  <form action="{{ route('user.item.update', $item->id) }}" method="POST" 
                  name="rate-form" id="rate-form{{$item->id}}" >
                    @method('put')
                    @csrf 
                    <div class="star-form">
                      <input id="{{$item->id}}star5" type="radio" name="star" value="5" onclick="document.rate-form.submit();">
                      <label for="{{$item->id}}star5">★</label>
                      <input id="{{$item->id}}star4" type="radio" name="star" value="4" onclick="document.rate-form.submit();">
                      <label for="{{$item->id}}star4">★</label>
                      <input id="{{$item->id}}star3" type="radio" name="star" value="3" onclick="document.rate-form.submit();">
                      <label for="{{$item->id}}star3">★</label>
                      <input id="{{$item->id}}star2" type="radio" name="star" value="2" onclick="document.rate-form.submit();">
                      <label for="{{$item->id}}star2">★</label>
                      <input id="{{$item->id}}star1" type="radio" name="star" value="1" onclick="document.rate-form.submit();">
                      <label for="{{$item->id}}star1">★</label>
                      <input type="hidden" value="{{$item->id}}" name="item_id"> 
                    </div>
                  </form>
                </div>
                <div class="item_price">
                  <p>¥{{ $item->price }}</p>
                </div>
              </div>            
            @endforeach
          </div>
        @endif

        
      <!-- </div> -->
    </div>
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

      const items = @json($items); // phpの変数をjsに変更
      let item_id_array = [];
      let star_val_array = [];
      // console.log(items[0]);
      // console.log(items.length);
      // console.log(items);

      for (let i = 0; i < items.length; i++) { // item_id,star_valを空配列に格納
        let obj = items[i];
        let item = Object.values(obj);
        console.log(item);
        item_id_array.push(item[0]);
        star_val_array.push(item[12]);
      }
      
      console.log(item_id_array);
      console.log(star_val_array);

      // starに色を付ける処理
      for (let i =0; i < item_id_array.length ; i++) {
        if (star_val_array[i] == 0) {
          false;
        } else {
          const element = document.getElementById('rate-form' + item_id_array[i]); // form要素を取得
          console.log(element);
          const elements = element.star; // form要素内のラジオボタングループ(name="star")を取得
          // console.log(elements);
          elements[5 - star_val_array[i]].checked = true;
        }
      };


      // const star = $('#star').val();
      // console.log(star);

      // レビューの値が変更された場合DBに値を送信

      /* $('input:radio[name="star"]').change(function() { // レビューが変更された時
        const rate_form_id = $(this).closest('form');
        console.log(rate_form_id);
        console.log(rate_form_id.attr('id'));
        console.log($(this).attr('id'));
        // const star_val = $('input:radio[name="star"]:checked').val() // チェックされたvalを取得
        // console.log(star_val);
        // $(this).closest('form').submit();
      }); */
    });


  </script>
</x-app-layout>