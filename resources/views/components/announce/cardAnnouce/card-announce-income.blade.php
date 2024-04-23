<div class="income">
    <!-- Icon -->
    <span class="material-symbols-outlined">analytics</span>
    
    <div class="middle">
        <!-- Content -->
        <div class="left">
            <h3>Total Income</h3>
            <h1>{{ $totalIncome }}</h1>
        </div>
        <div class="progress">
            <svg>
                <circle cx='38' cy='38' r='36'></circle>
            </svg>
            <div class="number">
                <p>{{ $progressPercentage }}</p>
            </div>
        </div>
    </div>
    
    <!-- Time frame -->
    <small class="text-muted">{{ $timeFrame }}</small>
</div>
