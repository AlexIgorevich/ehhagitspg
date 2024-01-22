// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                form.querySelector('[type=submit]').disabled = true
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.querySelector('[type=submit]').disabled = false
                }

                form.classList.add('was-validated')
                let formdata = new FormData(form);
                fetch(ajaxData.url, {
                    method: "POST",
                    credentials: 'same-origin',
                    body: formdata
                })
                    .then((response) => response.json())
                    .then((data) => {
                        form.querySelector('[type=submit]').disabled = false
                        form.classList.add('success')
                    })
            }, false)
        })
})()// Add your custom JS here.