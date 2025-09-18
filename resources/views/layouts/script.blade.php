<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

<!-- Apex Charts -->
<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/dash1/sales.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/dash1/revenue.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/custom/dash1/source.js') }}"></script>

<!-- Vector Maps -->
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/gdp-data.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/continents-mill.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/custom/world-map-markers3.js') }}"></script>

<!-- Custom JS files -->
<script src="{{ asset('assets/js/custom.js') }}"></script>,
<script>
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('loader').style.display = 'block';
    });
</script>
<script>
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');
    let timeout = null;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            searchForm.submit();
        }, 500);
    });
</script>
<script>
    const photoInput = document.getElementById('photo-input');
    const photoPreview = document.getElementById('photo-preview');

    photoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block'; // Afficher l'image
            }

            reader.readAsDataURL(file);
        } else {
            photoPreview.src = '#';
            photoPreview.style.display = 'none';
        }
    });
</script>
