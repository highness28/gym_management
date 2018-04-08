<html>
  <head>
    <style>
      html {
        background-image: url("{{ asset('dist/img/error/403.png')  }}");
        background-size: 100% 100%;
      }
      
      #error-message {
        position:absolute;
        width:500px;
        height:100px;
        bottom:0px;
        right:25%;
        left:50%;
        margin-left:-100px;
      }
    </style>
  </head>

  <div>
    <div id="error-message">
      <span>You will be redirected in... </span>
      <span id="timer">5</span>
    </div>
  </div>

  <script>
    var time = 4;
    setInterval(myTimer, 1000);

    function myTimer() {
      document.getElementById('timer').innerHTML = time;
      if(time == 0) {
        window.location.assign('/');
      }
      time--;
    }
  </script>
</html>