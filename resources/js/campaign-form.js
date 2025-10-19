document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('campaign-image');
    const imagePreview = document.getElementById('image-preview');
    const form = document.getElementById('campaign-form');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    alert('Hanya file JPG dan PNG yang diizinkan');
                    imageInput.value = '';
                    return;
                }

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 5MB');
                    imageInput.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        });
    }

    // Form validation and step navigation
    if (form) {
        const steps = document.querySelectorAll('.step-content');
        const stepIndicators = document.querySelectorAll('.step');
        const nextButtons = document.querySelectorAll('.btn-next');
        const prevButtons = document.querySelectorAll('.btn-prev');
        let currentStep = 1;

        function validateStep(step) {
            const currentStepElement = document.querySelector(`.step-content[data-step="${step}"]`);
            const inputs = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    const errorMessage = input.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.style.display = 'block';
                    }
                }
            });

            return isValid;
        }

        function showStep(step) {
            steps.forEach(s => s.classList.remove('active'));
            document.querySelector(`.step-content[data-step="${step}"]`).classList.add('active');
            
            stepIndicators.forEach(s => {
                if (parseInt(s.dataset.step) === step) {
                    s.classList.add('active');
                } else if (parseInt(s.dataset.step) < step) {
                    s.classList.add('completed');
                } else {
                    s.classList.remove('active', 'completed');
                }
            });
        }

        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentStep--;
                showStep(currentStep);
            });
        });

        // Show initial step
        showStep(1);
    }
});