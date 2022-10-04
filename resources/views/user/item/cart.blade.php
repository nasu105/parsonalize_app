<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/css/jquery.mb.YTPlayer.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/jquery.mb.YTPlayer.min.js"></script>

<x-app-layout>
  
  <div class="py-12 cart_main_content">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="main_content">
      @if (count($items) == false) 
      カートに商品が入っていません。
      @else

        <!-- 作成済の商品を作成-->
        <div class="item_content">
          @foreach ($items as $item)
            <div class="item_box">
              <h1 class="item_title">PERSONALIZE LIQUID 1ml</h1>
              <div class="item_child">
                <div class="item_discription">
                  <p>リラックス{{ $item->relax }}</p>
                  <p>炎症鎮痛{{ $item->inflammation }}</p>
                  <p>精神作用{{ $item->paschoactive }}</p>
                  <p>集中力{{ $item->vitality }}</p>
                  <p>入眠{{ $item->headache }}</p>
                  <p>頭痛{{ $item->insomnia }}</p>
                  <!-- <p>
                    作成日時
                    <?php 
                    $updated_at = $item->created_at;
                    echo date('Y年n月j日', strtotime($updated_at));
                    ?>
                  </p> -->
                </div>
                <div class="price_delete">
                  <div class="item_price">
                    <p>¥{{ $item->price }}</p>
                  </div>
                  <div class="delete_content">
                    <form action="{{ route('user.item.destroy', $item->id)}}" method="POST">
                      @method('delete')
                      @csrf
                      <button type="submit" class="delete_button">削除</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div>
          <p>カートの小計:</p>
          <div class="total_price_box">
            <span style="white-space:nowrap;">
              ¥<input type="text" id="total_price" value="0" readonly class="total_price" style="background-color: transparent;">
            </span>
          </div>
          <button onclick="location.href='{{ route('user.cart.checkout')}}'" class="buy_button">レジに進む</button>
        </div>

      @endif 
      </div>
    </div>
  </div>
  <div id="ytPlayer" data-property="{
    videoURL: 'https://www.youtube.com/watch?v=6TDvzv6mQic',
    autoPlay: true,
    loop: 1,
    mute: true,
    showControls: false,
    showYTLogo: false,
  }">

  <script>
    $(function () {

      $("#ytPlayer").YTPlayer(); //youtubeリンク対応

      const items = @json($items); // phpdateをjsに変更
      // console.log(items);
      const price_array = items.map((obj) => obj.price); // priceだけを格納
      // console.log(price_array);
      const total_price = price_array.reduce((a, b) => {
        return a + b;
      });

      const total_price_str = total_price.toLocaleString();
      console.log(total_price);

      $('#total_price').val(total_price_str);
    });



  </script>

</x-app-layout>