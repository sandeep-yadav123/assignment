<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Assignment</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
  <!-- Custom styles for this template -->
  <style type="text/css">
    body {
      padding-top: 56px;
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <!-- Heading Row -->
    <div class="row align-items-center my-3">
      <div class="col-lg-10 offset-lg-2">
        <h1 class="font-weight-light mb-4">Itms Management Page</h1>
         <div class="row justify-content-start">
            <div class="col-4">
              <input class="form-control" id="assignment" type="text" placeholder="Enter item Name and click add">
              <div id="msg"></div>
            </div>
            <div class="col-2">
              <button type="button" id="add" class="btn btn-secondary">Add</button>
            </div>
            <div class="col-6">
             <h2 class="font-weight-bold mb-5">Selected Items:</h2>
            </div>
          </div>
      </div>
    </div>
    <!-- Content Row -->
    <div class="row">
      <div class="col-lg-10 offset-lg-2 mb-5 ">
          <div class="row justify-content-start">
            <div class="col-4">
              <div class="card h-100">
                <div class="card-body items">
                  <select class="custom-select right" size="5">
                    @foreach($items as $item)
                      <option value="{{$item->assignment}}">{{$item->assignment}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-2 justify-content-center">
              <div class="btn-group-vertical">
                  <button type="button" id="right" class="btn btn-light">></button>
                  <button type="button" id="left" class="btn btn-light"><</button>
              </div>
            </div>

            <div class="col-4">
              <div class="card h-100">
                <div class="card-body selected_items">
                  <select class="custom-select left" size="5">
                    @foreach($selectedItems as $selectedItem)
                      <option value="{{$selectedItem->selected}}">{{$selectedItem->selected}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
        <div class="row bg-light">
            <div class="col-lg-10 offset-lg-2">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">About Us</a>
                </li>
              </ul>
            </div>
        </div>
    </div>
    <!-- /.container -->
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript">
     $(document).ready(function() {
        $('#add').on('click', function()
        {
            var assignment = $('#assignment').val();
            if(assignment != null && assignment != "")
            {
            $('.right').prepend("<option>"+assignment+"</option>");

            $.ajaxSetup({
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              type: "POST",
              url: "{{ URL::route('save.assignment')}}",
              data: {assignment:assignment},
              success: function(res)
              {
                if(res.status == true)
                {
                  $('#assignment').val('');
                  $('#msg').html('<span style="color:green;">'+res.msg+'</span>');
                }
              }
            });
          }else{
            alert('Please enter item name!');
          }
        });
        //right selected
        $('#right').on('click', function()
        {
            var right_items = $('.right').val();
            if(right_items != null && right_items != "")
            {
              $('.left').prepend("<option value='"+right_items+"'>"+right_items+"</option>");
              $(".right option[value='"+right_items+"']").remove();

              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $.ajax({
                type: "POST",
                url: "{{ URL::route('right.selected')}}",
                data: {items:right_items},
                success: function(res)
                {
                  if(res.status == true)
                  {
                    $('#assignment').val('');
                    $('#msg').html('<span style="color:green;">'+res.msg+'</span>');
                  }
                }
              });
            }else{
              alert('Please item select!');
            }
        });

        //left selectd
        $('#left').on('click', function()
        {
            var left_items = $('.left').val();
            if(left_items != null && left_items != "")
            {
              $('.right').prepend("<option value='"+left_items+"'>"+left_items+"</option>");
              $(".left option[value='"+left_items+"']").remove();

            $.ajaxSetup({
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              type: "POST",
              url: "{{ URL::route('left.selected')}}",
              data: {items:left_items},
              success: function(res)
              {
                if(res.status == true)
                {
                  $('#assignment').val('');
                  $('#msg').html('<span style="color:green;">'+res.msg+'</span>');
                }
              }
            });
          }else{
            alert('Please item select!');
          }
        });

     });
  </script>
</body>
</html>
