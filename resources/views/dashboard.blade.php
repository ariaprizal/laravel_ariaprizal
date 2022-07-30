<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Box Icon -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <section>
        <div class="menu">
            <nav>
                <ul class="menu">
                    <li ><a class="nav-link active" href="{{ route('dashboard') }}">Rumah Sakit</a></li>
                    <li ><a class="nav-link " href="{{ route('pasien') }}">Pasien</a></li>
                </ul>
            </nav>
        </div>
        <div class="form-data">
            <div class="container-data">
                <form id="form-tambah">
                    @csrf
                    <div class="data-input">
                        <input type="hidden" name="id" id="id">
                        <div class="">
                            <input type="text" name="nama_rs" id="nama_rs" placeholder="Masukan Nama Rumah Sakit">
                        </div>
                        <div class="">
                            <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat">
                        </div>
                        <div class="">
                            <input type="text" name="email" id="email" placeholder="Masukan Email">
                        </div>
                        <div class="">
                            <input type="text" name="tlp" id="tlp" placeholder="Masukan No Telepon">
                        </div>
                        <div class="">
                            <button type="button" id="simpan-data">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-data">
            <table class="table table-bordered table-master ">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Rumah Sakit</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </section>




    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">

        $(function() 
        {   
            var table = $('.table-master').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_rs',
                        name: 'nama_rs'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'tlp',
                        name: 'tlp'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

        });

        $('#simpan-data').on('click', () =>
        {
            if ($('#simpan-data').text() === 'Simpan') 
            {
                $.ajax({
                    url : "{{route('save.master')}}",
                    type : "post",
                    dataType : 'json',
                    data : {
                        nama_rs : $('#nama_rs').val(),
                        alamat : $('#alamat').val(),
                        email : $('#email').val(),
                        tlp : $('#tlp').val(),
                        "_token" : "{{csrf_token()}}"
                    },
                    success : function (res){
                        if ($.isEmptyObject(res.error)) 
                        {
                            alert(res.text);
                            $('.table-master').DataTable().ajax.reload();
                            $('#form-tambah')[0].reset();  
                        }
                        else
                        {
                            $.each(res.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }
                    },
                    error : function (xhr){
                        alert(xhr.text);
                    }
        
                });
            }
            else if (($('#simpan-data').text() === 'Update')) 
            {
                $.ajax({
                    url : "{{route('save.edit')}}",
                    type : "post",
                    data : {
                        id : $('#id').val(),
                        nama_rs : $('#nama_rs').val(),
                        alamat : $('#alamat').val(),
                        email : $('#email').val(),
                        tlp : $('#tlp').val(),
                        "_token" : "{{csrf_token()}}"
                    },
                    success : function (res){
                        alert(res.text);
                        $('.table-master').DataTable().ajax.reload();
                        $('#form-tambah')[0].reset();
                        $('#simpan-data').text("Simpan")
                    },
                    error : function (xhr){
                        alert(xhr.text);
                    }
        
                });
            }
        });

        $(document).on('click', '.edit', function ()
        {
            let id = $(this ).attr('id');
            $('#simpan-data').text('Update');

            $.ajax({
                url : "{{route('edit')}}",
                type : 'post',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success : function(res){    
                    $('#id').val(res.data.id)
                    $('#nama_rs').val(res.data.nama_rs)
                    $('#alamat').val(res.data.alamat)
                    $('#email').val(res.data.email)
                    $('#tlp').val(res.data.tlp)
                }
            })
        });

        $(document).on('click', '.delete', function ()
        {
            let id = $(this).attr('id');
            console.log(id);
            if (confirm("Apakah Anda Yakin Ingin Mengapus Data Tersebut?")) 
            {
                $.ajax({
                    url : "{{route('delete')}}",
                    type : "post",
                    data : {
                        id : id,
                        _token : "{{csrf_token()}}"
                    },
                    success : function (res){
                        alert(res.text);
                        $('.table-master').DataTable().ajax.reload();
                    },
                    error : function (xhr){
                        alert(xhr.text);
                    }
                });
            }
        });
    </script>
</body>
</html>