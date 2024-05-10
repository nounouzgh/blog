


    var fullPaths = [
        "/storage/profile/man/face.jpg",
        "/storage/profile/man/haker.jpg",
        "/storage/profile/man/robo.jpg",
        "/storage/profile/woman/panda.jpg",
        "/storage/profile/woman/woman.jpg"
    ];
    var backgroundImageUrl = "/storage/profile/Background/profile.png";
    var manPaths = [];
    var womanPaths = [];


    fullPaths.forEach(function(fullPath) {
  var splitPath = fullPath.split("/");
  var category = splitPath[splitPath.indexOf("profile") + 1];
  var imageName = splitPath[splitPath.length - 1];
  var imageNameWithoutExtension = imageName.split('.')[0];
  var imageObject = {
    name: imageNameWithoutExtension,
    path: fullPath
  };
  if (category === "man") {
    manPaths.push(imageObject);
  } else if (category === "woman") {
    womanPaths.push(imageObject);
  }
});


    var imagePaths = {
        "man": manPaths,
        "woman": womanPaths
    };
    function toggleEditForm() {
        var form = document.getElementById("editForm");
        var button = document.querySelector("button");
        if (form.style.display === "none") {
            form.style.display = "block";
            button.textContent = "Cancel";
        } else {
            form.style.display = "none";
            button.textContent = "Edit";
        }
    }

    function addAndUpdateImage(selectedImageSrc) {
        var profileItem = document.querySelector('.profile-item');
        var imageContainer = profileItem.querySelector('.profile-image-container');
        var profileImage = imageContainer.querySelector('.profile-image');
        profileImage.src = selectedImageSrc;
        profileImage.style.display = 'block';
        // You may want to update the backend with the selected image here
    }

    function toggleImageList() {
    var overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
    var imageList = document.getElementById('imageList');
    imageList.style.display = 'block';
    var imageListContent = document.getElementById('imageList');
    imageListContent.innerHTML = '';
    for (var key in imagePaths) {
        if (imagePaths.hasOwnProperty(key)) {
            var category = document.createElement('h2');
            category.textContent = key;
            imageListContent.appendChild(category);
            var table = document.createElement('table');
            var tr = document.createElement('tr');
            imagePaths[key].forEach(function(imageObject) {
                var td = document.createElement('td');
                var img = document.createElement('img');
                img.src = imageObject.path;
                img.alt = imageObject.name;
                img.classList.add('selectable-image');
                img.addEventListener('click', function() {
                    var selectedImageSrc = this.src;
                    // image in page
                    addAndUpdateImage(selectedImageSrc);
                    // fulll value input to send to controller
                    fillProfileImageSrc(selectedImageSrc);
            
                    document.getElementById('overlay').style.display = 'none';
                    document.getElementById('imageList').style.display = 'none';
                });
                td.appendChild(img);
                tr.appendChild(td);
            });
            table.appendChild(tr);
            imageListContent.appendChild(table);
        }
    }
}


    document.getElementById('overlay').addEventListener('click', function(event) {
        if (event.target === this) {
            this.style.display = 'none';
            document.getElementById('imageList').style.display = 'none';
        }
    });
// Set background image dynamically when the page loads
window.addEventListener('load', function() {
  
    var imageListBackground = document.getElementById('imageListBackground');
    if (imageListBackground) {
        imageListBackground.style.backgroundImage = 'url("' + backgroundImageUrl + '")';
    }
});

    function fillProfileImageSrc(imageSrc) {
    var profileImageSrcInput = document.querySelector('form#profileImageForm input[name="profile_image_src"]');
    if (profileImageSrcInput) {
        profileImageSrcInput.value = imageSrc;
    }
}
