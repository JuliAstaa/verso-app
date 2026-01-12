<div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            
            // Listener untuk SUCCESS
            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: 'success',
                    confirmButtonText: 'OK, Mantap!',
                    confirmButtonColor: '#5B4636', 
                    iconColor: '#5B4636',
                    background: '#fff',
                    borderRadius: '1rem',
                    customClass: {
                        popup: 'rounded-2xl shadow-xl',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-bold'
                    }
                }).then((result) => {
                    /* --- INI TAMBAHANNYA --- */
                    // Kalau tombol OK diklik (isConfirmed), kirim sinyal balik ke Livewire
                    if (result.isConfirmed) {
                        Livewire.dispatch('close-modal-event'); 
                    }
                });;
            });

            Livewire.on('swal:confirm', (event) => {
                let data = event[0] || event;
                console.log("Data Confirm Diterima:", data);
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kalau user klik Ya, panggil fungsi delete di PHP
                        // Parameternya dikirim lewat ID
                        Livewire.dispatch('deleteConfirmed', { id: data.id }); 
                    }
                });
            });

            // Listener untuk ERROR (Jaga-jaga kalau butuh nanti)
            Livewire.on('swal:error', (event) => {
               // 1. Ambil event pesan dari Livewire (PHP)
                let data = event.detail[0] || event.detail; 

                Swal.fire({
                    // Judul Default kalau ga dikirim dari PHP
                    title: data.title || 'Waduh Error!',
                    
                    // INI KUNCINYA: Pakai text dari PHP, jangan hardcode!
                    text: data.text || 'Terjadi kesalahan sistem.',
                    
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            });

            Livewire.on('swal:toast', (event) => {
                let data = event[0] || event;
                
                // Konfigurasi Toast Kecil di Pojok
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end', // Pojok Kanan Atas
                    showConfirmButton: false,
                    timer: 3000,         // Ilang dalam 3 detik
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: data.type, // success / error / warning
                    title: data.title,
                    text: data.text || '' // Text opsional
                });
            });

        });
    </script>
</div>