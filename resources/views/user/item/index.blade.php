<link rel="stylesheet" href="{{ asset('css/index.style.css') }}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Created Collection') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hiddn shadow-sm sm:rounded-lg">
        <div class="bg-white border-b border-gray-200">
          <table class="table table-striped">
            <thead>
              <!-- 見出し作成-->
              <tr>
                <th>調合ナンバー</th>
                <th>リラックス</th>
                <th>炎症鎮痛</th>
                <th>精神作用</th>
                <th>活力</th>
                <th>頭痛</th>
                <th>不眠</th>
                <th>作成日時</th>
              </tr>
            </thead>

            <tbody>
              <!-- 作成済の商品を作成-->
              @foreach ($items as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->relax }}</td>
                <td>{{ $item->inflammation }}</td>
                <td>{{ $item->paschoactive }}</td>
                <td>{{ $item->vitality }}</td>
                <td>{{ $item->headache }}</td>
                <td>{{ $item->insomnia }}</td>
                <td>
                  <?php 
                  $updated_at = $item->created_at;
                  echo date('Y年n月j日', strtotime($updated_at));
                  ?>
                </td>
                @if($item-> price != 0)
                <!-- 星レビューボタン -->
                  <form action="{{ route('user.item.update', $item->id) }}" method="POST" 
                  name="rate-form" id="rate-form{{$item->id}}" >
                    @method('put')
                    @csrf 
                    <td>
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
                    </td>
                  </form>
                @endif                  
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
  <script>
    $(function () {
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