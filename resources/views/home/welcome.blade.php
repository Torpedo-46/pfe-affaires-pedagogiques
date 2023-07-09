<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
body{
  background-color: whitesmoke ;
}

/* Pour la résolution "md" */
@media (min-width: 401px) {
  .position-fixed-xs {
    display: flex;
    position:fixed;
  flex-direction:column;
  /*height: calc(100% - 50px);*/ 
  justify-content: start;
 max-width: 250px;
 padding: 1em;
 bottom: 0; 

  }
}
@media (max-width: 400px){/* Appliquer la règle CSS pour sm et plus */
.m-custom {
  margin-left: 0;
    margin-right: 0;  }  
}
@media(max-width: 400px) {
  .position-fixed-bottom {  
    justify-content: center;
    flex-direction:row;
    display: flex;
    position: fixed;
     bottom: 0; 
   width: 100%;
    
  }

}
@media (max-width: 326px){
  .col12 { 
    display: grid;
    word-wrap: break-word;
    max-width: 100%; /* Permet le passage à la ligne automatique des mots longs */
  }
 
}
  @media (min-width: 326px) and (max-width: 400px){
.col4 {
  display: grid;
grid-template-columns:  33.33%  33.33%  33.33%;  

}}
/* :root{
  box-sizing: border-box;

}
*{
  box-sizing: inherit;

} */
 .custom-shadow:hover {
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
}

.custom-flex {   
/*    flex: 0 1 calc((100% - 2rem) / 3);
 */ 
box-sizing: border-box;

   width: calc((100% - 2rem) / 3);
   padding-top: calc((100% - 2rem) / 10);
} 

@media (max-width: 768px){
  .custom-flex{
    width: calc((100% - 2rem) / 2);
    
  }
}
@media (max-width: 576px){
  .custom-flex{
    flex: 1 1 calc((100% - 2rem));
   padding-top: calc((100% - 2rem) / 4);

    max-height:  250px;
    min-height:  100px;
   max-width: 250px ;
  }
}


  .custom-link:hover {
    background-color: #F7FAFC; /* Couleur de fond au survol */
    color: #007bff !important;

  }
 


    </style>

  
</head>
<body> 


<nav id="bartop" class=" px-sm-5 justify-content-start navbar-light bg-white border-bottom fixed-top" >

<a class="d-flex mt-2" href="#" style="text-decoration: none;">
<!-- <div class="container border">
  <div class="row">
    <div class="col-12 col-sm-6">
   -->  <img src="{{ asset('assets/img/fstbm.png') }}" height="40rem" alt="fst" >
  <!--   </div>
    <div class="col-12 col-sm-6">
 -->   <span class="  ms-2 pt-1 pb-0" >    
       <h6 class="text-dark">Platform d'affaires pedagogiques
     <p class="small text-secondary" style="font-style: italic; font-weight: normal;">Faculté des Sciences et Techniques - Beni Mellal</p>
    </h6>
         </span>
    <!--  </div>
  </div>nav-tabs
</div> -->
</a>
  </nav>
 <nav  class="  border-end position-fixed-xs bg-white position-fixed-bottom " >
<div class="col12 col4 ">
 <a class="nav-item nav-link rounded-3 bg-primary d-flex align-items-center mb-3 text-white justify-content-center" href="#">Acceuil </a>

<a class="nav-item nav-link rounded-3 d-flex align-items-center justify-content-center mb-2 text-dark custom-link"  href="#">
<i class="bi bi-box-arrow-in-right"></i>&nbsp;
 gestion de module</a>
   
<a  class="nav-item nav-link rounded-3 d-flex justify-content-center align-items-center mb-2 text-dark custom-link "  href="#">
<i class="bi bi-box-arrow-in-right"></i>&nbsp;  
dashbord</a>
 </div></nav>
  <div id="container">
  
  <div class="bg-white shadow ">
    <div class="p-3 p-sm-4 text-start text-sm-center">
        <h3 class="font-weight-bold ">Modules</h3>
    </div>
    <nav class="px-5 navbar-expand-sm">
  <ul class="navbar-nav  gap-3">
    <li class="nav-item">
      <a class="nav-link py-3 border-bottom d-inline-flex border-2 @if(request()->category == 'sheduled') border-primary text-primary @else text-dark @endif" href="{{ request()->fullUrlWithQuery(['category' => 'sheduled']) }}">Attribué</a>
    </li>
    <li class="nav-item">
      <a class="nav-link py-3  border-bottom border-2 @if(request()->category == 'prog') border-primary text-primary @else border-transparent text-secondary @endif" href="{{ request()->fullUrlWithQuery(['category' => 'prog']) }}">Programmé</a>
    </li>
  </ul>
</nav>

 
</div>
<div class="m-3 ">
<!-- 
    <div class="d-inline-flex align-items-center gap-3  px-3 py-2 rounded-pill bg-white shadow border mb-3" >
     5
</div> -->
 <!-- <div class="row ">
    <div class="col-12 col-sm-6 col-md-4 "> -->

  <div class="d-flex flex-row flex-wrap gap-3 justify-content-around align-items-center text-center justify-content-md-start ">

 <a  class="d-block custom-flex bg-white  rounded-3 border nav-link text-dark shadow custom-shadow" href="#" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');">
      <h5 class="fw-medium small ">Jee</h5>
      <div class="text-xs font-light text-gray-600 ">
        Pr.Mohamed Baslam 
      </div>
    </a>

     <a  class="d-block custom-flex  bg-white  rounded-3 border nav-link text-dark shadow custom-shadow" href="#" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');">
      <h5 class="fw-medium small mb-3">Jee</h5>
      <div class="text-xs  font-light text-gray-600 gap-x-2">
        Pr.Mohamed Baslam 
      </div>
    </a>

    <a  class="d-block custom-flex  bg-white   rounded-3 border nav-link text-dark shadow custom-shadow" href="#" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');">
      <h5 class="fw-medium small mb-3">Jee</h5>
      <div class="text-xs  font-light text-gray-600 gap-x-2">
        Pr.Mohamed Baslam 
      </div>
    </a>

    <a  class="d-block custom-flex  bg-white   rounded-3 border nav-link text-dark shadow custom-shadow" href="#" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');">
      <h5 class="fw-medium small mb-3">Jee</h5>
      <div class="text-xs font-light text-gray-600 gap-x-2">
        Pr.Mohamed Baslam 
      </div>
    </a>

 <a  class="d-block custom-flex bg-white   rounded-3 border nav-link text-dark shadow custom-shadow" href="#" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');">
      <h5 class="fw-medium small mb-3">Jee</h5>
      <div class="text-xs font-light text-gray-600 gap-x-2">
        Pr.Mohamed Baslam 
      </div>
    </a>

 <!--  </div>
  <div class="col-12 col-sm-6 mb-3">
   --> 
   
   
<!--   </div>-->
 </div>


<!-- <div class="container-fluid">
<div class="row">
<a class="d-inline-block col-12 col-sm-6 bg-white py-3 rounded-3  border mb-3 nav-link text-dark"  href="#" class="shadow custom-shadow" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');" >
                    <h5 class="fw-medium small mb-3">Jee</h5>
                    <div class="text-xs d-flex align-items-center font-light text-gray-600 gap-x-2">
                         Pr.Mohamed Baslam
                     </div>
                  
</a>
<a class="d-inline-block col-12 col-sm-6 bg-white py-3 rounded-3  border mb-3 nav-link text-dark" href="#" class="shadow custom-shadow" onmouseover="this.classList.add('custom-shadow');" onmouseout="this.classList.remove('custom-shadow');" >
                    <h5 class="fw-medium small mb-3">reseau</h5>
                    <div class="text-xs d-flex align-items-center font-light text-gray-600 gap-x-2">
                         Pr.Mohamed Baslam
                     </div>
                  
</a>
</div>
</div> -->
  </div>
  <script>
// Sélectionnez tous les éléments avec la classe .custom-flex
var customFlexElements = document.querySelectorAll('.custom-flex');

// Fonction de rappel pour l'observation des changements de taille
var resizeObserver = new ResizeObserver(function(entries) {
  entries.forEach(function(entry) {
    var largeur = entry.contentRect.width;
    entry.target.style.height = largeur + 'px';
  });
});

// Parcourez tous les éléments et observez les changements de taille
customFlexElements.forEach(function(element) {
  resizeObserver.observe(element);
});


</script>


<script>
    function adjustMarginLeft() {
    var navbar = document.querySelector('.position-fixed-xs');
    var container = document.getElementById('container');
    var bartop = document.getElementById('bartop');
    container.style.marginTop = bartop.offsetHeight + 'px';
    if (window.innerWidth > 400) {
      container.style.marginLeft = navbar.offsetWidth + 'px';
      navbar.style.height = 'calc(100% - ' + bartop.offsetHeight + 'px)';
        } else {
      container.style.marginLeft = '0';
      navbar.style.height = 'auto';
    }
  }

  window.addEventListener('load', adjustMarginLeft);
  window.addEventListener('resize', adjustMarginLeft);

  
  </script>



<!-- <nav class="navbar nav-tabs navbar-light bg-light ">
 -->
 <!--    
 <a href="#" class="navbar-brand ">
<img src="{{ asset('assets/img/fstbm2.png') }}" width="50px" alt="fst">
 </a>  -->

<!--  <nav class="navbar navbar-light bg-white border-bottom fixed-top">
  <div class="container-fluid px-5 py-2.5">
    <div class="d-flex align-items-center justify-content-between">
    <img src="{{ asset('assets/img/fstbm.png') }}" width="50px" alt="fst" class="img-fluid img-thumbnail">
    </div>
  </div>
 </nav> -->
<!--  <div class="container-fluid">
  <div class="row ">
    <div class="col-12  ">
        <nav class="navbar position-fixed d-flex justify-content-center align-items-end fixed-bottom nav-tabs position-fixed-xs  border-end p-4 bg-white bottom-0 mt-5" style="height: calc(100% - 52px); ">
<nav class="nav-tabs border-end border-top shadow d-flex position-fixed-bottom align-items-center position-fixed-xs bg-white p-4 bottom-0 mt-5">

    <nav class="navbar justify-content-start  nav-tabs position-fixed-xs position-fixed-bottom border-end p-4 bg-white bottom-0 mt-5" style="height: calc(100% - 52px); ">
 <nav class="border-top nav-tabs  shadow d-flex align-items-center bg-white position-fixed-bottom position-fixed-xs">

-->


<!-- 
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
              <img style="height: 30px" class="custom-height" src="{{ asset('assets/img/fstbm.png') }}" alt="Faculté des Sciences et Techniques - Beni Mellal">
                 <span class="navbar-text">  Platform d'affaires pedagogiques  </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                 <!-- Left Side Of Navbar -->
              <!--   <ul class="navbar-nav me-auto">

                  </ul>-->
                  <!-- Right Side Of Navbar -->
               <!--   <ul class="navbar-nav ms-auto">

                 <a class="nav-item nav-link  " href="#">Acceuil</a>
                <a class="nav-item nav-link" href="#"> home</a>
                <a class="nav-item nav-link" href="#">dashbord</a>
                 
              </ul>

                </div>
            </div>
</nav>

 -->















<!--  <header class="navbar  px-3">
 <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-content">
<span class="navbar-toggler-icon"></span>
</button>
<nav class="collapse navbar-collapse" id="navbar-content">

<ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
      </ul>
 </nav>
</header> -->
 

 
 









<!-- <div class="container-fluid overflow-hidden">
<div class="row gy-3">
    <div class="col-12  col-sm-6 col-md-8 border">-->
   <!--  <div class="row">
        <div class="col-12  col-md-4 border d-none d-md-block"> -->
          <!--   <div class="float-md-start">
    <img src="{{ asset('assets/img/fstbm.png') }}" width="500px" alt="fst" class="img-fluid img-thumbnail">
        </div> -->
        <!-- <div class="col-12  col-md-8 border">
      -->     
    <!--  <p>  
        ggggg ffffffffffff  fffffffffff ffffffffffff ffffffffffff 
            fffffffff ffffffffffff ffffffffffff fffffffffff ffffffffff 
            ffffffffffff ffffffffff fffffffff fffffffff ffffffffff</p>

</div>
    </div> -->
  <!--   <div class="row">
        <div class="col-12  col-md-4 border d-none d-md-block">
    <img src="{{ asset('assets/img/fstbm2.png') }}" width="500px" alt="fst" class="img-fluid">
        </div>
        <div class="col-12  col-md-8 border">
            
        ggggg ffffffffffff  fffffffffff ffffffffffff ffffffffffff 
            fffffffff ffffffffffff ffffffffffff fffffffffff ffffffffff 
            ffffffffffff ffffffffff fffffffff fffffffff ffffffffff
</div>
    </div>  -->
   <!--  </div>
    <div class="col-12  col-sm-6 col-md-4 border">
        <p>ffffff ffffffffffff  fffffffffff ffffffffffff ffffffffffff 
            fffffffff ffffffffffff ffffffffffff fffffffffff ffffffffff 
            ffffffffffff ffffffffff fffffffff fffffffff ffffffffff 
        </p>
    </div> -->
   






















<!-- <div class="d-flex flex-column align-items-center justify-content-center gap-4" style="min-height: 100vh;">
    <img src="{{ asset('assets/img/fstbm.png') }}" alt="FSTBM" class="mb-4" style="max-width: 200px;">
    <div class="text-center">
    <h1 class="fw-italic text-primary fs-4 mb-2">Bienvenue à la plateforme de gestion d'affaires pédagogiques</h1>
        <p class="text-secondary">La plateforme de la Faculté des Sciences et Techniques - Beni Mellal pour partager les supports de cours avec les étudiants</p>
    </div>
    <p>Connectez-vous à notre plateforme</p>
    <div class="d-flex flex-wrap gap-3">
        <a class="btn btn-primary" href="{{ route('login') }}">Se connecter à votre compte</a>
        <span>ou</span>
        <a class="btn btn-secondary" href="{{ route('signup') }}">Créer un compte</a>
    </div>
</div> -->


</body>
