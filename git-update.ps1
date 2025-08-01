param (
    [string]$Message = ""
)

if ([string]::IsNullOrWhiteSpace($Message)) {
    Write-Host "Harap isi pesan commit."
    Write-Host "Contoh: ./git-update.ps1 -Message 'Perbaikan pelanggan dan backup'"
    exit
}

Write-Host "Menambahkan semua file ke staging..."
git add .

Write-Host "Menghapus .env dari staging (jika ada)..."
git rm --cached .env 2>$null

Write-Host "Melakukan commit dengan pesan: $Message"
git commit -m "$Message"

Write-Host "Push ke origin/main..."
git push origin main

Write-Host "Selesai! Perubahan berhasil dikirim ke GitHub."
