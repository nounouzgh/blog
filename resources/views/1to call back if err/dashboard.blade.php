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
        <x-ListAnnounce :resources="$resources" />

       <!-- =================end  Resent ORDER=================-->
        </main>
        <!-- =======================end main==================--->
        
         <!-- ===================Debut Right SIDE==================--->
           <div class="right">

            <!--bebut top-->
            @php
            $user = Auth::guard('compte')->user()->user;
            @endphp
          <x-profile name="{{ $user->name }}" role="{{ $user->role->name }}" profileNumber="1" />
            <!--end top-->

            <!--recent update-->
            <!-- main bordure titel + main produre update for info-->
            <div class="recent-updates">
                
            
                <h2> Recent Update</h2>
                <div class="updates">

                    <x-update 
                    :profileNumber="1"
                    :name="'Mike Tyzon'"
                    :cour="'informatique'"
                    :description="'intergation'"
                    :timer="'2 minutes ago'"
                />


                    <x-update 
                    :profileNumber="1"
                    :name="'Mike Tyzon'"
                    :cour="'informatique'"
                    :description="'intergation'"
                    :timer="'2 minutes ago'"
                />
                


        
                <x-update 
                :profileNumber="1"
                :name="'Mike Tyzon'"
                :cour="'informatique'"
                :description="'intergation'"
                :timer="'2 minutes ago'"
            />
        

                </div>            
            
            </div>
          
          <!-- ===================end recent updateSIDE==================--->
             <!-- sales-analytics -->

             <div class="sales-analytics">
            
                <h2>Sales Analytics</h2>
  
            <x-itemcostomers
            :icon="'forum'" 
            :title="'Online Forum'" 
            :subtitle="'Last 24 hours'" 
            :percentage="'60%'" 
            :count="'3849'" 
            />
            <x-itemoffline
            :icon="'forum'" 
            :title="'Online Forum'" 
            :subtitle="'Last 24 hours'" 
            :percentage="'39%'" 
            :count="'3849'" 
            />
            <x-itemonline
            :icon="'forum'" 
            :title="'Online Forum'" 
            :subtitle="'Last 24 hours'" 
            :percentage="'39%'" 
            :count="'3849'" 
            />
     
          
        
               <!-- Include the component with data -->
             
            <x-add-resource-button icon="add" title="Add Product" />

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