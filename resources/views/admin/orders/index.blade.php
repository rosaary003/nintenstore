@extends('admin.layouts.app')

@section('content')

<style>
    .page-header {
        margin-bottom: 30px;
        animation: fadeOrder 0.6s ease;
    }

    .page-header h1 {
        margin: 0 0 8px;
    }

    .page-header p {
        margin: 0;
        color: #777;
    }

    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 14px 18px;
        margin-bottom: 22px;
        border-radius: 8px;
        border-left: 5px solid #28a745;
        animation: popMessage 0.5s ease;
    }

    .order-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
        animation: fadeOrder 0.8s ease;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        color: #777;
        font-size: 14px;
    }

    tbody tr {
        transition:
            transform 0.3s ease,
            background 0.3s ease;
    }

    tbody tr:hover {
        background: #fff5f6;
        transform: translateX(5px);
    }

    .order-id {
        color: #e60012;
        font-weight: bold;
    }

    .price {
        color: #e60012;
        font-weight: bold;
    }

    .payment {
        display: inline-block;
        background: #f1f1f1;
        padding: 7px 12px;
        border-radius: 20px;
        font-weight: bold;
    }

    .status-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 7px;
        outline: none;
        cursor: pointer;

        transition:
            border 0.3s ease,
            box-shadow 0.3s ease,
            transform 0.3s ease;
    }

    .status-select:focus {
        border-color: #e60012;
        box-shadow: 0 0 0 3px rgba(230, 0, 18, 0.1);
        transform: translateY(-2px);
    }

    .update-button {
        background: #e60012;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 7px;
        font-weight: bold;
        cursor: pointer;

        transition:
            transform 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease;
    }

    .update-button:hover {
        background: #b8000e;
        transform: translateY(-3px);
        box-shadow: 0 7px 15px rgba(230, 0, 18, 0.25);
    }

    .update-button:active {
        transform: scale(0.96);
    }

    .empty {
        text-align: center;
        padding: 40px;
        color: #777;
    }

    .empty-icon {
        font-size: 42px;
        margin-bottom: 10px;
        animation: floatIcon 2s ease-in-out infinite;
    }

    @keyframes fadeOrder {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes popMessage {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes floatIcon {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-7px);
        }
    }
</style>


<div class="page-header">

    <h1>Pesanan Masuk 📦</h1>

    <p>
        Pantau dan perbarui status pesanan pelanggan.
    </p>

</div>


@if(session('success'))

    <div class="success-message">
        ✓ {{ session('success') }}
    </div>

@endif


<div class="order-card">

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Status</th>
            </tr>

        </thead>


        <tbody>

            @forelse($orders as $order)

                <tr>

                    <td class="order-id">
                        #{{ $order->id }}
                    </td>

                    <td>
                        <strong>
                            {{ $order->name }}
                        </strong>
                    </td>

                    <td class="price">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>

                    <td>

                        <span class="payment">
                            {{ $order->payment_method }}
                        </span>

                    </td>

                    <td>

                        <form
                            action="{{ route('admin.orders.status', $order->id) }}"
                            method="POST"
                            class="status-form"
                        >

                            @csrf

                            <select
                                name="status"
                                class="status-select"
                            >

                                <option
                                    value="Menunggu Pembayaran"
                                    {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}
                                >
                                    Menunggu Pembayaran
                                </option>

                                <option
                                    value="Sudah Dibayar"
                                    {{ $order->status == 'Sudah Dibayar' ? 'selected' : '' }}
                                >
                                    Sudah Dibayar
                                </option>

                                <option
                                    value="Diproses"
                                    {{ $order->status == 'Diproses' ? 'selected' : '' }}
                                >
                                    Diproses
                                </option>

                                <option
                                    value="Selesai"
                                    {{ $order->status == 'Selesai' ? 'selected' : '' }}
                                >
                                    Selesai
                                </option>

                            </select>


                            <button
                                type="submit"
                                class="update-button"
                            >
                                Update
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="empty">

                        <div class="empty-icon">
                            📦
                        </div>

                        Belum ada pesanan.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection