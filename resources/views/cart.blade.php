@include('layout.header')
<section class="cart mt-5" id="cart">
    <div class="container">
        <h1 class="fw-bold display-2 text-center" style="color: #d7bd94">CART</h1>
        @if (Cart::count() > 0)
        <table class="col-sm-12 mt-5 text-white">
            <thead>
                <tr>
                <th scope="col">Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty (Kg)</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @if (!empty($cartContent))
                @foreach ($cartContent as $item)
                <tr>
                    <th><img src="{{ asset('storage/'. $item->options->gambar) }}" class="w-50" style="max-width: 100px;" alt=""></th> <!-- Menambahkan max-width pada gambar -->
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>
                        <div class="input-group quantity" style="width: 150px;">
                            <div class="input-group-btn">
                                <button class="btn btn-dark border border-secondary px-2 sub" data-id="{{ $item->rowId }}" >
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control text-center" disabled value="{{$item->qty}}" max="{{$item->options->stok}}"/>

                            <div class="input-grup-btn">
                                <button class="btn btn-dark border border-secondary px-2 add" data-id="{{ $item->rowId }}">
                                <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                    </td>
                    <td>{{$item->qty * $item->price}}</td>
                    <td>
                        <button class="btn btn-danger btn-just-icon btn-sm" onclick="deleteItem('{{ $item->rowId}} ')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-grid d-md-flex justify-content-md-end mt-5">
            <a href="{{route('checkout')}}">
                <button class="btn btn-dark px-5" type="button">
                    Buy
                </button>
            </a>
        </div>
        @else
        <div class="col-md-12">
            <div class="card" style="background-color: #d7bd94">
                <div class="card-body d-flex justify-content-center" >
                    <h4>Ohh NOO, Your Cart is Empty!</h4>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<script>
    $('.add').click(function(){
        var rowId = $(this).data('id');
        var qtyElement = $(this).closest('tr').find('input[type="text"]');
        var currentQty = parseInt(qtyElement.val());
        var maxQty = parseInt(qtyElement.attr('max'));

        if (currentQty < maxQty) {
            qtyElement.val(currentQty + 1);
            var newQty = qtyElement.val();
            updateCart(rowId, newQty);
        } else {
            alert("Quantity exceeds available stock!");
        }
    });



    $(document).ready(function() {
        $('input[type="text"]').on('input', function() {
            var rowId = $(this).closest('tr').find('.add').data('id');
            var newQty = $(this).val();
            updateCart(rowId, newQty);
        });
    });

    $('.sub').click(function(){
        var qtyElement = $(this).parent().next();
        var qtyValue = parseInt(qtyElement.val());
        if (qtyValue > 1) {
            qtyElement.val(qtyValue-1);
            var rowId = $(this).data('id');
            var newQty = qtyElement.val();
            updateCart(rowId, newQty);
        }
    });

    function updateCart(rowId, qty){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{route("updateCart")}}',
            type: 'post',
            data: {
                rowId:rowId,
                qty:qty,
                _token: csrfToken
            },
            dataType: 'json',
            success: function(response){
                if(response.status == true){
                    window.location.href = '{{route("cart")}}';
                } else {
                    alert(response.message);
                }
            }
        });
    }
    function deleteItem(rowId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: '{{route("deleteItem.cart")}}',
                type: 'post',
                data: {
                    rowId:rowId,
                    _token: csrfToken
                },
                dataType: 'json',
                success: function(response){
                    window.location.href = '{{route("cart")}}';
                }
            });
        }
    }
</script>
