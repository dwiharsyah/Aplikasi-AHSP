const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        swal({
            title: 'Data',
            text: 'Berhasil ' + flashData,
            icon: 'success'
        });
    }

const flashpass = $('.flash-pass').data('flashdata');

    if (flashpass) {
        swal({
            title: 'Change Password',
            text: 'Berhasil ' + flashpass,
            icon: 'success'
        });
    }

const flashpasspesan = $('.flash-passpesan').data('flashdata');

    if (flashpasspesan) {
        swal({
            title: 'Change Password',
            text: flashpasspesan,
            icon: 'error'
        });
    }
const row = $('.flash-delete').data('flashdata');

    if (row) {
        swal({
            title: 'Data',
            text: 'Masih digunakan Sebanyak ' + row + ' Data',
            icon: 'error'
        });
    }

const msg = $('.flash-pesan').data('flashdata');

    if (msg) {
        swal({
            title: 'Data',
            text: msg,
            icon: 'error'
        });
    }

    $('.tombol-hapus').on('click', function(e) {

        e.preventDefault();
        // Mencegah eksekusi hapus
        const href = $(this).attr('href');

        swal({
            title: 'Apakah Anda Yakin?',
            text: "Data Akan Dihapus!",
            icon: 'warning',
            buttons: [true, 'Hapus Data!'],
        }).then((result) => {
            if (result) {
                document.location.href = href;
            }
        })
    });

    $('select#kode1').on('change', function() {
        $('#kode2').val($(this).val() + '.');
    });    

    if ($(location).attr('href') == 'http://localhost/Project/pu/Ahsp2/tambah') { 
        $(document).ready(function(){
            $('#kode2').val($('select#kode1').val() + '.'); 
        });
    }    

    $('select#kode2').on('change', function() {
        $('#kode3').val($(this).val() + '.');
    });

    if ($(location).attr('href') == 'http://localhost/Project/pu/Ahsp3/tambah') { 
        $(document).ready(function(){
            $('#kode3').val($('select#kode2').val() + '.'); 
        });
    }    
    
    $('select#kode3').on('change', function() {
        $('#kode4').val($(this).val() + '.');
    });

    if ($(location).attr('href') == 'http://localhost/Project/pu/Ahsp4/tambah') { 
        $(document).ready(function(){
            $('#kode4').val($('select#kode3').val() + '.'); 
        });
    }    