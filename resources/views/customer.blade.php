@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row ">
            <div class="col-2 m-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
                <button type="button" class="btn btn-primary create mt-3" data-toggle="modal">Tambah</button>
            </div>
            <div class="col-4 m-3">
                <label for="">Cari</label>
                <input type="text" id="search" class="form-control">
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
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-row">
                  <div class="col">
                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name">
                    <input type="text" id="id" name="id" class="form-control" hidden placeholder="First name">
                  </div>
                  <div class="col">
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name">
                  </div>
                  <div class="col">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                  </div>
                  <div class="col">
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone">
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save">Save changes</button>
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
    $("#jumlah").change(function (e) {
        e.preventDefault();
        data();
    });
    data();
    function data() {
       $.ajax({
            type: "get",
            url: "{{ route('customer.data') }}",
            data: {
                'search': $('#search').val(),
                "jumlah":$('#jumlah').val(),
            },
            success: function (data) {
                $("#data").html('');
                $.each(data.data, function (i, v) {
                    var content = `<div class="col-3 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title">Nama : ${v.name}</h5>
                                            <p class="card-text">No Hp : ${v.phone}</p>
                                            <p class="card-text">Alamat : ${v.address}</p>
                                            <p class="card-text">Gabung : ${v.created_at}</p>
                                            <a href="#" data-first_name="${v.first_name}"data-last_name="${v.last_name}"data-address="${v.address}"data-phone="${v.phone}"data-id="${v.id}"
                                             class="btn btn-primary edit">Edit</a>
                                            <a href="#" class="btn btn-danger delete" data-id="${v.id}">Delete</a>
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

    $(".create").click(function (e) {
        e.preventDefault();
        $('#form').modal('show');
    });
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
                                            <h5 class="card-title">Nama : ${v.name}</h5>
                                            <p class="card-text">No Hp : ${v.phone}</p>
                                            <p class="card-text">Alamat : ${v.address}</p>
                                            <p class="card-text">Gabung : ${v.created_at}</p>
                                            <a href="#" data-first_name="${v.first_name}"data-last_name="${v.last_name}"data-address="${v.address}"data-phone="${v.phone}"data-id="${v.id}"
                                             class="btn btn-primary edit">Edit</a>
                                            <a href="#" class="btn btn-danger delete" data-id="${v.id}">Delete</a>
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
    $("#data").on("click",".delete", function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "{{ route('customer.destroy') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : $(this).data('id'),
                    },
                    success: function (data) {
                        if (data.status == true) {
                            // data();
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            setInterval(location.reload(), 3000);
                        }else{
                            Swal.fire(
                            'Error Deleted!',
                            )
                        }
                    }
                });

            }
        })


    });
    $("#data").on("click",".edit", function () {
        $("#first_name").val($(this).data("first_name"));
        $("#last_name").val($(this).data("last_name"));
        $("#address").val($(this).data("address"));
        $("#phone").val($(this).data("phone"));
        $("#id").val($(this).data("id"));
        $('#form').modal('show');
    });

    $(".save").click(function (e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "{{ route('customer.store') }}",
            data: {
                '_token':"{{ csrf_token() }}",
                "first_name" : $("#first_name").val(),
                "last_name" : $("#last_name").val(),
                "address" : $("#address").val(),
                "phone" : $("#phone").val(),
                "id" : $("#id").val(),
            },
            success: function (data) {
                if (data.status == true) {
                    alert("Data berhasil di tambahkan");
                    data();
                    $("#first_name").val('');
                    $("#last_name").val('');
                    $("#address").val('');
                    $("#phone").val('');
                    $("#id").val('');
                    $('#form').modal('hide');
                }else{
                    alert("Data gagal Di tambahkan")
                }
            }
        });
    });
</script>
@endsection
