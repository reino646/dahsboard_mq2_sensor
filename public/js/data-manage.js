import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import {
  getDatabase, ref, set, push, onValue, remove
} from "https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js";

// Firebase config
const firebaseConfig = {
  databaseURL: "https://testing-mq2-default-rtdb.asia-southeast1.firebasedatabase.app"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

// DOM
const thresholdTable = document.getElementById('thresholdTable');
const modal = document.getElementById('thresholdModal');
const modalValue = document.getElementById('modalValue');
const modalDescription = document.getElementById('modalDescription');
const modalOutput = document.getElementById('modalOutput');
const saveBtn = document.getElementById('saveThresholdBtn');
const openModalBtn = document.getElementById('openModalBtn');
const notifTable = document.getElementById('notificationTable');
const clearNotifBtn = document.getElementById('clearNotifBtn');

// Firebase Refs
const listRef = ref(db, 'settings/thresholds');
const activeRef = ref(db, 'settings/active_threshold');
const mq2Ref = ref(db, 'mq2');
const notifRef = ref(db, 'notifications');

// Tampilkan daftar threshold
onValue(listRef, (snap) => {
  const data = snap.val();
  thresholdTable.innerHTML = '';
  if (data) {
    Object.entries(data).forEach(([key, obj]) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${obj.ppm}</td>
        <td>${obj.desc || '-'}</td>
        <td>${obj.output || '-'}</td>
        <td>
          <button style="background-color:#4CAF50;padding: 10px; border-radius:10%;color:white;font-size:0.8rem;" onclick="editThreshold('${key}', ${obj.ppm}, '${obj.desc || ''}', '${obj.output || ''}')">Edit</button> 
          <button style="background-color:red;padding: 10px;border-radius:10%;color:white; font-size:0.8rem;" onclick="deleteThreshold('${key}')">Hapus</button>
        </td>
      `;
      thresholdTable.appendChild(row);
    });
  }
});

// Tambah atau Edit threshold
saveBtn.addEventListener('click', () => {
  const ppm = parseInt(modalValue.value);
  const desc = modalDescription.value.trim();
  const output = modalOutput.value;

  if (!ppm || ppm <= 0 || !desc || !output) {
    alert("PPM harus lebih dari 0, deskripsi dan aksi tidak boleh kosong.");
    return;
  }

  const data = { ppm, desc, output };
  const editingKey = modal.getAttribute('data-editing');

  if (editingKey) {
    // Mode edit
    set(ref(db, `settings/thresholds/${editingKey}`), data);
    set(ref(db, `settings/active_threshold/${editingKey}`), data);
    modal.removeAttribute('data-editing');
  } else {
    // Mode tambah baru
    const newRef = push(listRef);
    set(newRef, data);
    set(ref(db, `settings/active_threshold/${newRef.key}`), data);
  }

  modalValue.value = '';
  modalDescription.value = '';
  modalOutput.value = 'buzzer';
  closeModal();
});

// Fungsi edit threshold
window.editThreshold = function (key, ppm, desc, output) {
  modalValue.value = ppm;
  modalDescription.value = desc;
  modalOutput.value = output || 'buzzer';
  modal.setAttribute('data-editing', key);
  modal.style.display = 'flex';
};

// Hapus threshold
window.deleteThreshold = function (key) {
  if (confirm("Yakin ingin menghapus threshold ini?")) {
    remove(ref(db, `settings/thresholds/${key}`));
    remove(ref(db, `settings/active_threshold/${key}`));
  }
};

// Modal control
openModalBtn.addEventListener('click', () => {
  modalValue.value = '';
  modalDescription.value = '';
  modalOutput.value = 'buzzer';
  modal.removeAttribute('data-editing');
  modal.style.display = 'flex';
});
window.closeModal = function () {
  modal.style.display = 'none';
};

// … (kode sebelumnya tetap sama) …

// Notifikasi realtime
let notifiedKeys = {};

onValue(mq2Ref, (snap) => {
  const data = snap.val();
  if (!data) return;

  // Ambil sekali aktif thresholds di luar loop notifikasi agar tidak menumpuk listener
  onValue(activeRef, (activeSnap) => {
    const activeVals = activeSnap.val();
    if (!activeVals) return;

    Object.entries(activeVals).forEach(([key, th]) => {
      const now = new Date().toLocaleString();
      const descNotify = th.desc || '-';           // fallback jika desc undefined
      const outputNotify = th.output || '-';       // fallback jika output undefined

      // Jika melewati threshold dan belum pernah diberi notifikasi untuk key ini
      if (data.gas_ppm > th.ppm && !notifiedKeys[key]) {
        const logRef = push(notifRef);
        set(logRef, {
          time: now,
          ppm: data.gas_ppm,
          desc: descNotify,
          output: outputNotify
        }).then(() => {
          Swal.fire({
            icon: 'warning',
            title: '⚠️ Peringatan!',
            html: `PPM <strong>${data.gas_ppm}</strong> melebihi <strong>${th.ppm}</strong> (${descNotify})`,
            confirmButtonText: 'Oke',
            confirmButtonColor: '#e11d48'
          });
        });
        notifiedKeys[key] = true;
      }
      // Reset notifikasi jika sudah turun di bawah
      else if (data.gas_ppm <= th.ppm) {
        notifiedKeys[key] = false;
      }
    });
  }, { onlyOnce: true });
});

// … (kode selanjutnya tetap sama) …


// Tampilkan notifikasi di tabel
onValue(notifRef, (snap) => {
  const data = snap.val();
  notifTable.innerHTML = '';
  if (data) {
    Object.entries(data).forEach(([key, val]) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${val.time}</td>
        <td>${val.ppm}</td>
        <td>${val.desc}</td>
        <td><button style="background-color:red;padding: 10px;border-radius:10%;color:white;font-size:0.8rem;" onclick="deleteNotif('${key}')">Hapus</button></td>
      `;
      notifTable.appendChild(row);
    });
  }
});

// Hapus satu notifikasi
window.deleteNotif = function (key) {
  if (confirm("Hapus notifikasi ini?")) {
    remove(ref(db, `notifications/${key}`));
  }
};

// Hapus semua notifikasi
clearNotifBtn.addEventListener('click', () => {
  if (confirm("Hapus semua notifikasi?")) {
    remove(notifRef);
  }
});
