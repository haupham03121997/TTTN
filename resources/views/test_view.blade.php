<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <title>Document</title>
</head>

<body>
 <form>
  text <input type="text" id="abc"  >
  noidung <input type="text" id="noidung" name="tieude" value="">
   <button id="nut" type="button" name="submit"></button>
 </form>
 <script>
   $('#nut').click(function(){
     var data={text:$('#abc').val(),_token:'{{csrf_token()}}'};
    $.post('{{ URL::to('/form_1') }}',data).done(function (d) {
      $('#noidung').val(d);
    });
   });
 </script>
</body>
</html>
