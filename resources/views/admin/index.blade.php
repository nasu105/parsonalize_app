<link rel="stylesheet" href="{{ asset('css/admin_index.css') }}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<x-app-layout>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hiddn sm:rounded-lg">
        <div class="bg-white">
          <table class="table table-striped">
            <thead>
              <!-- 見出し作成-->
              <tr>
                <th>注文番号</th>
                <th>注文者名</th>
                <th>注文金額</th>
                <!-- <th>リラックス</th>
                <th>炎症鎮痛</th>
                <th>精神作用</th>
                <th>集中力</th>
                <th>頭痛</th>
                <th>不眠</th> -->
                <th>注文日時</th>
              </tr>
            </thead>

            <tbody>
              <!-- 作成済の商品を作成-->
              @foreach ($order_items as $order_item)
              <tr>
                <!-- 詳細画面へのリンク -->
                  <td><a href="{{ route('admin.usersitem.show',$order_item->id) }}">{{ $order_item->id }}</a></td>
                  <td><a href="{{ route('admin.usersitem.show',$order_item->id) }}">{{ $order_item->user->name }}</a></td>
                  <td><a href="{{ route('admin.usersitem.show',$order_item->id) }}">¥{{ $order_item->price }}</a></td>
                  <!-- <td>{{ $order_item->relax }}</td>
                  <td>{{ $order_item->inflammation }}</td>
                  <td>{{ $order_item->paschoactive }}</td>
                  <td>{{ $order_item->vitality }}</td>
                  <td>{{ $order_item->headache }}</td>
                  <td>{{ $order_item->insomnia }}</td> -->
                  <td>
                    <a href="{{ route('admin.usersitem.show',$order_item->id) }}">
                      {{ $order_item->created_at }}
                    </a>
                  </td>       
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
      const items = @json($order_items); // phpの変数をjsに変更
      
    });


  </script>
</x-app-layout>