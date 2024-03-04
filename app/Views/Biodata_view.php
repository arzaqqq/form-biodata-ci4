<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Form Biodata
                    </div>
                    <div class="card-body">
                        <form id="searchForm" method="get">
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Cari</button>
                                <input type="text" class="form-control" name="katakunci" placeholder="Masukan kata kunci" aria-label="Example text with button addon" aria-describedby="button-addon1" value="<?php echo $katakunci ?>">
                            </div>
                        </form>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Biodata Baru
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form Biodata</h5>
                                        <button type="button" class="btn-close ms-auto tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Your form content goes here -->

                                        <!-- ALERT GAGAL -->
                                        <div class="alert alert-danger error" style="display: none;" role="alert"></div>
                                        <!-- ALERT sukses -->

                                        <div class=" alert alert-primary sukses" style="display: none;" role=" alert">
                                        </div>
                                        <input type="hidden" id="inputid" name="id">
                                        <div class=" mb-3">
                                            <label for="inputnama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="inputnama">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputalamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="inputalamat">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputumur" class="form-label">Umur</label>
                                            <input type="text" class="form-control" id="inputumur">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputkelamin" class="form-label">Kelamin</label>
                                            <select id="inputkelamin">
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputagama" class="form-label">Agama</label>
                                            <select id="inputagama">
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Khonhucu">Khonhucu</option>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputstatus" class="form-label">Status</label>
                                            <select id="inputstatus">
                                                <option value="Jomblo">Jomblo</option>
                                                <option value="Menikah">Menikah</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputgambar" class="form-label">Masukan foto anda</label>
                                            <br>
                                            <input type="file" id="gambar" name="gambar" id="inputgambar" accept="image/*">
                                            <br>
                                            <img src="" alt="Preview" id="img-preview" style="max-width: 100%; max-height: 200px; margin-top: 10px; display: none;">
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary tombol-tutup" y data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary" id="tombolsimpan">Simpan</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>umur</th>
                            <th>kelamin</th>
                            <th>Agama</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        foreach ($datadatadiri as $k => $v) {
                            $nomor = $nomor + 1;
                        ?>
                            <tr>
                                <td><?php echo $nomor ?></td>
                                <td> <?php echo $v['nama'] ?></td>
                                <td><?php echo $v['alamat'] ?></td>
                                <td><?php echo $v['umur'] ?></td>
                                <td><?php echo $v['kelamin'] ?></td>
                                <td><?php echo $v['agama'] ?></td>
                                <td><?php echo $v['status'] ?></td>
                                <td><img src="<?= base_url($v['gambar']) ?>" alt="image" style="max-width: 100px; max-height: 100px;"></td>


                                <td> <button type=" button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $v['id'] ?>)">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick=" hapusData(<?php echo $v['id'] ?>)">Delete </button>

                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $linkpagination = $pager->links();
                $linkpagination = str_replace('<li class="active">', '<li class="pages-item active">', $linkpagination);
                $linkpagination = str_replace('<li>', '<li class="page-item">', $linkpagination);
                $linkpagination = str_replace("<a", "<a class='page-link'", $linkpagination);
                echo $linkpagination;
                ?>

            </div>
        </div>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
    </script>
    <!-- ... Bagian form modal ... -->

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


</body>

</html>