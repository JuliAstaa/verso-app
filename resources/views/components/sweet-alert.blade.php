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
                const data = event[0] || event;
                
                Swal.fire({
                    title: 'Yakin mau hapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
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
            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    title: 'Waduh Error!',
                    text: data[0].message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            });

        });
    </script>
</div>