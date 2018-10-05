<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../tittle.php"); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include(__DIR__ . "/../sidebar.php"); ?>
      <?php include(__DIR__ . "/../top_nav.php"); ?>

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>
                  <a href="<?=base_url()?>">
                    <i class="fa fa-home"></i>
                  </a>
                  <a href="<?=base_url()?>hasil">
                    Data Peserta
                  </a>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                   <a id="url" href="pdffix/hasil_nilai_all.php"><button type="button" id="btn-cetak" class="btn btn-primary">Cetak</button></a>
                  </li>
                </ul>
                <br><br>
                <br>
                <div class="row">
                  <form class="pull-left" style="padding-left: 10px;" action="">
                    <input type="radio" id="umum" name="filter"> Umum<br>
                    <input type="radio" id="mahasiswa" name="filter"> Mahasiswa<br>
                  </form>
                   <div class="form-group pull-right" id="sub-filter">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select</label>
                        <div cx class="col-md-9 col-sm-9 col-xs-12" >
                          <select  class="form-control" id="select-subfilter">
                          </select>
                        </div>
                   </div>
                   <div class="form-group pull-right" id="filter">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select  class="form-control" id="select-filter">
                            <option value="">Pilih</option>
                            <option value="jurusan">Jurusan</option>
                            <option value="program_studi">Program Studi</option>
                          </select>
                        </div>
                   </div>
                  
                </div>
                  
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="tabel-data" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama Peserta</th>
                      <th>NIM</th>
                      <th>Kelas</th>
                      <th>Program Studi</th>
                      <th>Jurusan</th>
                      <th>Nama Institusi</th>
                      <th>Kategori</th>
                      <th>Tanggal Tes</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tabel-body">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
        Modern Electronic Semarang
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>
  <?php include(__DIR__ . "/../load_js.php"); ?>

  <script>
    var tabel = '';
    $(document).ready(function(){
     tabel = $('#tabel-data').dataTable({
        "bProcessing":  true,
        "bAutoWidth":   true,
        "bSort":    false,
        "destroy": true,
        "sAjaxSource":  '<?php echo base_url(); ?>hasil/data',
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
                  { "mData" : "nama"},
                  { "mData" : "nim"},
                  { "mData" : "kelas"},
                  { "mData" : "prodi"},
                  { "mData" : "jurusan"},
                  { "mData" : "institusi"},
                  { "mData" : "kategori"},
                  { "mData" : "tgl_tes"},
                  { "mData" : "action"}
                ],
        "columnDefs":   [
                  { className: "text-center", "targets": [0,10] },
                  { width: 30, targets: 0},
                  { width: 50, targets: 10}
                ],
        "fixedColumns": true
      });

    $("#filter").hide();
    $("#sub-filter").hide();

    $("#umum").click(function(){
      getData('umum');
      $("#filter").hide();
      $("#sub-filter").hide();
      $('#url').attr('href', "pdffix/hasil_nilai.php?id=umum");

    });

    $("#mahasiswa").click(function(){
      getData('mahasiswa');
      $("#filter").show();
      $("#sub-filter").show();
      $('#url').attr('href', "pdffix/hasil_nilai.php?id=mahasiswa");
    });

    $("#select-filter").change(function(){
      if ($(this).val() == 'jurusan') {

       getSub('getJurusan');

      }else {
        getSub('getProdi');
        
      }
    })

    $("#select-subfilter").change(function(){
        getData($(this).val());
        console.log($(this).val());

    })

    function getSub(filter){
    $('#select-subfilter').empty();
     $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>hasil/" + filter,
            success: function(data){
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                if (filter == 'getJurusan') {
                  $('#select-subfilter').append('<option value="cariJurusan/">Pilih</option>');
                  $.each(opts, function(i, d) {
                    $('#select-subfilter').append('<option value="cariJurusan/' + d.id_jurusan + '">' + d.nama + '</option>');
                });
                } else {
                  $('#select-subfilter').append('<option value="cariProdi/">Pilih</option>');
                  $.each(opts, function(i, d) {
                    $('#select-subfilter').append('<option value="cariProdi/' + d.id_prodi + '">' + d.nama + '</option>');
                });
                }
                
            }
        }); 
    }

    function getData(data){

        tabel = $('#tabel-data').dataTable({
        "bProcessing":  true,
        "bAutoWidth":   true,
        "destroy": true,
        "bSort":    false,
        "sAjaxSource":  '<?php echo base_url(); ?>hasil/' + data,
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
                  { "mData" : "nama"},
                  { "mData" : "nim"},
                  { "mData" : "kelas"},
                  { "mData" : "prodi"},
                  { "mData" : "jurusan"},
                  { "mData" : "institusi"},
                  { "mData" : "kategori"},
                  { "mData" : "tgl_tes"},
                  { "mData" : "action"}
                ],
        "columnDefs":   [
                  { className: "text-center", "targets": [0,10] },
                  { width: 30, targets: 0},
                  { width: 50, targets: 10}
                ],
        "fixedColumns": true
      });
      }
    });

    $("#btn-cetak").click(function(){
      

    });


  </script>
</body>
</html>