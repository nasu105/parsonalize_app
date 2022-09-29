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
                <th>リラックス</th>
                <th>炎症鎮痛</th>
                <th>精神作用</th>
                <th>活力</th>
                <th>頭痛</th>
                <th>不眠</th>
                <th>作成日時</th>
                <th>商品金額</th>
              </tr>
            </thead>

            <tbody>
              <!-- 作成済の商品を作成-->
              @foreach ($items as $item)
              <tr>
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
                <td>{{ $item->price }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div>
            <p><label for="">合計金額:<input type="text" id="total_price" value="0" readonly>円</label></p>
          </div>
          <button type="submit" id="order_button">レジに進む</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function () {
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