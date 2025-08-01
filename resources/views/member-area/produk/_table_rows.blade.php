@forelse($products ?? [] as $i => $product)
@php
    $isPulsaBaris = isset($product->kategori_nama) && $product->kategori_nama == "Pulsa";
@endphp
<tr class="align-middle">
    <td>{{ $i + 1 }}</td>
    <td>{{ $product->kode }}</td>
    <td>{{ $product->nama }}</td>
    <td>
        @if($isPulsaBaris)
            Pulsa
        @elseif(isset($product->category))
            {{ $product->category->nama ?? '-' }}
        @else
            -
        @endif
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge text-bg-info">{{ $product->stok ?? 0 }}</span>
    </td>
    <td class="d-none d-sm-table-cell">
        @if(isset($product->harga_beli))
            {{ number_format($product->harga_beli, 0, ',', '.') }}
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td class="d-none d-sm-table-cell">
        @if(isset($product->harga_jual))
            {{ number_format($product->harga_jual, 0, ',', '.') }}
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
    <td>
        <button
            type="button"
            class="btn btn-sm btn-warning btn-edit-produk"
            data-type="{{ $isPulsaBaris ? 'pulsa' : 'produk' }}"
            data-kode="{{ $product->kode }}"
            data-nama="{{ $product->nama }}"
            data-stok="{{ $product->stok ?? 0 }}"
            data-harga-jual="{{ $product->harga_jual ?? '' }}"
            data-deskripsi="{{ $product->deskripsi ?? '' }}"
            data-id="{{ $product->id ?? '' }}"
            data-harga-beli="{{ $product->harga_beli ?? '' }}"
            data-category-id="{{ $product->category->id ?? '' }}"
            data-barcode="{{ $product->barcode ?? '' }}"
        >
            <i class="bi bi-pencil"></i> Edit
        </button>

        @if ($product->id)
            <button
                type="button"
                class="btn btn-sm btn-info text-white"
                onclick="showRiwayatStok({{ $product->id }})"
            >
                <i class="bi bi-box-arrow-in-down"></i> Riwayat Stok
            </button>
        @endif

    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center">Tidak ditemukan hasil.</td>
</tr>
@endforelse