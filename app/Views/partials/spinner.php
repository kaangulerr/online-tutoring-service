<style>
    #spinner {
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s ease-out, visibility 0s linear .5s;
        z-index: 99999;
    }

    #spinner.show {
        transition: opacity .5s ease-out, visibility 0s linear 0s;
        visibility: visible;
        opacity: 1;
    }
</style>

<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        const spinner = document.getElementById('spinner');

        if (spinner) {
            setTimeout(function() {
                spinner.classList.remove('show');
            }, 100);
        }
    });

    function hideSpinner() {
        const spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.classList.remove('show');
        }
    }

    function showSpinner() {
        const spinner = document.getElementById('spinner');
        if (spinner) {
            spinner.classList.add('show');
        }
    }
</script>
