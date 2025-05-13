import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import { getDatabase, ref, get } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js";

const firebaseConfig = {
  databaseURL: "https://testing-mq2-default-rtdb.asia-southeast1.firebasedatabase.app"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

const filterBtn = document.getElementById('filterBtn');
const exportExcelBtn = document.getElementById('exportExcelBtn');
const exportPdfBtn = document.getElementById('exportPdfBtn');

let exportedData = [];

const ctx = document.getElementById('gasChart').getContext('2d');
const gasChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: 'Gas PPM',
      borderColor: 'red',
      backgroundColor: 'white',
      data: []
    }]
  },
  options: {
    responsive: true,
    scales: {
      x: {
        title: { display: true, text: 'Waktu' }
      },
      y: {
        beginAtZero: true,
        min: 0,      // nilai dasar bawah
        max: 500,   // ubah ini sesuai kebutuhan agar line tidak terlalu ke atas
        title: { display: true, text: 'PPM' }
      }
    }
  }
});

filterBtn.addEventListener('click', () => {
  const startInput = document.getElementById('startTime').value;
  const endInput = document.getElementById('endTime').value;

  if (!startInput || !endInput) {
    alert("Mohon isi kedua waktu filter.");
    return;
  }

  const startTime = new Date(startInput);
  const endTime = new Date(endInput);

  const logsRef = ref(db, 'mq2_logs');
  get(logsRef).then(snapshot => {
    const logs = snapshot.val();
    const labels = [];
    const data = [];
    exportedData = [];

    if (logs) {
      Object.values(logs).forEach(entry => {
        if (entry.timestamp && entry.gas_ppm !== undefined) {
          try {
            const entryDate = new Date(`1970-01-01T${entry.timestamp}`);
            if (entryDate >= new Date(`1970-01-01T${startTime.toTimeString().substring(0, 8)}`) &&
                entryDate <= new Date(`1970-01-01T${endTime.toTimeString().substring(0, 8)}`)) {

              labels.push(entry.timestamp);
              data.push(entry.gas_ppm);

              exportedData.push({
                Timestamp: entry.timestamp,
                Gas_PPM: entry.gas_ppm,
                Status: entry.status || '',
              });
            }
          } catch (e) {
            console.warn("Timestamp tidak valid:", entry.timestamp);
          }
        }
      });
    }

    gasChart.data.labels = labels;
    gasChart.data.datasets[0].data = data;
    gasChart.update();

    if (labels.length === 0) {
      alert("Tidak ada data dalam rentang waktu tersebut.");
    }

  }).catch(error => {
    console.error("Error getting data:", error);
  });
});

exportExcelBtn.addEventListener('click', () => {
  if (exportedData.length === 0) {
    alert("Belum ada data untuk diekspor.");
    return;
  }

  const worksheet = XLSX.utils.json_to_sheet(exportedData);
  const workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, "MQ2 Logs");
  XLSX.writeFile(workbook, "mq2_logs.xlsx");
});

exportPdfBtn.addEventListener('click', () => {
  if (exportedData.length === 0) {
    alert("Belum ada data untuk diekspor.");
    return;
  }

  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  doc.setFontSize(14);
  doc.text("Riwayat Sensor MQ-2", 14, 15);

  const headers = [["No", "Timestamp", "Gas PPM", "Status"]];
  const body = exportedData.map((row, index) => [
    index + 1,
    row.Timestamp,
    row.Gas_PPM,
    row.Status
  ]);

  doc.autoTable({
    startY: 20,
    head: headers,
    body: body,
    styles: { fontSize: 10, cellPadding: 3 },
    headStyles: { fillColor: [22, 160, 133] },
    margin: { top: 20 }
  });

  doc.save("mq2_logs.pdf");
});

const exportJpgBtn = document.getElementById('exportJpgBtn');

exportJpgBtn.addEventListener('click', () => {
  const canvas = document.getElementById('gasChart');
  const link = document.createElement('a');
  link.href = canvas.toDataURL('image/jpeg', 1.0); // kualitas maksimal
  link.download = 'mq2_chart.jpg';
  link.click();
});

