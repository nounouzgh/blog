
document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle between My Resource and All Resource
    function toggleResourceView(view) {
        const myResourceDiv = document.querySelector('.my-resource');
        const allResourceDiv = document.querySelector('.all-resource');

        // Show/hide divs based on the view
        if (view === 'my') {
            myResourceDiv.style.display = 'block';
            allResourceDiv.style.display = 'none';
        } else {
            myResourceDiv.style.display = 'none';
            allResourceDiv.style.display = 'block';
        }
    }


    // Function to get URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
        const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        const results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    // Check if the URL contains the 'view' parameter and toggle resource view accordingly
    const viewParam = getUrlParameter('view');
    if (viewParam === 'all') {
        toggleResourceView('all');
    } else {
        toggleResourceView('my');
    }

    // Add click event listener to the sidebar links for Resource
    document.querySelectorAll('[data-resource-view]').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
    
            // Get the view type from the data attribute
            const view = this.getAttribute('data-resource-view');
            
            // Toggle resource view
            toggleResourceView(view);
            
            // Get the base URL without query parameters
            const baseUrl = this.href.split('?')[0];
            
            // Redirect to the resource index page with the view type as a query parameter
            const resourceIndexUrl = `${baseUrl}?view=${view}`;
            window.location.href = resourceIndexUrl;
        });
    });
    
});
