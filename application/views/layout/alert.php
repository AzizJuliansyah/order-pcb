<style>
.colored-toast.swal2-popup {
    color: white;
    font-weight: 100;
    padding: 1rem 1.5rem;
    border-radius: 8px;
}

.colored-toast.swal2-icon-success {
    background-color: #a5dc86 !important;
}

.colored-toast.swal2-icon-error {
    background-color: #f27474 !important;
}

.colored-toast.swal2-icon-warning {
    background-color: #f8bb86 !important;
}

.colored-toast.swal2-icon-info {
    background-color: #3fc3ee !important;
}

.colored-toast.swal2-icon-question {
    background-color: #87adbd !important;
}

.colored-toast .swal2-title {
    color: white;
}

.colored-toast .swal2-close {
    color: white;
}

.colored-toast .swal2-html-container {
    color: white;
}
</style>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        })

        ;(async () => {
            Toast.fire({
                icon: 'error',
                title: "<?= $this->session->flashdata('error') ?>",
            })
        })()
    </script>
<?php elseif ($this->session->flashdata('success')): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 2800,
            timerProgressBar: true,
        })

        ;(async () => {
            Toast.fire({
                icon: 'success',
                title: "<?= $this->session->flashdata('success') ?>",
            })
        })()
    </script>
<?php endif; ?>