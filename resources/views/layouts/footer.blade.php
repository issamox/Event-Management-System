<!-- Footer -->
<footer class="bg-gray-800 text-white py-4 fixed left-0 bottom-0 right-0 w-full mt-4 shadow-lg dark:bg-black">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 My Application. All rights reserved.</p>
    </div>
</footer>
<!-- Include SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('scripts')
@if(session('success'))
    <script>

        Swal.fire({
            title: 'Good job!',
            text: '{{ session('success')  }}',
            icon: 'success',
        });
    </script>
@endif

@if(session('error'))
    <script>

        Swal.fire({
            title: 'Oops...',
            text: '{{ session('error')  }}',
            icon: 'error',
        });
    </script>
@endif

    </body>
</html>
