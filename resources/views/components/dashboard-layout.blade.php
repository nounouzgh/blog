<!-- resources/views/components/dashboard-layout.blade.php -->
<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name')}}</title>
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
<body>
    <div class="container">
        @php
        $user = Auth::guard('compte')->user()->user;
        @endphp
        <!-- Sidebar -->
        <x-sidebar role="{{ $user->role->name }}"/>
        
        <!-- Main content -->
        <main>
            <h1>Dashoard</h1>
            <!-- Insights section -->
            <div class="insights">
                {{ $contenu }}
            </div>
        </main>

        <!-- Right side content -->
        <div class="right">
            <!-- Top section -->
         
            <x-profile name="{{ $user->name }}" role="{{ $user->role->name }}" image="{{ $user->image }}" />

            <!-- Recent updates section -->
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

            <!-- Sales analytics section -->
            <div class="sales-analytics">
                <h2>List Coure</h2>
               


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

  
      
            </div>
        </div>
    </div>
    <!-- JavaScript scripts -->
    <script src="{{ asset('assets/js/dasboardestyle.js') }}"></script>

 
</body>
</html>

