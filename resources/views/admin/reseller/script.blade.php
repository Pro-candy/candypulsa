<script>
function closePengirimModal() {
  const modal = document.getElementById('pengirimModal');
  if (modal) {
    const bsModal = bootstrap.Modal.getInstance(modal);
    if (bsModal) bsModal.hide();
  }
}

function addBarisBaru() {
  const table = document.querySelector('#tablePengirim tbody');
  const rowCount = table.rows.length;
  const row = table.insertRow();

  row.innerHTML = `
    <td>${rowCount + 1}</td>
    <td><input type="text" name="pengirim[]" class="form-control"></td>
    <td>
      <select name="tipe_pengirim[]" class="form-control">
        <option value="W">WhatsApp</option>
        <option value="H">HTTP</option>
        <option value="S">SMS</option>
        <option value="A">Aplikasi</option>
      </select>
    </td>
    <td><input type="checkbox" name="kirim_info[]" value="1"></td>
  `;
}

// Event delegation untuk tombol tambah baris
document.addEventListener('click', function (e) {
  if (e.target && e.target.id === 'tambahBaris') {
    addBarisBaru();
  }
});

// Tambah baris otomatis jika input kosong diisi
const tableBodyObserver = new MutationObserver(() => {
  const tableBody = document.querySelector('#tablePengirim tbody');
  if (tableBody) {
    tableBody.addEventListener('input', function () {
      const lastRow = tableBody.rows[tableBody.rows.length - 1];
      const lastInput = lastRow.querySelector('input[type="text"]');
      if (lastInput && lastInput.value.trim() !== '') {
        addBarisBaru();
      }
    });
  }
});

tableBodyObserver.observe(document.body, { childList: true, subtree: true });

// Simpan data pengirim
document.addEventListener('click', function (e) {
  if (e.target && e.target.id === 'simpanPengirim') {
    const formData = new FormData();
    const rows = document.querySelectorAll('#tablePengirim tbody tr');

    rows.forEach((row, i) => {
      const pengirim = row.querySelector('input[name="pengirim[]"]');
      const tipe = row.querySelector('select[name="tipe_pengirim[]"]');
      const kirim = row.querySelector('input[name="kirim_info[]"]');

      formData.append(`pengirim[${i}]`, pengirim?.value || '');
      formData.append(`tipe_pengirim[${i}]`, tipe?.value || '');
      formData.append(`kirim_info[${i}]`, kirim?.checked ? 1 : 0);
    });

    const kodeReseller = document.getElementById('kodeReseller')?.value;
    formData.append('kode_reseller', kodeReseller);

    fetch('/reseller/simpan-pengirim', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      alert(data.message || 'Data berhasil disimpan.');
      location.reload();
    })
    .catch(err => alert('Gagal menyimpan data.'));
  }
});

// Tombol buka modal pengirim
document.addEventListener('click', function (e) {
  if (e.target && e.target.classList.contains('btn-pengirim')) {
    const kode = e.target.dataset.kode;
    fetch(`/pemilik-dashboard/reseller/${kode}/pengirim`)
      .then(res => res.text())
      .then(html => {
        const existing = document.getElementById('pengirimModal');
        if (existing) existing.remove();

        const div = document.createElement('div');
        div.innerHTML = html;
        document.body.appendChild(div);

        const modalElement = document.getElementById('pengirimModal');
        const bsModal = new bootstrap.Modal(modalElement);
        bsModal.show();
      })
      .catch(err => alert('Gagal memuat data pengirim.'));
  }
});
</script>
