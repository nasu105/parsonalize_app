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
                <p>test</p>
                <p>test2</p>
                <p>test3</p>
                <p>test4</p>
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
                @if($item->sum_price != null)
                <!-- 星レビューボタン -->
                <form action="{{ route('user.star.store') }}" method="POST" name="rate-form" id="rate-form">
                  @csrf
                  <td>
                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                    <div class="star-form">
                      <input id="star5" type="radio" name="star" id="star" value="5">
                      <label for="star5">★</label>
                      <input id="star4" type="radio" name="star" id="star" value="4">
                      <label for="star4">★</label>
                      <input id="star3" type="radio" name="star" id="star" value="3">
                      <label for="star3">★</label>
                      <input id="star2" type="radio" name="star" id="star" value="2">
                      <label for="star2">★</label>
                      <input id="star1" type="radio" name="star" id="star" value="1">
                      <label for="star1">★</label>
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
      console.log(items);

      // const star = $('#star').val();
      // console.log(star);

      // レビューの値が変更された場合DBに値を送信
      $('input:radio[name="star"]').change(function() { // レビューが変更された時
        // const star_val = $('input:radio[name="star"]:checked').val() // チェックされたvalを取得
        // console.log(star_val);
        $('#rate-form').submit();
      });
    });


  </script>
</x-app-layout>