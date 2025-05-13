import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import { getDatabase, ref, get, remove } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js";

const firebaseConfig = {
  databaseURL: "https://testing-mq2-default-rtdb.asia-southeast1.firebasedatabase.app"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

const tableBody = document.getElementById('historyTable');
const filterBtn = document.getElementById('filterBtn');
const clearAllBtn = document.getElementById('clearAllBtn');
const deleteByTimeBtn = document.getElementById('deleteByTimeBtn');

filterBtn.addEventListener('click', () => {
  const startInput = document.getElementById('startTime').value;
  const endInput = document.getElementById('endTime').value;

  if (!startInput || !endInput) {
    alert("Mohon isi kedua tanggal untuk filter.");
    return;
  }

  const startTime = new Date(`1970-01-01T${startInput.split('T')[1]}`);
  const endTime = new Date(`1970-01-01T${endInput.split('T')[1]}`);

  const logsRef = ref(db, 'mq2_logs');
  get(logsRef).then((snapshot) => {
    const logs = snapshot.val();
    tableBody.innerHTML = '';

    if (logs) {
      let count = 0;
      Object.entries(logs).forEach(([key, entry]) => {
        const entryTime = new Date(`1970-01-01T${entry.timestamp}`);
        if (entryTime >= startTime && entryTime <= endTime) {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${entry.timestamp}</td>
            <td>${entry.gas_ppm}</td>
            <td>${entry.status}</td>
            <td>${entry.digitalGas ?? '-'}</td>
          `;
          tableBody.appendChild(row);
          count++;
        }
      });

      if (count === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `<td colspan="4">Tidak ada data dalam rentang waktu tersebut.</td>`;
        tableBody.appendChild(row);
      }
    }
  }).catch(error => {
    console.error("Error getting data:", error);
  });
});

// ✅ Clear all logs
clearAllBtn.addEventListener('click', () => {
  if (confirm("Apakah Anda yakin ingin menghapus semua riwayat?")) {
    remove(ref(db, 'mq2_logs'))
      .then(() => alert("Semua data berhasil dihapus."))
      .catch((error) => console.error("Gagal menghapus data:", error));
  }
});

// ✅ Delete by time range
deleteByTimeBtn.addEventListener('click', () => {
  const start = document.getElementById('deleteStartTime').value;
  const end = document.getElementById('deleteEndTime').value;

  if (!start || !end) {
    alert("Mohon isi kedua tanggal untuk menghapus.");
    return;
  }

  const startTime = new Date(`1970-01-01T${start.split('T')[1]}`);
  const endTime = new Date(`1970-01-01T${end.split('T')[1]}`);

  const logsRef = ref(db, 'mq2_logs');
  get(logsRef).then(snapshot => {
    const logs = snapshot.val();
    if (!logs) {
      alert("Tidak ada data untuk dihapus.");
      return;
    }

    let deleteCount = 0;

    Object.entries(logs).forEach(([key, entry]) => {
      const entryTime = new Date(`1970-01-01T${entry.timestamp}`);
      if (entryTime >= startTime && entryTime <= endTime) {
        remove(ref(db, `mq2_logs/${key}`));
        deleteCount++;
      }
    });

    alert(`${deleteCount} data berhasil dihapus dari Firebase.`);
  }).catch(error => {
    console.error("Gagal menghapus data berdasarkan waktu:", error);
  });
});
