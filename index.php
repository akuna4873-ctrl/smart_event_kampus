<?php
require_once __DIR__ . '/../config/database.php';

$conn = getConnection();

$totalEvent = $conn->query("SELECT COUNT(*) as c FROM events")->fetch_assoc()['c'];
$totalAkanDatang = $conn->query("SELECT COUNT(*) as c FROM events WHERE status='Akan Datang'")->fetch_assoc()['c'];
$totalBerlangsung = $conn->query("SELECT COUNT(*) as c FROM events WHERE status='Berlangsung'")->fetch_assoc()['c'];
$totalSelesai = $conn->query("SELECT COUNT(*) as c FROM events WHERE status='Selesai'")->fetch_assoc()['c'];

$eventTerbaru = $conn->query("SELECT * FROM events ORDER BY created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);

$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';
require_once __DIR__ . '/../includes/header_dashboard.php';
?>

<div class="summary-grid">
    <div class="summary-card">
        <div class="summary-icon">📅</div>
        <div>
            <div class="num"><?= $totalEvent ?></div>
            <div class="label">Total Event</div>
        </div>
    </div>
    <div class="summary-card c2">
        <div class="summary-icon">⏳</div>
        <div>
            <div class="num"><?= $totalAkanDatang ?></div>
            <div class="label">Akan Datang</div>
        </div>
    </div>
    <div class="summary-card c3">
        <div class="summary-icon">🔥</div>
        <div>
            <div class="num"><?= $totalBerlangsung ?></div>
            <div class="label">Berlangsung</div>
        </div>
    </div>
    <div class="summary-card c4">
        <div class="summary-icon">✅</div>
        <div>
            <div class="num"><?= $totalSelesai ?></div>
            <div class="label">Selesai</div>
        </div>
    </div>
</div>

<div class="card-panel">
    <div class="table-toolbar">
        <h2>Event Terbaru Ditambahkan</h2>
        <a href="<?= base_url('dashboard/event_add.php') ?>" class="btn btn-primary btn-sm">➕ Tambah Event</a>
    </div>

    <?php if (empty($eventTerbaru)): ?>
        <div class="empty-state">
            <div class="icon">🗓️</div>
            <p>Belum ada data event. Yuk mulai tambahkan event pertama kamu!</p>
        </div>
    <?php else: ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventTerbaru as $e): ?>
            <tr>
                <td><?= clean($e['judul']) ?></td>
                <td><?= clean($e['kategori']) ?></td>
                <td><?= date('d M Y', strtotime($e['tanggal_event'])) ?></td>
                <td><span class="status-badge status-<?= strtolower(str_replace(' ','-',$e['status'])) ?>"><?= clean($e['status']) ?></span></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php
$conn->close();
require_once __DIR__ . '/../includes/footer_dashboard.php';
?>
