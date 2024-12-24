<script>
    let errorMessage = '{{ session('error') }}'
    let successMessage = '{{ session('success') }}'

    if (errorMessage) {
        Toastify({
            text: errorMessage,
            duration: 2000,
            close: true,
            style: {
                'font-size': '15px',
                background: "linear-gradient(to right, #e74c3c, #e74c3c)",
            }
        }).showToast();
    }

    if (successMessage) {
        Toastify({
            text: successMessage,
            duration: 2000,
            close: true,
            style: {
                'font-size': '15px',
                background: "linear-gradient(to right, #82e0aa, #82e0aa)",
            }
        }).showToast();
    }
</script>
