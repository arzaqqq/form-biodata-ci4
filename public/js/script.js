<script>
// Add this script after the existing scripts in your file
$('#gambar').change(function() {
    var input = this;
    var url = URL.createObjectURL(input.files[0]);
    $('#img-preview').attr('src', url).show();
});

function hapusData(id) {
    var result = confirm('Yakin mau melakukan proses delete');
    if (result) {
        $.ajax({
            url: "<?php echo site_url("biodata/hapusData") ?>/" + id,
            type: "get",
            success: function(hasil) {
                console.log(hasil);
                // Implementasikan logika atau tampilan yang diperlukan setelah penghapusan
                // Misalnya, memperbarui tampilan tabel atau menampilkan pesan sukses/kesalahan
                alert('Data berhasil dihapus');
                updateTable(); // Refresh halaman setelah penghapusan
            }
        });
    }
}


function edit(id) {
    $.ajax({
        url: "<?php echo site_url("biodata/edit") ?>/" + id,
        type: "get",
        success: function(hasil) {
            var obj = $.parseJSON(hasil);
            if (obj.id !== '') {
                $("#inputid").val(obj.id);
                $("#inputnama").val(obj.nama);
                $("#inputalamat").val(obj.alamat);
                $("#inputumur").val(obj.umur);
                $("#inputkelamin").val(obj.kelamin);
                $("#inputagama").val(obj.agama);
                $("#inputstatus").val(obj.status);
                $("#inputgambar_lama").val(obj.gambar);



            }
        }
    });
}


function bersihkan() {
    $('#inputid').val('');
    $('#inputnama').val('');
    $('#inputalamat').val('');
    $('#inputumur').val('');
    $('#inputkelamin').val('');
    $('#inputagama').val('');
    $('#inputstatus').val('');
    $('#img-preview').hide();
}
$('.tombol-tutup').on('click', function() {
    if ($('.sukses').is(".visible")) {
        window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING']
                                    ?>";
    }
    $('.alert ').hide();
    bersihkan();
});


$('#tombolsimpan').on('click', function() {
    var $id = $('#inputid').val();
    var $nama = $('#inputnama').val();
    var $alamat = $('#inputalamat').val();
    var $umur = $('#inputumur').val();
    var $kelamin = $('#inputkelamin').val();
    var $agama = $('#inputagama').val();
    var $status = $('#inputstatus').val();

    // Create a FormData object to handle file uploads
    var formData = new FormData();
    formData.append('id', $id);
    formData.append('nama', $nama);
    formData.append('alamat', $alamat);
    formData.append('umur', $umur);
    formData.append('kelamin', $kelamin);
    formData.append('agama', $agama);
    formData.append('status', $status);

    // Append the selected file to the FormData object
    var gambarFile = $('#gambar')[0].files[0];
    if (gambarFile) {
        // Append the selected file to the FormData object
        formData.append('gambar', gambarFile);
    } else {
        // Jika tidak ada gambar baru, gunakan gambar yang sudah ada sebelumnya
        formData.append('gambar_lama', gambarLama);
    }

    $.ajax({
        url: "<?= site_url('Biodata/simpan') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(hasil) {
            console.log(hasil);
            var $obj = JSON.parse(hasil);
            if ($obj.error) {
                $('.error').show();
                $('.error').html($obj.error);
                $('.sukses').hide();
            } else {
                $('.sukses').show();
                $('.sukses').html($obj.sukses);
                $('.error').hide();
            }
        }
    });
    bersihkan();
});

function updateTable() {
    var katakunci = $('#button-addon1').val();
    $.ajax({
        url: "<?= site_url('Biodata/cari') ?>", // Ganti dengan URL yang sesuai
        type: "GET",
        data: {
            katakunci: katakunci
        },
        success: function(data) {
            $('#tableContainer').html(data);
        }
    });
}
</script>