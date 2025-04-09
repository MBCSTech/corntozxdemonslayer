@props(['field'])

@error($field)
    <div class="error-popup" style="display: block;" id="error-{{ $field }}">
        {{ $message }}
    </div>
    
    <script>
        setTimeout(() => {
            const errorElement = document.getElementById('error-{{ $field }}');
            errorElement.style.opacity = '1'; // Ensure it's visible
            
            // Start fade out
            errorElement.style.transition = 'opacity 0.5s ease';
            errorElement.style.opacity = '0';
            
            // Remove after animation
            setTimeout(() => {
                errorElement.style.display = 'none';
            }, 500);
        }, 3000);
    </script>
@enderror