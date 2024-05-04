<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>default {{ config('app.name') }}</title>
    <!-- #css  this page -->
    <link rel="stylesheet" href="{{ asset('assets/css/dasboardestyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/MultiPlatforme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/NaveBaresytle.css') }}">

     <!-- #materials icons -->
     <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200') }}">
     <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
      <!--  nave bare incu -->

   

</head>
<body>

   
    <!-- page contener -->
    <div class="container">
        <!-- aside tage -->
        <!-- end of Aside menu left menu-->
        <x-sidebar  
        />
        <!-- end of Aside menu-->
        <main>
            <h1>Dashoard</h1>


            <!--  will be like 30 % from or 40 % from main div for put nmber from dive class -->
           <!-- =================debut  insights=================-->
            <div class="insights">
                <!-- her will be where u put  small dive close to eatch other 1/2 main div-->

                <!--debut sell -->
                
            <!-- end of sells-->
<x-card-announce-salle salle="600.024" progress-percentage="31%" time-frame="last 24 Hours" />

            <!--debut Expences -->
<x-card-announce-expenses total-expenses="600.024" progress-percentage="31%" time-frame="last 24 Hours" />

           <!-- end of Expences-->
   <!--debut income -->
<!-- Example of calling the CaderIncome component -->
<x-card-announce-income total-income="600.024" progress-percentage="31%" time-frame="last 24 Hours" />

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