<!-- Footer -->
<footer class="bg-gray-800 text-white py-4 fixed left-0 bottom-0 right-0 w-full mt-4 shadow-lg">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 My Application. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<!-- Display Success Message -->
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Good job!',
            text: '{{ session('success')  }}',
            icon: 'success',
        })
    </script>
@endif

    </body>
</html>
