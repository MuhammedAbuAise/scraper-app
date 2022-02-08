<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scrapper App</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
    <div class="alert" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>
        <div class="container bg-white bg-gradient pb-3" >
            <p class="fs-2 text-center text-white" style="background-color: #5b399b">All scraped data</p>
            <table id="scraper-app" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Point</th>
                    <th>Created_at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $result['title']}}</td>
                    <td><a href="{{ $result['link']}}" class="link-info" target="_blank">Link</a></td>
                    <td class="d-flex">
                        <input type="number" class="form-control point" style="width: 80px" value="{{ $result['point'] }}">
                        <button data-id="{{ $result['id'] }}" disabled type="button" class="btn btn-success btn-sm ms-2">Edit</button>
                    </td>
                    <td>2{{ $result['created']}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Point</th>
                    <th>Created_at</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#scraper-app').DataTable({
                searching: false,
                info:     false,
                lengthChange: false,
            });
        } );

        $('.point').keyup(function () {
            $(this).next().prop('disabled', false);
            $('.point').not(this).next().prop('disabled', true);
        })

        $('html').click(function(e){
            if(!$(e.target).hasClass('point')){
                $('.btn-success').prop('disabled', true);
            }
        });

        $('.btn-success').click(function(){
           _pointValue = $(this).prev().val();
           _id = $(this).attr('data-id');

           $.ajax({
               url: 'update/'+_id,
               type: "PUT",
               dataType: "json",
               data : {"point":_pointValue,"_token": "{{ csrf_token() }}"},
               success: function (data) {
                   $('.alert')
                       .removeClass('alert-success alert-danger')
                       .addClass(data.alert)
                       .text(data.message)
                       .fadeIn(800)
                       .fadeOut(5000)
               }
           })
        });

    </script>

</html>
