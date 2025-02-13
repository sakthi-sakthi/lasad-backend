<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="{{asset('admin')}}/img/delasalle.png" type="image/x-icon" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Welcome to De La Salle Brothers | @yield('title','Has Panel')</title>
    @include('admin.layouts.header')
    @yield('header')

</head>
<body class="hold-transition sidebar-mini" style="color: #525558 !important">
<div class="wrapper">

  <!-- Navbar -->
    @include('admin.layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('admin.layouts.menu')

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
    @include('admin.layouts.sidebar')
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    @include('admin.layouts.footer')
    @section('scriptsdata')
    <!-- Your page-specific script here -->
    <script>
      var uploadedDocumentMap = {};
  
      // Generate the secure URL using secure_url function
      var secureUrl = "{{ secure_url(route('admin.media.storeMedia')) }}";
  
      // Configure Dropzone with the secure URL
      Dropzone.options.documentDropzone = {
          url: secureUrl,
          maxFilesize: 50, // MB
          addRemoveLinks: true,
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          success: function (file, response) {
              var error = response.error;
              var filesize = response.filesize;
              if (error) {
                  $("#error-container").html('<div id="error-message" style="color: red;font-weight:700;">' + error + '</div>');
                  $("#error-message").show();
                  file.previewElement.remove();
              } else if (filesize >= 2) {
                  $("#error-container").html('<div id="error-message" style="color: red;font-weight:700;"> Please reduce your file size before you upload it...! </div>');
                  $("#error-message").show();
                  file.previewElement.remove();
              } else {
                  $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                  uploadedDocumentMap[file.name] = response.name;
              }
              setTimeout(function () {
                  $("#error-message").hide();
              }, 10000);
          },
          removedfile: function (file) {
              file.previewElement.remove();
              var name = '';
              if (typeof file.file_name !== 'undefined') {
                  name = file.file_name;
              } else {
                  name = uploadedDocumentMap[file.name];
              }
              $('form').find('input[name="document[]"][value="' + name + '"]').remove();
          },
      };
   
      $(document).ready(function() {
          $('#submit').click(function(event) {
              event.preventDefault(); // Prevent default form submission
              
              var formData = new FormData($('#media-form')[0]); // Serialize form data
              
              $.ajax({
                  url: $('#media-form').attr('action'), // URL to submit the form to
                  type: 'POST',
                  data: formData, // Form data
                  processData: false, // Don't process the data
                  contentType: false, // Don't set contentType
                  success: function(response) {
                      if (Array.isArray(response)) {
          // Empty the .allmedia container
          $('.allmedia').empty();
  
          // Append each media item to the .allmedia container
          response.forEach(function(media) {
              var mediaHtml = '<div class="thumbnail">' +
                                  '<a href="javascript:void(0);">' +
                                      '<img id="' + media.id + '" src="' + media.thumbUrl + '" data-url="' + media.url + '" alt="' + media.alt + '" data-title="' + media.name + '">' +
                                  '</a>' +
                              '</div>';
              $('.allmedia').append(mediaHtml);
          });
      } else {
          console.error("Response medias is not an array:", response);
      }
                      $(".allmedia").css("display", "block");
                      $(".add-medias").css("display", "none");
                      var myDropzone = Dropzone.forElement("#document-dropzone");
                      if(myDropzone) {
                          myDropzone.removeAllFiles();
                      }
                  },
                  error: function(xhr, status, error) {
                      // Handle error response
                      console.error(error);
                  }
              });
          });
      });
  
  
  </script>
@endsection

    @yield('script')
</body>
</html>
