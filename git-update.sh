#!/bin/bash

# 🚀 Script: git-update.sh
# Tujuan: Push update dengan aman tanpa .env ikut terbawa ke GitHub

# Cek jika tidak ada pesan commit
if [ -z "$1" ]; then
  echo "❌ Harap masukkan pesan commit!"
  echo "   Contoh: ./git-update.sh \"Perbaikan backup dan pelanggan\""
  exit 1
fi

echo "📌 Menghapus .env dari staging (jika ada)..."
git rm --cached .env 2>/dev/null

echo "📦 Menambahkan semua file ke staging..."
git add .

echo "📝 Commit dengan pesan: $1"
git commit -m "$1"

echo "🚀 Push ke origin/main..."
git push origin main

echo "✅ Selesai! Perubahan berhasil dikirim ke GitHub."
