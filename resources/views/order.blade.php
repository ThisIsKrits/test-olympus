@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row ">
            <div class="col-2 m-3">
                <h6 class="m-0 font-weight-bold text-primary">Order</h6>
            </div>
            <div class="col-4 m-3">
                <label for="">Cari</label>
                <input type="date" id="tgl" class="form-control">
            </div>
            <div class="col-4 m-3">
                <label for="">Perhalaman</label>
                <select name="jumlah" id="jumlah" class="form-control">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row" id="data">
        </div>
        <nav aria-label="Page navigation example mt-3">
            <ul class="pagination link  mt-3">

            </ul>
            <ul class="pagination meta  mt-3">

            </ul>
          </nav>
    </div>
</div>
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="details">
            </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>
<script>
    $('#search').on('keyup', function(){ data();});
    $('#tgl').on('change', function(){ data();});
    $("#jumlah").change(function (e) {
        e.preventDefault();
        data();
    });
    data();
    function data() {
       $.ajax({
            type: "get",
            url: "{{ route('order.data') }}",
            data: {
                'search': $('#search').val(),
                'tgl': $('#tgl').val(),
                "jumlah":$('#jumlah').val(),
            },
            success: function (data) {
                $("#data").html('');
                $.each(data.data, function (i, v) {
                    var content = `<div class="col-3 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title">Invoice : ${v.invoice}</h5>
                                            <h5 class="card-title">Nama : ${v.name}</h5>
                                            <p class="card-text">No Hp : ${v.phone}</p>
                                            <p class="card-text">Kecamatan : ${v.kecamatan}</p>
                                            <p class="card-text">Kelurahan : ${v.kelurahan}</p>
                                            <p class="card-text">Alamat : ${v.address}</p>
                                            <a href="#" data-url="${v.url}" data-bs-toggle="modal" data-bs-target="#detail"
                                             class="btn btn-primary detail">Detail</a>
                                            </div>
                                        </div>
                                    </div>`
                    $("#data").append(content);
                });
                $('.link').html(`
                        <li class="page-item"><a class="page-link" data-url="${data.links.first}"href="#">Page Pertama</a></li>
                        <li class="page-item"><a class="page-link" data-url="${data.links.prev}"href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" data-url=""href="#">${data.meta.current_page}</a></li>
                        <li class="page-item"><a class="page-link" data-url="${data.links.next}" href="#">Next</a></li>
                        <li class="page-item"><a class="page-link" data-url="${data.links.last}" href="#">Page Terakhir</a></li>
                `);
                $('.meta').html(`
                        <li class="page-item"><a class="page-link" >Total :${data.meta.total}</a></li>
                        <li class="page-item"><a class="page-link" >Perhalaman: ${data.meta.per_page}</a></li>
                        <li class="page-item"><a class="page-link">Dari: ${data.meta.to}</a></li>
                `);
            }

        });
    }
    $(".pagination").on("click",".page-link", function () {
        $.ajax({
            type: "get",
            url: $(this).data('url')+"&jumlah="+$('#jumlah').val(),
            success: function (data) {
                $("#data").html('');
                $.each(data.data, function (i, v) {
                    var content = `<div class="col-3 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title">Invoice : ${v.invoice}</h5>
                                            <h5 class="card-title">Nama : ${v.name}</h5>
                                            <p class="card-text">No Hp : ${v.phone}</p>
                                            <p class="card-text">Kecamatan : ${v.kecamatan}</p>
                                            <p class="card-text">Kelurahan : ${v.kelurahan}</p>
                                            <p class="card-text">Alamat : ${v.address}</p>
                                            <a href="#" data-url="${v.url}" data-bs-toggle="modal" data-bs-target="#detail"
                                             class="btn btn-primary detail">Detail</a>
                                            </div>
                                        </div>
                                    </div>`
                    $("#data").append(content);
                });
                $('.link').html(`
                        <li class="page-item"><a class="page-link" data-url="${data.links.first}"href="#">Page Pertama</a></li>
                        <li class="page-item"><a class="page-link" data-url="${data.links.prev}"href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" data-url=""href="#">${data.meta.current_page}</a></li>
                        <li class="page-item"><a class="page-link" data-url="${data.links.next}" href="#">Next</a></li>
                        <li class="page-item"><a class="page-link" data-url="${data.links.last}" href="#">Page Terakhir</a></li>
                `);
                $('.meta').html(`
                        <li class="page-item"><a class="page-link" >Total :${data.meta.total}</a></li>
                        <li class="page-item"><a class="page-link" >Perhalaman: ${data.meta.per_page}</a></li>
                        <li class="page-item"><a class="page-link">Dari: ${data.meta.to}</a></li>
                `);
            }

        });
    });
    $("#data").on("click",".detail", function () {
        $.ajax({
            type: "get",
            url: $(this).data('url'),
            success: function (data) {
                $(".details").html('');
                $.each(data.data.detail, function (i, v){
                    var content = `
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Nama Produk : ${v.product.product_name}</h5>
                                <p class="card-text">Price : ${v.price}</p>
                                <p class="card-text">Qty : ${v.qty}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                    $('.details').append(content);
                });

            }

        });
    });
</script>
@endsection
