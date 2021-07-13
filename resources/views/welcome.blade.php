<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <title>Laravel Ajax Crud</title>
    <style>
        .mr-2{
            margin-right:5px !important;
        }
    </style>
  </head>
  <body>
    <div class="container mt-5">
    <div class="card">
  <div class="card-header bg-danger">
  
  <marquee  direction="left" style="">
  <h2 class="text-white"><i class="fas fa-american-sign-language-interpreting"></i> Laravel Ajax Crud <i class="fas fa-american-sign-language-interpreting"></i></h2>
</marquee>
  </div>
  <div class="card-body">
  <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-title bg-primary">
                        <h3 class="text-center">Teacher List</h3>
                    </div>
                    
                    <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Institute</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card">
                    <div class="card-title bg-primary pt-1 pb-1 text-center">
                        <span id="addT"  class="text-center " style="font-size:22px ; font-weight:bold">Add Teacher</span>
                        <span id="updateT" class="text-center " style="font-size:22px ; font-weight:bold">Update Teacher</span>
                    </div>
                    
                    <div class="card-body">
                    <div class="form-group">
                        <label for=""> Name</label>
                        <input  id="name" type="text" class="form-control mt-2 mb-2" Placeholder="Enter Your Name">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group">
                        <label for=""> Title</label>
                        <input  id="title" type="text" class="form-control mt-2 mb-2" placeholder="Enter Your Tittle">
                        <span class="text-danger" id="titleError"></span>
                    </div>
                    <div class="form-group">
                        <label for=""> Institute</label>
                        <input id="institute" type="text" class="form-control mt-2 mb-2" placeholder="Enter Your Institute">
                        <span class="text-danger" id="instituteError"></span>
                    </div>
                    <input type="hidden" id="id">
                    <br>
                    <button id="addButton" onclick="addData()" class="btn btn-success btn-sm">Add Teacher</button>
                    <button id="updateButton" onclick="updateData()" class="btn btn-success">Update Teacher</button>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
    -->


    <script>
        $('#addButton').show();
        $('#updateButton').hide();
        $('#addT').show();
        $('#updateT').hide();


        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })


        function allData(){
            $.ajax({
                    url: "/teacher/all",
                    type: "get",
                    dataType: "json",
                    success: function(response) {
                        var data = ""
                        $.each(response, function(key, value){
                            data = data + "<tr>"
                            data = data + "<td>"+key+"</td>"
                            data = data + "<td>"+value.name+"</td>"
                            data = data + "<td>"+value.title+"</td>"
                            data = data + "<td>"+value.institute+"</td>"
                            data = data+ "<td>"
                            data = data+ "<button class='btn btn-primary btn-sm mr-2' onclick='editData("+value.id+")'><i class='fa fa-edit'></i></button>"
                            data = data+ "<button class='btn btn-danger btn-sm' onclick='deleteData("+value.id+")'><i class='fa fa-trash'></i></button>"
                            data = data+ "</td>"
                            data = data + "</tr>"
                        })
                        $('tbody').html(data);
                    }
            });
        }

        
        allData();


        function clearData(){
            $('#name').val('');
             $('#title').val('');
            $('#institute').val('');
            $('#nameError').text('');
            $('#titleError').text('');
            $('#instituteError').text('');
        }

        function addData(){
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();

            $.ajax({
                    url: "/teacher/store/",
                    type: "post",
                    dataType: "json",
                    data: {name:name, title:title, institute:institute},
                    success: function(data) {
                        allData();
                        clearData();

                        const Msg = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Added Succesfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        Msg.fire({
                        
                        type: 'success',
                        title: 'Data Added Succesfully!',
                        })

                        console.log('Successfully Data Added');
                        
                },

                error:function(error){
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.title);
                    $('#instituteError').text(error.responseJSON.errors.institute);
                    
                }
            });
            
        }



        function editData(id){

            $.ajax({
                    url: "/teacher/edit/"+id,
                    type: "get",
                    dataType: "json",
                    success: function(data) {
                        $('#addButton').hide();
                        $('#updateButton').show();
                        $('#addT').hide();
                        $('#updateT').show();

                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#title').val(data.title);
                        $('#institute').val(data.institute);
                        
                        
                    }
            });
        }

        function deleteData(id){
            swal({
            title: 'Are you sure to Delete?',
            text: "Once Deleted! You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                url: "/teacher/destroy/"+id,
                type: "get",
                dataType: "json",
                success: function(data) {
                    $('#addButton').show();
                    $('#updateButton').hide();
                    $('#addT').show();
                    $('#updateT').hide();

                    clearData();
                    allData();
                    const Msg = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data deleted Succesfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        Msg.fire({
                        
                        type: 'success',
                        title: 'Data deleted Succesfully!',
                        })
                    console.log('Data deleted');
                    
                    
                }
        });
                }else{
                        swal('Canceled');
                    }
            })

        
        }



        function updateData(){
            var id = $('#id').val();
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();

            $.ajax({
                    url: "/teacher/update/"+id,
                    type: "post",
                    dataType: "json",
                    data: {name:name, title:title, institute:institute},
                    success: function(data) {
                        $('#addButton').show();
        $('#updateButton').hide();
        $('#addT').show();
        $('#updateT').hide();
                        allData();
                        clearData();
                        const Msg = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Updated Succesfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        Msg.fire({
                        
                        type: 'success',
                        title: 'Data Updated Succesfully!',
                        })
                        console.log('Data Updated Successfully');
                        
                        
                    },

                    error:function(error){
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.title);
                    $('#instituteError').text(error.responseJSON.errors.institute);
                    
                }
            });
        }

    </script>
  </body>
</html>