document.addEventListener('DOMContentLoaded', function () {
    // Memperbarui waktu dan tanggal
    function updateTimeAndDate() {
        const now = new Date();

        // Format waktu
        let jam = now.getHours();
        let menit = now.getMinutes();
        let detik = now.getSeconds();
        jam = jam < 10 ? '0' + jam : jam;
        menit = menit < 10 ? '0' + menit : menit;
        detik = detik < 10 ? '0' + detik : detik;

        // Format tanggal
        const hari = now.toLocaleDateString('id-ID', { weekday: 'long' });
        const tanggal = now.getDate();
        const bulan = now.getMonth() + 1;
        const tahun = now.getFullYear();
        const tanggalFormatted = `${hari}, ${tanggal < 10 ? '0' + tanggal : tanggal}-${bulan < 10 ? '0' + bulan : bulan}-${tahun}`;

        // Update konten HTML untuk waktu dan tanggal
        document.getElementById('time').textContent = `${jam}:${menit}:${detik}`;
        document.getElementById('date').textContent = tanggalFormatted;

        // Panggil fungsi untuk mengatur status tombol
        checkTimeForButtons(now);
    }

    // Fungsi untuk menangani logika tombol check-in dan check-out
    function checkTimeForButtons(now) {
        const currentHour = now.getHours();
        const checkInButton = document.getElementById('check-in-button');
        const checkOutButton = document.getElementById('check-out-button');

        // Disable tombol "Hadir" jika lebih dari jam 07:00
        if (checkInButton) {
            if (currentHour >= 6 && currentHour < 22) {
                checkInButton.disabled = false;
                checkInButton.style.backgroundColor = '#28a745'; // warna asli (hijau)
                checkInButton.style.color = '#ffffff'; // warna teks putih
            } else {
                checkInButton.disabled = true;
                checkInButton.style.backgroundColor = '#e0e0e0'; // warna pucat
                checkInButton.style.color = '#a0a0a0'; // warna teks pucat
            }
        }

        // Hanya aktifkan tombol "Pulang" antara jam 15:00 dan 18:00
        if (checkOutButton) {
            if (currentHour >= 22 && currentHour < 23) {
                checkOutButton.disabled = false;
                checkOutButton.style.backgroundColor = '#7B3F00'; // warna asli
                checkOutButton.style.color = '#ffffff'; // warna teks putih
            } else {
                checkOutButton.disabled = true;
                checkOutButton.style.backgroundColor = '#e0e0e0'; // warna pucat
                checkOutButton.style.color = '#a0a0a0'; // warna teks pucat
            }
        }
    }

    // Fungsi untuk menampilkan greeting
    function displayGreeting() {
        const now = new Date();
        let greeting = '';

        if (now.getHours() < 12) {
            greeting = 'Selamat Pagi,';
        } else if (now.getHours() < 15) {
            greeting = 'Selamat Siang,';
        } else if (now.getHours() < 18) {
            greeting = 'Selamat Sore,';
        } else {
            greeting = 'Selamat Malam,';
        }

        // Update konten HTML untuk greeting jika elemen ada
        const greetingElement = document.getElementById('greeting');
        if (greetingElement) {
            greetingElement.textContent = greeting;
        }
    }

    // Memperbarui waktu, tanggal, dan greeting setiap detik
    setInterval(updateTimeAndDate, 1000);
    setInterval(displayGreeting, 1000);

    // Panggil sekali untuk menginisialisasi
    updateTimeAndDate();
    displayGreeting();
});
