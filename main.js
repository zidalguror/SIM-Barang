const form = document.getElementById("form-barang");
const inputKode = document.getElementById("kode");
const inputJumlah = document.getElementById("jumlah");
const errKode = document.getElementById("err-kode");
const errJumlah = document.getElementById("err-jumlah");
const inputCari = document.getElementById("cari");
const toast = document.getElementById("toast");

form.addEventListener("submit", function (event) {
    event.preventDefault(); 

    let valid = true;

    const polaKode = /^BRG-\d+$/;
    if (!polaKode.test(inputKode.value.trim())) {
        errKode.textContent = 'Kode harus diawali "BRG-" lalu angka (contoh: BRG-001).';
        valid = false;
    } else {
        errKode.textContent = "";
    }

    const jumlah = Number(inputJumlah.value);
    if (inputJumlah.value === "" || isNaN(jumlah) || jumlah <= 0) {
        errJumlah.textContent = "Jumlah harus berupa angka lebih dari 0.";
        valid = false;
    } else {
        errJumlah.textContent = "";
    }

    if (valid) {
        tampilkanToast("Data barang berhasil divalidasi!");
        setTimeout(function () {
            form.submit();
        }, 800);
    }
});

inputCari.addEventListener("input", function () {
    const kataKunci = inputCari.value.toLowerCase();
    const baris = document.querySelectorAll("#inventaris tbody tr");

    baris.forEach(function (tr) {
        const teks = tr.textContent.toLowerCase();
        tr.style.display = teks.includes(kataKunci) ? "" : "none";
    });
});

function tampilkanToast(pesan) {
    toast.textContent = pesan;
    toast.classList.add("tampil");
    setTimeout(function () {
        toast.classList.remove("tampil");
    }, 3000);
}