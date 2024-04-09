 <!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('lp/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('lp/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Template Main JS File -->
<script src="{{ asset('lp/assets/js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
// buscar dando click al botton
document.getElementById('btn-search').addEventListener('click', function(e) {
    e.preventDefault();

    var searchValue = document.getElementById('input-search').value;

    performSearch(searchValue);
});
    
// buscar al presionar enter en el input
document.getElementById('input-search').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        
        var searchValue = this.value;
        
        performSearch(searchValue);
    }
});

// función para realizar la búsqueda
function performSearch(searchValue) {
    var searchRouteUrl = "{{ route('search') }}"; // Ajusta esto según la URL de tu ruta de búsqueda en Laravel

    axios.post(searchRouteUrl, {
        search: searchValue,
        _token: "{{ csrf_token() }}"
    })
    .then(function (response) {
        document.getElementById('div-search').innerHTML = response.data;

        // Desplaza suavemente a #div-search después de que su contenido se haya actualizado
        document.getElementById('div-search').scrollIntoView({ 
            behavior: 'smooth' 
        });

    })
    .catch(function (error) {
        console.error('Hubo un problema al realizar la solicitud:', error);
    });
}

</script>