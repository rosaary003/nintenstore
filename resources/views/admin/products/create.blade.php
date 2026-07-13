@extends('admin.layouts.app')

@section('content')

<style>
    .page-header {
        margin-bottom: 30px;
        animation: fadeForm 0.6s ease;
    }

    .page-header h1 {
        margin: 0 0 8px;
    }

    .page-header p {
        margin: 0;
        color: #777;
    }

    .form-card {
        max-width: 800px;
        background: white;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        animation: fadeForm 0.8s ease;

        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease;
    }

    .form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.12);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        outline: none;

        transition:
            border 0.3s ease,
            box-shadow 0.3s ease,
            transform 0.3s ease;
    }

    input:focus,
    textarea:focus {
        border-color: #e60012;
        box-shadow: 0 0 0 3px rgba(230, 0, 18, 0.1);
        transform: translateY(-2px);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    input[type="file"] {
        background: #f8f8f8;
        cursor: pointer;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 25px;
    }

    .save {
        background: #e60012;
        color: white;
        border: none;
        padding: 13px 22px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;

        transition:
            transform 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease;
    }

    .save:hover {
        background: #b8000e;
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(230, 0, 18, 0.25);
    }

    .save:active {
        transform: scale(0.97);
    }

    .back {
        color: #e60012;
        text-decoration: none;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .back:hover {
        transform: translateX(-4px);
    }

    @keyframes fadeForm {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


<div class="page-header">

    <h1>Tambah Produk 🎮</h1>

    <p>
        Tambahkan produk game baru ke NintenStore.
    </p>

</div>


<div class="form-card">

    <form
        action="{{ route('admin.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="form-group">

            <label>Nama Produk</label>

            <input
                type="text"
                name="name"
                placeholder="Masukkan nama produk"
                required
            >

        </div>


        <div class="form-group">

            <label>Kategori</label>

            <input
                type="text"
                name="category"
                placeholder="Contoh: Adventure"
                required
            >

        </div>


        <div class="form-group">

            <label>Harga</label>

            <input
                type="number"
                name="price"
                placeholder="Masukkan harga produk"
                required
            >

        </div>


        <div class="form-group">

            <label>Stok</label>

            <input
                type="number"
                name="stock"
                placeholder="Masukkan jumlah stok"
                required
            >

        </div>


        <div class="form-group">

            <label>Deskripsi</label>

            <textarea
                name="description"
                placeholder="Masukkan deskripsi produk"
            ></textarea>
          </div>


        <div class="form-group">

            <label>Gambar Produk</label>

            <input
                type="file"
                name="image"
                accept="image/*"
            >

        </div>


        <div class="actions">

            <button
                type="submit"
                class="save"
            >
                Simpan Produk
            </button>

            <a
                href="{{ route('admin.products.index') }}"
                class="back"
            >
                ← Kembali
            </a>

        </div>

    </form>

</div>

@endsection  