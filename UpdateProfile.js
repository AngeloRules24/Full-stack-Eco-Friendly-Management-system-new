document.addEventListener('DOMContentLoaded', function() {
    // Delete popup functionality
    const deleteButton = document.querySelector('.deletebutton');
    const popup = document.getElementById('deletePopup');
    const noButton = document.querySelector('.nobutton');
    const yesButton = document.querySelector('.yesbutton');

    deleteButton.addEventListener('click', function() {
        popup.style.display = 'flex';
    });

    noButton.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    yesButton.addEventListener('click', function() {
        alert('Account deleted successfully!');
        popup.style.display = 'none';
    });

    // Profile picture functionality
    const fileInput = document.getElementById('fileInput');
    const profileImage = document.getElementById('profileImage');
    const uploadButton = document.querySelector('.uploadButton');
    const removeButton = document.querySelector('.removeButton');
    const form = document.querySelector('form');

    if (removeButton) {
        removeButton.style.display = 'none';
    }
    
    if (uploadButton && fileInput) {
        uploadButton.addEventListener('click', function() {
            fileInput.click();
        });
    }

    if (fileInput && profileImage) {
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            if (file) {
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size too large. Please select an image under 5MB.');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                    if (removeButton) {
                        removeButton.style.display = 'block';
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }

    if (removeButton && profileImage && fileInput) {
        removeButton.addEventListener('click', function() {
            profileImage.src = 'default-avatar.jpg';
            fileInput.value = '';
            removeButton.style.display = 'none';
        });
    }
});