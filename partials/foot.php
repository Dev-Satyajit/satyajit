<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

<script>
    $("#show-menu").click(function() {
        $("#show-menu").css("display","none");
        $("#hide-menu").css("display","inline-block");
        $(".nav-menu1").css("left","0");
    });
    $("#hide-menu").click(function() {
        $("#hide-menu").css("display","none");
        $("#show-menu").css("display","inline-block");
        $(".nav-menu1").css("left","-100%");
    });
</script>