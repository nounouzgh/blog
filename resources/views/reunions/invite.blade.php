<x-dashboard-layout>
    <x-slot name="contenu">
        <div class="info-container">
            
          
            <div class="title">
                <h1>Invite to Reunion</h1>
            </div>
            <form id="invitationForm" method="POST" action="{{ route('reunion.invite', ['reunionId' => $reunion->id]) }}">
                @csrf
                <p>Reunion Name: {{ $reunion->nom }}</p>
                <p>Reunion Date: {{ $reunion->date }}</p>
                <p>Reunion Duration: {{ $reunion->duree }}</p>
                <p>Reunion Speciality: {{ $reunion->specialite }}</p>
                <p>Reunion date: {{ $reunion->date }}</p>
                @php
                $currentDate = now();
                @endphp
                <input type="hidden" id="invitation_date" name="invitation_date" value="{{$currentDate}}">
                <label for="invite_type"><p>Invite:</p></label>
                <select id="invite_type" name="invite_type">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
                <div id="invite_list">
                    <!-- Table to display the list of users -->
                    <table id="invite_table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Prenom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- User rows will be added here dynamically -->
                        </tbody>
                    </table>
                    
                </div>
                <button type="submit">Send Invitation</button>
            </form>
        
            <div id="responseMessage"></div>
        
            <div class="pagination" style="margin-top: 20px; text-align: center;"></div>

        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">


<script>

document.addEventListener("DOMContentLoaded", function() {
    function updateInviteList(page = 1) {
        var inviteType = document.getElementById('invite_type').value;
        fetch('/get-' + inviteType + '-list?page=' + page)
            .then(response => response.json())
            .then(data => {
                var inviteTableBody = document.querySelector('#invite_table tbody');
                inviteTableBody.innerHTML = '';
                if (data.data && data.data.length > 0) {
                    data.data.forEach(item => {
                        var row = document.createElement('tr');

                        var selectCell = document.createElement('td');
                        var checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'selected_user_ids[]';
                        checkbox.value = item.users.id;
                        selectCell.appendChild(checkbox);
                        row.appendChild(selectCell);

                        var nameCell = document.createElement('td');
                        nameCell.textContent = item.users.name || 'User data missing';
                        row.appendChild(nameCell);

                        var prenomCell = document.createElement('td');
                        prenomCell.textContent = item.users.prenom || '';
                        row.appendChild(prenomCell);

                        inviteTableBody.appendChild(row);
                    });
                } else {
                    console.error('Error fetching data: No data available');
                }

                // Add pagination links
                var paginationDiv = document.querySelector('.pagination');
                paginationDiv.innerHTML = ''; // Clear previous pagination links

                // Add Previous link
                if (data.prev_page_url) {
                    var prevLink = document.createElement('a');
                    prevLink.classList.add('page-link');
                    prevLink.href = '#';
                    prevLink.innerHTML = '&laquo; Previous';
                    prevLink.setAttribute('data-page', data.current_page - 1);
                    paginationDiv.appendChild(prevLink);
                }

                // Add page number links
                data.links.forEach(link => {
                    if (link.label !== '&laquo; Previous' && link.label !== 'Next &raquo;') {
                        var pageLink = document.createElement('a');
                        pageLink.classList.add('page-link');
                        pageLink.href = '#';
                        pageLink.innerHTML = link.label;
                        if (link.url) {
                            pageLink.setAttribute('data-page', link.url.split('page=')[1]);
                        }
                        if (link.active) {
                            pageLink.classList.add('active');
                        }
                        paginationDiv.appendChild(pageLink);
                    }
                });

                // Add Next link
                if (data.next_page_url) {
                    var nextLink = document.createElement('a');
                    nextLink.classList.add('page-link');
                    nextLink.href = '#';
                    nextLink.innerHTML = 'Next &raquo;';
                    nextLink.setAttribute('data-page', data.current_page + 1);
                    paginationDiv.appendChild(nextLink);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    updateInviteList();

    document.getElementById('invite_type').addEventListener('change', function() {
        updateInviteList();
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('page-link') && event.target.tagName === 'A') {
            event.preventDefault();
            var page = event.target.getAttribute('data-page');
            updateInviteList(page);
        }
    });

    document.getElementById('invitationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var selectedUserIds = Array.from(document.querySelectorAll('input[name="selected_user_ids[]"]:checked')).map(checkbox => checkbox.value);
        selectedUserIds = [...new Set(selectedUserIds)];

        var formData = new FormData(this);
        selectedUserIds.forEach(userId => formData.append('selected_user_ids[]', userId));

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            var responseMessageDiv = document.getElementById('responseMessage');
            responseMessageDiv.innerHTML = '';
            if (data.success) {
                responseMessageDiv.innerHTML = `
                    <p>Invitations sent successfully!</p>
                    <p>Invitation Date: ${data.invitation_date}</p>
                    <p>Message: ${data.message}</p>
                `;
            } else {
                responseMessageDiv.innerHTML = `<p>Error: ${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error submitting form:', error);
            var responseMessageDiv = document.getElementById('responseMessage');
            responseMessageDiv.innerHTML = `<p>Error submitting form: ${error.message}</p>`;
        });
    });
});


</script>
<style>

/* Hide the default checkboxes */
#invite_table input[type=checkbox] {
    display: none;
}

/* Create custom checkbox appearance */
#invite_table input[type=checkbox] {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 1px solid #833333; /* Border color */
    background-color: #edeaf3; /* Unchecked background color */
    border-radius: 3px; /* Rounded corners */
    vertical-align: middle;
    margin-right: 10px; /* Adjust spacing */
}

/* Style the custom checkbox when checked */
#invite_table input[type=checkbox]:checked {
    background-color: #007bff; /* Checked background color */
}

/* Adjust the alignment of the label and checkbox */
#invite_table input[type=checkbox]{
    cursor: pointer;
}
/* CSS PAGE NOW               *//* Form styling */


#invitationForm {
    max-width: 600px; /* Adjust as needed */
    margin: 0 auto; /* Center the form */
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

#invitationForm h1 {
    margin-top: 0;
    font-size: 24px;
    color: #333; /* Darken the text color */
}

/* Paragraph styling */
#invitationForm p {
    margin-bottom: 10px;
    color: #555; /* Text color */
    font-size: 16px; /* Font size */
    line-height: 1.5; /* Line height */
}

#invitationForm label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333; /* Darken the text color */
}

#invitationForm select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #555; /* Lighten the text color */
}

#invitationForm button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#invitationForm button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Table styling */
#invite_table {
    width: 100%;
    border-collapse: collapse;
}

#invite_table th,
#invite_table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    color: #333; /* Darken the text color */
}

#invite_table th {
    background-color: #f2f2f2;
    font-weight: bold;
    text-align: left;
}

#invite_table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

#invite_table tbody tr:hover {
    background-color: #e9e9e9;
}

/* Custom checkbox styling */
#invite_table input[type=checkbox] {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    border-radius: 3px;
    vertical-align: middle;
    margin-right: 10px;
    cursor: pointer;
}

#invite_table input[type=checkbox]:checked {
    background-color: #007bff;
}




/* Pagination styling */
.pagination {
    margin-top: 20px;
    text-align: center;
}

.pagination a {
    display: inline-block;
    padding: 8px 16px;
    text-decoration: none;
    color: #007bff;
    border: 1px solid #007bff;
    border-radius: 5px;
    margin-right: 5px;
}

.pagination a.active {
    background-color: #007bff;
    color: #fff;
}

.pagination a:hover:not(.active) {
    background-color: #f0f0f0;
}

/*title*/
/* Additional CSS for title */

.title {
    text-align: center;
    margin: 0 0 2rem; /* for write in mid */
    margin-left: 20%;/* Move the container to the right */
    padding: 0 20px; /* Adjust padding as needed */
    width: 60%;
}

.title h1 {
    
    font-size: 2.5rem;
    color: #333; /* Adjust color as needed */
    font-weight: bold; /* Optionally make the font bold */
    text-transform: uppercase; /* Optionally transform text to uppercase */
    letter-spacing: 2px; /* Optionally adjust letter spacing */
}

/* Add a subtle shadow effect to the title */
.title h1 {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    border-bottom: 2px solid #333;
    padding-bottom: 0.5rem;
}

    </style>