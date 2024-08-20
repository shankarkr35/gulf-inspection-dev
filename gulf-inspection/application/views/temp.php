<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .imag-sec{
        text-align:center;
        margin: 0 auto;
        padding-top: 30px;
    }
    img.logo-1 {
    height: 110px;
}
    
img.img-fld {
    width: 429px;
}
img.img-fluid {
    width: 236px!important;
}
.row-1 {
    padding-top:80px;
    text-align: center;
    display: flex;
    justify-content: space-evenly;
}
@media only screen and (max-width: 600px) {
    img.img-fluid {
    width: 143px!important;
}
}
    </style>
</head>
<body>
    <div class="container">
        <div class="imag-sec"> 
            <a class="navbar-brand" href="#" target="_blank"><img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" class="logo-1" alt=""></a>	
        </div>
        <div class="row-1">
       <!-- <div class="col-lg-6">
           </div>
           <div class="col-lg-6">
           </div> -->
           <a href="#">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJzrpElWS7uUgJgShQT9LHJAG_aLjWT0VMrbFV_P4bvWyL0Ei62iznRMiqo8WfpPoJc3M&usqp=CAU" class="img-fluid">
            </a>
        <!-- <img src="https://blog.lastpass.com/wp-content/uploads/sites/20/2020/04/available-on-the-app-store-1345130940-2.jpg" class="img-fld"> -->
        <a href="#"><img src="https://www.bachpartymatch.com/images/icons/app-store-badge-google-play.png" class="img-fld img-fluid"></a>
        </div>
    </div>
   
</body>
</html>