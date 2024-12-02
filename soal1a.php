<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tampilan no 1</title>
    <style>
        html, body {
            
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 10px;
        }
    </style>
</head>
<body>
    <section class="p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label for="">Inputkan Jumlah Baris</label>
                                </div>
                                <div class="col-7">
                                    <input type="number" name="jumlah_baris" id="jumlah_baris" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5">
                                    <label for="">Inputkan Jumlah Kolom</label>
                                </div>
                                <div class="col-7">
                                    <input type="number" name="jumlah_column" id="jumlah_column" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align:center">
                                    <button class="btn btn-primary" onclick="setColumnBaris()">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Hasil Create Column dan Baris</h6>
                            <div class="" style="overflow-x: auto;overflow-y: auto; max-height: 200px">
                                <div class="row" id="tampil-data">

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12" style="text-align:center">
                                    <button class="btn btn-primary" onclick="setDetails()">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Hasil Inputan setiap Column dan Baris</h6>
                            <div class="" style="overflow-x: auto;overflow-y: auto; max-height: 200px">
                                <div class="row" id="tampil-data-detail">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function setColumnBaris() {
            var jumlah_baris = $('#jumlah_baris').val();
            var jumlah_column = $('#jumlah_column').val();
            var tampilData = $('#tampil-data');
            var tampilDetail = $('#tampil-data-detail');
            
            tampilData.empty();
            tampilDetail.empty();

            for (var i = 0; i < jumlah_baris; i++) {
                var row = $('<div class="row mb-3"></div>'); 

                for (var j = 0; j < jumlah_column; j++) {
                    var col = $('<div class="col border p-3">');  

                    var flexContainer = $('<div class="d-flex align-items-center">');

                    var label = $('<label class="mr-2" style="width: 100px;">' + (i + 1) + '.' + (j + 1) + '</label>');
                    var input = $('<input type="text" class="form-control" name="inputcolumnbaris" data-baris="'+ i +'" data-column="'+ j +'">');  // Menambahkan atribut data untuk baris dan kolom

                    flexContainer.append(label);
                    flexContainer.append(input);

                    col.append(flexContainer);

                    row.append(col);
                }
                tampilData.append(row);
            }
        }

        function setDetails() {
            var tampilDetail = $('#tampil-data-detail');
            tampilDetail.empty(); 

            $('input[name="inputcolumnbaris"]').each(function() {
                var inputVal = $(this).val(); 
                var baris = $(this).data('baris');
                var column = $(this).data('column');  
                if(inputVal) {  
                    var hasil = (baris + 1) + '.' + (column + 1) + '. ' + inputVal;
                    var resultItem = $('<div class="col-12 mb-2">').text(hasil);
                    tampilDetail.append(resultItem);
                }
            });
        }

    </script>

</body>
</html>