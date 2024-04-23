<div class="sales">
    <!-- this class have 2 positiontop one and down one-->
      <!-- her icon will be top  and we mouve icon left in css -->
       <span class="material-symbols-outlined"> analytics </span>
       <div class="middle">
           <!--  will be main cader for 1 sell  we  will have left  + progress -->
           <div class="left">
               <h3>total sell</h3>
               <h1>{{ $salle }}</h1>
           </div>
           <div class="progress">
               <svg>
                   <circle cx='38' cy='38' r='36'>
                   </circle>
               </svg>
               <div class="number">
                   <p>{{ $progressPercentage }}</p>
               </div>
           </div>

       </div>
       <small class="text-muted"> {{ $timeFrame }} </small>
   </div>