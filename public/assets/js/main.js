// Mendapatkan elemen-elemen yang diperlukan
const successAlert = document.getElementById('successAlert');
const closeButton = document.getElementById('closeButton');

// Menambahkan event listener untuk menutup pesan saat tombol close diklik
closeButton.addEventListener('click', function () {
    successAlert.style.display = 'none'; // Menyembunyikan pesan
});

function updateTable() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var table = document.getElementById("table1");
    var rows = table.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var groupID = rows[i].getAttribute("data-group-id");
        var isVisible = false;

        if (groupID) {
            var groupRows = document.querySelectorAll('tr[data-group-id="' + groupID + '"]');

            for (var j = 0; j < groupRows.length; j++) {
                var groupCells = groupRows[j].getElementsByTagName("td");

                for (var k = 0; k < groupCells.length; k++) {
                    var cellText = groupCells[k].textContent || groupCells[k].innerText;

                    if (cellText.toUpperCase().indexOf(input) > -1) {
                        isVisible = true;
                        break;
                    }
                }
            }

            for (var j = 0; j < groupRows.length; j++) {
                groupRows[j].style.display = isVisible ? "" : "none";
            }
        }
    }
}

function updateSurat(groupId) {
    const suratKetuaInput = document.querySelector(`input[name="surat_ketua"][data-group-id="${groupId}"]`);
    const suratKetua = suratKetuaInput ? suratKetuaInput.value : '';

    const suratAnggotaInputs = Array.from(document.querySelectorAll(`input[name="surat_anggota[]"][data-group-id="${groupId}"]`));
    const suratAnggota = suratAnggotaInputs.map(input => input.value);

    // Send an AJAX request to update the recommendations in the controller
    axios.put(`/admin-magang-dinkopdag/update_suket/${groupId}`, {
        surat_ketua: suratKetua,
        surat_anggota: suratAnggota,
    })
    .then(response => {
        // Handle the response, e.g., show a success message
        alert('Rekomendasi berhasil diperbarui!');
    })
    .catch(error => {
        // Handle any errors
        console.error('Kesalahan saat memperbarui rekomendasi:', error);
    });
}

function updateBidang(event, id, role) {
    const selectedValue = event.target.value;
    const url = role === 'ketua' ? `/admin-magang-dinkopdag/bidangKetua/${id}` : `/admin-magang-dinkopdag/bidangAnggota/${id}`;

    axios.put(url, {
        new_bidang: selectedValue
    })
    .then(response => {
        // Handle the response, e.g., show a success message
        alert('Bidang berhasil diperbarui!');
    })
    .catch(error => {
        // Handle any errors
        console.error('Kesalahan saat memperbarui bidang:', error);
    });
}

