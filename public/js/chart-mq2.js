import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import {
    getDatabase,
    ref,
    onValue,
    push,
    set,
} from "https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js";

// Firebase config
const firebaseConfig = {
    databaseURL:
        "https://testing-mq2-default-rtdb.asia-southeast1.firebasedatabase.app",
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

// Elemen DOM
const latestDiv = document.getElementById("latestData");
const ctx = document.getElementById("gasChart").getContext("2d");

// Chart konfigurasi
const gasChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [],
        datasets: [
            {
                label: "Gas PPM",
                borderColor: "red",
                backgroundColor: "white",
                data: [],
            },
        ],
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: "Waktu" } },
            y: { min: 0, max: 1200, title: { display: true, text: "PPM" } },
        },
    },
});

let previousStatusColor = sessionStorage.getItem('previousStatusColor') || null; // Ambil status warna sebelumnya dari sessionStorage
let isWaiting = false; // Penanda delay aktif

function updateLatest(data, thresholds) {
    // Tentukan apakah ada treshold yang terlampaui
    const exceed = thresholds.some((t) => data.gas_ppm > t.ppm);

    // Menentukan warna status berdasarkan apakah treshold terlampaui
    const statusColor = exceed
        ? "bg-red-100 border-red-500 text-red-700" // Merah jika melebihi batas
        : "bg-green-100 border-green-500 text-green-700"; // Hijau jika aman

    // Menentukan teks status berdasarkan treshold
    const statusText = exceed ? "Tidak Normal" : "Aman"; // Status berubah sesuai treshold

    const statusIconColor = exceed ? "text-red-500" : "text-green-500";

    // Jika warna status berubah
    if (statusColor !== previousStatusColor) {
        if (!isWaiting) {
            isWaiting = true;

            // Tampilkan loading spinner
            latestDiv.innerHTML = ` 
                <div class="flex justify-center items-center h-40">
                    <svg class="animate-spin h-8 w-8 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span class="ml-3 text-red-700 font-medium">Memuat data terbaru...</span>
                </div>
            `;

            setTimeout(() => {
                renderLatestData(statusText); // Pass statusText ke fungsi render
                isWaiting = false;
                previousStatusColor = statusColor;
                sessionStorage.setItem('previousStatusColor', statusColor); // Simpan status warna ke sessionStorage
            }, 1000);
        }
    } else {
        renderLatestData(statusText); // Pastikan render dengan status terbaru
    }

    function renderLatestData(statusText) {
        latestDiv.innerHTML = `
        <div class="flex flex-wrap gap-4 justify-center">
          <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl shadow w-48">
            <h4 class="font-bold flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 20h16M6 16v-4M10 16v-8M14 16v-2M18 16v-6" />
              </svg>
              PPM
            </h4>
            <p>${data.gas_ppm}</p>
          </div>
          <div class="${statusColor} border-l-4 p-4 rounded-xl shadow w-48">
            <h4 class="font-bold flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ${statusIconColor}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a8 8 0 11-16 0 8 8 0 0116 0z" />
              </svg>
              Status
            </h4>
            <p>${statusText}</p> <!-- Menampilkan status berdasarkan treshold -->
          </div>
          <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-xl shadow w-48">
            <h4 class="font-bold flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4h16v16H4V4zm4 4h8v8H8V8z" />
              </svg>
              Digital
            </h4>
            <p>${data.digitalGas}</p>
          </div>
          <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 rounded-xl shadow w-48">
            <h4 class="font-bold flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Waktu
            </h4>
            <p>${data.timestamp}</p>
          </div>
        </div>
      `;
    }
}



// Referensi database
const mq2Ref = ref(db, "mq2");
const activeThresholdsRef = ref(db, "settings/thresholds");
const notifRef = ref(db, "notifications");

let thresholds = [];
let notifiedKeys = new Set(); // supaya tidak spam

// Ambil semua threshold
onValue(activeThresholdsRef, (snap) => {
    const data = snap.val();
    thresholds = data ? Object.values(data) : [];
});

// Data real-time dari MQ2
onValue(mq2Ref, (snapshot) => {
    const val = snapshot.val();
    updateLatest(val, thresholds);

    const now = new Date();
    const timeLabel = now.toTimeString().split(" ")[0];
    gasChart.data.labels.push(timeLabel);
    gasChart.data.datasets[0].data.push(val.gas_ppm);

    if (gasChart.data.labels.length > 10) {
        gasChart.data.labels.shift();
        gasChart.data.datasets[0].data.shift();
    }
    gasChart.update();

    // Cek apakah melebihi salah satu threshold
    thresholds.forEach((threshold) => {
        if (val.gas_ppm > threshold.ppm) {
            const key = `${threshold.ppm}-${threshold.desc}`;
            if (!notifiedKeys.has(key)) {
                notifiedKeys.add(key);

                // Notif popup
                Swal.fire({
                    icon: "warning",
                    title: "⚠️ Peringatan!",
                    html: `PPM <strong>${val.gas_ppm}</strong> melebihi <strong>${threshold.ppm}</strong> (${threshold.desc})`,
                    confirmButtonText: "Oke",
                    confirmButtonColor: "#f87171",
                });
                
                // Simpan ke Firebase
                const notifData = {
                    ppm: val.gas_ppm,
                    desc: threshold.desc,
                    time: new Date().toLocaleString(),
                };
                const newNotif = push(notifRef);
                set(newNotif, notifData);
            }
        } else {
            const key = `${threshold.ppm}-${threshold.desc}`;
            notifiedKeys.delete(key);
        }
    });
});
