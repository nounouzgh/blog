<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>default {{ config('app.name') }}</title>
    <!-- #css  this page -->
     <link rel="stylesheet" href="assets/css/dasboardestyle.css">
     <link rel="stylesheet" href="assets/css/MultiPlatforme.css">
     <link rel="stylesheet" href="assets/css/NaveBaresytle.css">
     <!-- #materials icons -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
     <!--  nave bare incu -->

   

</head>
<body>

   
    <!-- page contener -->
    <div class="container">
        <!-- aside tage -->
        <!-- end of Aside menu left menu-->
    
        <aside>
        <nav>

           
            
                <!-- this one is for left menu  logo-->  
               <div class="top">
                  <div class="logo">
                      <!-- #logo image-->
                      <img src="logo/logo.png">
                      <!-- spam for deferent color name menu -->
                      <h2>Educ<span class="danger">ation</span></h2>
                  </div>
        <!--div x code  below image logo-->
        <div class="close" id="close-btn">
            <!-- #image icon  x-->
            <span class="material-symbols-outlined">
                close
                </span>
         </div>
               </div>
               
             
                 <!-- munue left bare-->
               <div class="sidebare">
      
                  <!-- u can add menu u want in main menu  a balise-->
                  <a href="http://">
                      <!--image icon care for menu-->
                      <span class="material-symbols-outlined">grid_view</span>
                      <!--name icon care for menu-->
                      <h3>Dashoard</h3>
                  </a>
      
                  <a href="http://" class="active">
                      <!--image icon care for person-->
                      <span class="material-symbols-outlined">person</span>
                      <!--name icon care for menu-->
                      <h3>costumer</h3>
      
                  </a>
      
                  <a href="http://">
                      <!--image icon care for menu-->
                      <span class="material-symbols-outlined">Gavel</span>
                      <!--name icon care for menu-->
                      <h3>course</h3>
      
                  </a>
      
                  <a href="http://">
                      <!--image icon care for menu-->
                      <span class="material-symbols-outlined">mail_outline</span>
                      <!--name icon care for menu-->
                      <h3>mesage</h3>
                      <!--nber count-->
                      <span class="mesage-count">26</span>    
                  </a>
      
                  <a href="http://">
                      <!--image icon care for menu-->
                      <span class="material-symbols-outlined">logout</span>
                      <!--name icon care for menu-->
                      <h3>logout</h3>
                  </a>
               </div>
      
              

        </nav>
    </aside>




        <!-- end of Aside menu-->
        <main>
            <h1>Dashoard</h1>

            <!-- this one is just for data is will be in top-->
            <div class="data">
                <input type="date">
            </div>

            <!--  will be like 30 % from or 40 % from main div for put nmber from dive class -->
           <!-- =================debut  insights=================-->
            <div class="insights">
                <!-- her will be where u put  small dive close to eatch other 1/2 main div-->

                <!--debut sell -->
                <div class="sales">
                 <!-- this class have 2 positiontop one and down one-->
                   <!-- her icon will be top  and we mouve icon left in css -->
                    <span class="material-symbols-outlined"> analytics </span>
                    <div class="middle">
                        <!--  will be main cader for 1 sell  we  will have left  + progress -->
                        <div class="left">
                            <h3>total sell</h3>
                            <h1>$25.024</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'>
                                </circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>

                    </div>
                    <small class="text-muted"> last 24 Hours </small>
                </div>
            <!-- end of sells-->

            <!--debut Expences -->
            <div class="expences">
                <!-- this class have 2 positiontop one and down one-->
                  <!-- her icon will be top  and we mouve icon left in css -->
                   <span class="material-symbols-outlined"> analytics </span>
                   <div class="middle">
                       <!--  will be main cader for 1 sell  we  will have left  + progress -->
                       <div class="left">
                           <h3>total expences</h3>
                           <h1>$250.024</h1>
                       </div>
                       <div class="progress">
                           <svg>
                               <circle cx='38' cy='38' r='36'>
                               </circle>
                           </svg>
                           <div class="number">
                               <p>61%</p>
                           </div>
                       </div>

                   </div>
                   <small class="text-muted"> last 24 Hours </small>
               </div>
           <!-- end of Expences-->
   <!--debut income -->
   <div class="income">
    <!-- this class have 2 positiontop one and down one-->
      <!-- her icon will be top  and we mouve icon left in css -->
       <span class="material-symbols-outlined"> analytics </span>
       <div class="middle">
           <!--  will be main cader for 1 sell  we  will have left  + progress -->
           <div class="left">
               <h3>total income</h3>
               <h1>$600.024</h1>
           </div>
           <div class="progress">
               <svg>
                   <circle cx='38' cy='38' r='36'>
                   </circle>
               </svg>
               <div class="number">
                   <p>31%</p>
               </div>
           </div>

       </div>
       <small class="text-muted"> last 24 Hours </small>
   </div>
    <!--end income -->
                
    </div>
     
        <!-- =================end class insights=================-->
        <!-- =================Bebut Resent ORDER=================-->
        <div class="recent-order">

            <h2>Recent Order</h2>
            <table>
                  <thead>
                    <!--header of table-->
                    <tr>
                        <th>Produit Name</th>
                        <th>Produit Number</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                
                    <tbody>
                        <!-- her u will put ur info product-->
                        <tr>
                            <td>Foldale Mini Drone</td>
                            <td>85631</td>
                            <td>due</td>
                            <td class="warning">Panding</td> <!--for put red colore-->
                            <td class="primary">Detais</td>
                        </tr>
                    
                        <tr>
                            <td>Foldale Mini Drone</td>
                            <td>85631</td>
                            <td>due</td>
                            <td class="warning">Panding</td> <!--for put red colore-->
                            <td class="primary">Detais</td>
                        </tr>
                        <tr>
                            <td>Foldale Mini Drone</td>
                            <td>85631</td>
                            <td>due</td>
                            <td class="warning">Panding</td> <!--for put red colore-->
                            <td class="primary">Detais</td>
                        </tr>
                        <tr>
                            <td>Foldale Mini Drone</td>
                            <td>85631</td>
                            <td>due</td>
                            <td class="warning">Panding</td> <!--for put red colore-->
                            <td class="primary">Detais</td>
                        </tr>
                    </tbody>
            </table>
            <a href=""> how all</a>
        </div>
       <!-- =================end  Resent ORDER=================-->
        </main>
        <!-- =======================end main==================--->
        
         <!-- ===================Debut Right SIDE==================--->
           <div class="right">

            <!--bebut top-->
                <div class="top">
                    <!--menu buton-->
                    

                     <button id="menu-btn">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <!-- icon for mode darck and light -->
                    <div class="theme-toggler">
                        <span class="material-symbols-outlined active">light_mode</span>
                        <span class="material-symbols-outlined">dark_mode</span>
                    
            
                    </div>
                    <!-- Profile-->
                    <div class="profile">
                        <!-- text next to profile icone -->
                        <div class="info"><p>Hey , </p> <b>Daniel</b>
                            <small class="text-muted">Admine</small>
                        </div>
                       
                        <!--profile photo-->
                        <div class="profile-photo">
                            <img src="assets/images/profile-1.png" alt="Click to Open Menu" id="menuImage" >
                        </div>
                        <div class="action" id="action">                            
                         
                                @include('layouts.navigation')                          

                        </div>
                    </div>
                    <!-- end Profile-->
                </div>
            <!--end top-->

            <!--recent update-->
            <!-- main bordure titel + main produre update for info-->
            <div class="recent-updates">
                
            
                <h2> Recent Update</h2>
                <div class="updates">

                    <div class="update">
                        <!--profile photo-->
                        <div class="profile-photo">
                            <img src="assets/images/profile-1.png">
        
                        </div>
                        <!-- mesage -->
                        <div class ="message">
        
                            <p><b> Mike Tyzon </b>recive order of night lech GPS drone </p>
                            <small class="text-muted"> 2 minutes ago</small>
                        </div>
        
                    </div>
        
                    <div class="update">
                        <!--profile photo-->
                        <div class="profile-photo">
                            <img src="assets/images/profile-1.png">
        
                        </div>
                        <!-- mesage -->
                        <div class ="message">
        
                            <p><b> Mike Tyzon </b>recive order of night lech GPS drone </p>
                            <small class="text-muted"> 2 minutes ago</small>
                        </div>                    
        
                    </div>
        
        
                    <div class="update">
                        <!--profile photo-->
                        <div class="profile-photo">
                            <img src="assets/images/profile-1.png">
        
                        </div>
                        <!-- mesage -->
                        <div class ="message">
        
                            <p><b> Mike Tyzon </b>recive order of night lech GPS drone </p>
                            <small class="text-muted"> 2 minutes ago</small>
                        </div>               
        
                    </div>

                </div>            
            
            </div>
          
          <!-- ===================end recent updateSIDE==================--->
             <!-- sales-analytics -->

             <div class="sales-analytics">
            
                <h2>Sales Analytics</h2>
                <!--bebut item1-->
                <div class="item offline">
                    <!--icon-->
                    <div class="icon"><span class="material-symbols-outlined">forum </span></div>
                  
                    <div class="right">
                        <div class="info">
                            <h3> item offline</h3>
                            <small class="text-muted">last 24hour</small>
                        </div>
                        <h5 class="success">39%</h5>
                        <h3>3849</h3>
                    </div>


                </div>
                     <!--end item1-->
                <!--bebut item2-->
                <div class="item costomers">
                    <!--icon-->
                    <div class="icon"><span class="material-symbols-outlined">forum </span></div>
                  
                    <div class="right">
                        <div class="info">
                            <h3> costomers</h3>
                            <small class="text-muted">last 24hour</small>
                        </div>
                        <h5 class="danger">39%</h5>
                        <h3>3849</h3>
                    </div>


                </div>
                     <!--end item2-->
        <!--bebut item3-->
        <div class="item online">
            <!--icon-->
            <div class="icon"><span class="material-symbols-outlined">forum </span></div>
          
            <div class="right">
                <div class="info">
                    <h3> Online Forum</h3>
                    <small class="text-muted">last 24hour</small>
                </div>
                <h5 class="success">39%</h5>
                <h3>3849</h3>
            </div>


        </div>
             <!--end item3-->


            <div class="item add-product">
                <div class="">
            <span class="material-symbols-outlined">add</span>
                <h3>add product</h3>
                </div>
                
            </div>
           </div>

           <!-- sales-analytics--> 
           </div>
           <!-- ===================end Right SIDE==================--->

        
    </div>
     <!-- end main contener -->
</body>
 <!-- script  -->
 <script src="assets/js/dasboardestyle.js"> </script>
</html>