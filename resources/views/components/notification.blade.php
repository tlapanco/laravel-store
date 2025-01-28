<style>
.notification {
    opacity: 1;
    animation: fadeIn 1.5s, fadeOut 1s 3.5s; /* Animación de entrada y salida */
}

.notification.fade-out {
    animation: fadeOut 0.5s forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(10px);
    }
}
</style>
<div class="w-full p-3 text-white notification flex items-center justify-center" id="notification">
    @if(session('success'))
    <div class="p-3 rounded-md bg-green-500 w-fit">
        {{ session('success')}}
    </div>
    @endif

    @if(session('error'))
    <div class="p-3 rounded-md bg-red-500 w-fit">
        {{ session('error') }}
    </div>
    @endif
    
</div>
<script>
        setTimeout(function() {
            const notification = document.getElementById('notification');
            notification.classList.add('fade-out');
            notification.addEventListener('animationend', () => {
                notification.remove()
            })            
        }, 4000);
</script>