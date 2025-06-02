<!-- Tambahkan di <head> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    /* Reset dan base */
    * {
        box-sizing: border-box;
    }
    body {
        font-family: 'Poppins', sans-serif;
        background: #f9fafb;
        margin: 0;
        padding: 2.5rem 1rem;
        color: #3b4252;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
        background: #fff;
        padding: 2rem 3rem;
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.07);
    }

    h3 {
    font-weight: 600;
    font-size: 1.9rem;
    color: #4f46e5;
    margin-bottom: 2rem;
    text-align: center;
    letter-spacing: 1.2px;
    animation: colorShift 8s ease-in-out infinite alternate;
}

/* Animasi warna elegan */
@keyframes colorShift {
    0% {
        color: #4f46e5; /* ungu */
        text-shadow: 0 0 8px rgba(79, 70, 229, 0.6);
    }
    25% {
        color: #3b82f6; /* biru */
        text-shadow: 0 0 8px rgba(59, 130, 246, 0.6);
    }
    50% {
        color: #14b8a6; /* teal */
        text-shadow: 0 0 8px rgba(20, 184, 166, 0.6);
    }
    75% {
        color: #22c55e; /* hijau cerah */
        text-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
    }
    100% {
        color: #4f46e5;
        text-shadow: 0 0 8px rgba(79, 70, 229, 0.6);
    }
}


    /* Button style */
    .btn {
        display: inline-block;
        font-weight: 600;
        padding: 0.55rem 1.8rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.9rem;
        user-select: none;
        border: none;
    }

    .btn-primary {
        background: #4f46e5;
        color: white;
        box-shadow: 0 4px 12px rgb(79 70 229 / 0.4);
    }
    .btn-primary:hover {
        background: #4338ca;
        box-shadow: 0 6px 20px rgb(67 56 202 / 0.6);
    }

    .btn-success {
        background: #22c55e;
        color: white;
        box-shadow: 0 4px 12px rgb(34 197 94 / 0.4);
    }
    .btn-success:hover {
        background: #16a34a;
        box-shadow: 0 6px 20px rgb(22 163 74 / 0.6);
    }

    .btn-danger {
        background: #ef4444;
        color: white;
        box-shadow: 0 4px 12px rgb(239 68 68 / 0.4);
    }
    .btn-danger:hover {
        background: #dc2626;
        box-shadow: 0 6px 20px rgb(220 38 38 / 0.6);
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.4rem 1.2rem;
    }

    /* Search form */
    form.d-flex {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    input.form-control {
        flex: 1 1 250px;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        border: 1.8px solid #d1d5db;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        outline-offset: 2px;
    }
    input.form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 8px rgba(79, 70, 229, 0.3);
    }

    /* Top bar for add button & search */
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 3rem;
    }

    /* Alert */
    .alert-danger {
        background-color: #fee2e2;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: #b91c1c;
        text-align: center;
        margin-bottom: 3rem;
        box-shadow: 0 4px 10px rgb(185 28 28 / 0.15);
    }

    /* Card grid */
    .row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    /* Card */
    .card {
        background: #fefefe;
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.07);
        padding: 1.8rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        opacity: 0;
        transform: translateY(40px);
        animation: fadeInUp 0.6s forwards;
    }
    .card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 14px 40px rgba(0,0,0,0.12);
    }
    .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 1.4rem;
        color: #1e293b;
        text-align: center;
    }

    .card-actions {
        display: flex;
        gap: 1rem;
        width: 100%;
        justify-content: center;
    }

    /* Animasi fade in card */
    <?php for($i=1; $i<=20; $i++): ?>
    .card:nth-child(<?= $i ?>) {
        animation-delay: <?= 0.1 * $i ?>s;
    }
    <?php endfor; ?>

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Toast Notification */
    #toast {
        position: fixed;
        top: 24px;
        right: 24px;
        background: linear-gradient(45deg, #22c55e, #65e89d);
        color: white;
        padding: 1rem 1.8rem;
        border-radius: 12px;
        box-shadow: 0 6px 22px rgba(34,197,94,0.6);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-20px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        font-weight: 600;
        z-index: 1050;
        user-select: none;
        font-size: 1rem;
    }
    #toast.show {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0);
    }

    /* Responsive tweak */
    @media (max-width: 480px) {
        .container {
            padding: 1.5rem 1.5rem;
        }
        h3 {
            font-size: 1.6rem;
        }
        .btn {
            padding: 0.45rem 1.2rem;
            font-size: 0.85rem;
        }
    }
</style>

<div class="container">
    <!-- Flash Message Data (hidden) -->
    <div id="flash-data" data-flashdata="<?= htmlspecialchars($this->session->flashdata('flash')); ?>"></div>

    <h3>Daftar Mahasiswa</h3>

    <div class="top-bar">
        <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary">Tambah Data Mahasiswa</a>
        <form class="d-flex" method="post" action="<?= base_url(); ?>mahasiswa/cari">
            <input class="form-control" type="search" name="keyword" placeholder="Cari data mahasiswa.." aria-label="Search" autocomplete="off" />
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <?php if (empty($mahasiswa)) : ?>
        <div class="alert alert-danger" role="alert">
            Data mahasiswa tidak ditemukan.
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($mahasiswa as $index => $mhs) : ?>
            <div class="card">
                <div class="card-title"><?= htmlspecialchars($mhs['nama']); ?></div>
                <div class="card-actions">
                    <a href="<?= base_url(); ?>mahasiswa/detail/<?= $mhs['id']; ?>" class="btn btn-sm btn-primary" title="Detail">Detail</a>
                    <a href="<?= base_url(); ?>mahasiswa/ubah/<?= $mhs['id']; ?>" class="btn btn-sm btn-success" title="Ubah">Ubah</a>
                    <a href="<?= base_url(); ?>mahasiswa/hapus/<?= $mhs['id']; ?>" class="btn btn-sm btn-danger tombol-hapus" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const flashData = document.getElementById('flash-data').dataset.flashdata;
        const toast = document.getElementById('toast');

        if (flashData) {
            toast.textContent = flashData;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });
</script>
