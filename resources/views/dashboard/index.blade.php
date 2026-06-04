<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIPAS RS — Dashboard Pasien</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    /* SINDIKAT color palette */
    --crimson:      #8b1a1a;
    --crimson-dark: #6b1010;
    --crimson-deep: #4a0a0a;
    --crimson-mid:  #a52020;
    --crimson-lite: #c0392b;
    --rose:         #e8c4c4;
    --rose-pale:    #f5e8e8;
    --rose-mid:     #d4a0a0;
    --cream:        #fdf5f5;
    --sand:         #f0e0e0;
    --charcoal:     #2a0f0f;
    --muted:        #7a4040;
    --white:        #ffffff;
    --danger:       #c0392b;
    --amber:        #c97b2e;
    --green:        #2e7d52;
    --border:       #e8cece;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    color: var(--charcoal);
    min-height: 100vh;
    display: flex;
  }

  /* SIDEBAR */
  .sidebar {
    width: 260px;
    background: linear-gradient(180deg, var(--crimson-deep) 0%, var(--crimson-dark) 60%, #5a0e0e 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0; top: 0; bottom: 0;
    z-index: 100;
  }

  .sidebar-logo {
    padding: 28px 24px 24px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .logo-tag {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2.5px;
    color: var(--rose);
    text-transform: uppercase;
    margin-bottom: 4px;
  }

  .logo-name {
    font-family: 'DM Serif Display', serif;
    font-size: 22px;
    color: var(--white);
    line-height: 1.2;
  }

  .logo-sub {
    font-size: 11px;
    color: rgba(255,255,255,0.4);
    margin-top: 3px;
  }

  .nav { padding: 20px 0; flex: 1; }

  .nav-section-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.25);
    text-transform: uppercase;
    padding: 12px 24px 6px;
  }

  .nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 24px;
    cursor: pointer;
    transition: all 0.2s;
    color: rgba(255,255,255,0.55);
    font-size: 14px;
    font-weight: 400;
    border-left: 3px solid transparent;
    text-decoration: none;
  }

  .nav-item:hover {
    background: rgba(255,255,255,0.07);
    color: rgba(255,255,255,0.9);
  }

  .nav-item.active {
    background: rgba(192,57,43,0.35);
    color: var(--rose);
    border-left-color: var(--rose);
    font-weight: 500;
  }

  .nav-icon { font-size: 17px; width: 20px; text-align: center; }

  .nav-badge {
    margin-left: auto;
    background: var(--crimson-lite);
    color: white;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 7px;
    border-radius: 20px;
  }

  .sidebar-bottom {
    padding: 20px 24px;
    border-top: 1px solid rgba(255,255,255,0.08);
  }

  .patient-mini { display: flex; align-items: center; gap: 12px; }

  .avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--crimson), var(--crimson-lite));
    display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 600; font-size: 14px;
    border: 2px solid rgba(255,255,255,0.2);
    flex-shrink: 0;
  }

  .patient-mini-name { font-size: 13px; color: var(--white); font-weight: 500; }
  .patient-mini-id { font-size: 11px; color: rgba(255,255,255,0.35); margin-top: 1px; }

  /* MAIN */
  .main { margin-left: 260px; flex: 1; min-height: 100vh; }

  /* TOPBAR */
  .topbar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 0 32px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
  }

  .topbar-left h1 {
    font-family: 'DM Serif Display', serif;
    font-size: 20px;
    color: var(--charcoal);
    font-style: italic;
  }

  .topbar-left p { font-size: 12px; color: var(--muted); margin-top: 1px; }

  .topbar-right { display: flex; align-items: center; gap: 16px; }

  .notif-btn {
    width: 38px; height: 38px;
    border-radius: 10px;
    background: var(--rose-pale);
    border: none;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    position: relative;
    transition: background 0.2s;
  }

  .notif-btn:hover { background: var(--rose); }

  .notif-dot {
    position: absolute;
    top: 7px; right: 7px;
    width: 8px; height: 8px;
    background: var(--crimson-lite);
    border-radius: 50%;
    border: 2px solid white;
  }

  .date-chip {
    font-size: 12px;
    color: var(--muted);
    background: var(--sand);
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 500;
  }

  /* CONTENT */
  .content { padding: 28px 32px; }

  /* PROFIL PASIEN */
  .profile-card {
    background: linear-gradient(135deg, var(--crimson-dark) 0%, var(--crimson-deep) 100%);
    border-radius: 20px;
    padding: 28px 32px;
    display: flex;
    align-items: center;
    gap: 28px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
  }

  .profile-card::before {
    content: '';
    position: absolute;
    right: -40px; top: -40px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
  }

  .profile-card::after {
    content: '';
    position: absolute;
    right: 60px; bottom: -60px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
  }

  /* Wave decoration like SINDIKAT */
  .profile-card .wave-deco {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 30px;
    background: rgba(232,196,196,0.08);
    border-radius: 60% 60% 0 0 / 30px 30px 0 0;
  }

  .profile-avatar {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: white;
    font-family: 'DM Serif Display', serif;
    border: 3px solid rgba(255,255,255,0.25);
    flex-shrink: 0;
  }

  .profile-info { flex: 1; }

  .profile-name {
    font-family: 'DM Serif Display', serif;
    font-size: 24px;
    color: white;
    margin-bottom: 4px;
  }

  .profile-meta { display: flex; gap: 20px; flex-wrap: wrap; }

  .meta-item { font-size: 12.5px; color: rgba(255,255,255,0.7); }

  .meta-item strong {
    color: rgba(255,255,255,0.45);
    font-weight: 500;
    display: block;
    font-size: 11px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 1px;
  }

  .profile-stats {
    display: flex;
    gap: 1px;
    background: rgba(255,255,255,0.1);
    border-radius: 14px;
    overflow: hidden;
  }

  .stat-item { padding: 14px 22px; text-align: center; background: rgba(255,255,255,0.06); }

  .stat-num {
    font-family: 'DM Serif Display', serif;
    font-size: 24px;
    color: white;
  }

  .stat-label { font-size: 10.5px; color: rgba(255,255,255,0.5); margin-top: 2px; white-space: nowrap; }

  /* GRID */
  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
  .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; }

  /* CARDS */
  .card {
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    overflow: hidden;
  }

  .card-header {
    padding: 18px 22px 14px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .card-title {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--charcoal);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .card-icon {
    width: 28px; height: 28px;
    border-radius: 8px;
    background: var(--rose-pale);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
  }

  .card-action {
    font-size: 12px;
    color: var(--crimson);
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
  }

  .card-action:hover { text-decoration: underline; }

  .card-body { padding: 18px 22px; }

  /* ANTRIAN */
  .antrian-hero {
    background: linear-gradient(135deg, #fff5f5, #fde8e8);
    border: 1px solid #f0c0c0;
    border-radius: 16px;
    padding: 22px 26px;
    display: flex;
    align-items: center;
    gap: 22px;
    margin-bottom: 20px;
  }

  .antrian-number {
    font-family: 'DM Serif Display', serif;
    font-size: 64px;
    color: var(--crimson);
    line-height: 1;
    flex-shrink: 0;
  }

  .antrian-info h3 { font-size: 14px; font-weight: 600; color: var(--charcoal); margin-bottom: 4px; }
  .antrian-info p { font-size: 13px; color: var(--muted); margin-bottom: 8px; }

  .antrian-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    color: var(--crimson);
    background: rgba(139,26,26,0.10);
    padding: 4px 12px;
    border-radius: 20px;
  }

  .pulse-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--crimson);
    animation: pulse 1.5s infinite;
  }

  @keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.8); }
  }

  .antrian-meta { margin-left: auto; text-align: right; }

  .antrian-current {
    font-family: 'DM Serif Display', serif;
    font-size: 38px;
    color: var(--charcoal);
  }

  .antrian-meta p { font-size: 11px; color: var(--muted); }

  .antrian-progress {
    margin-top: 12px;
    background: var(--border);
    height: 5px;
    border-radius: 99px;
    overflow: hidden;
  }

  .antrian-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, var(--crimson-dark), var(--crimson-lite));
    border-radius: 99px;
    width: 70%;
    animation: progressAnim 2s ease-in-out infinite alternate;
  }

  @keyframes progressAnim {
    from { opacity: 0.8; }
    to { opacity: 1; }
  }

  /* JADWAL */
  .jadwal-item {
    display: flex;
    gap: 16px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
    align-items: flex-start;
  }

  .jadwal-item:last-child { border-bottom: none; padding-bottom: 0; }
  .jadwal-item:first-child { padding-top: 0; }

  .jadwal-date {
    width: 44px; height: 50px;
    background: var(--rose-pale);
    border-radius: 12px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    flex-shrink: 0;
  }

  .jadwal-day { font-size: 18px; font-family: 'DM Serif Display', serif; color: var(--crimson); line-height: 1; }
  .jadwal-mon { font-size: 9px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: var(--crimson); opacity: 0.7; }

  .jadwal-detail { flex: 1; }
  .jadwal-dokter { font-size: 13.5px; font-weight: 600; color: var(--charcoal); margin-bottom: 2px; }
  .jadwal-poli { font-size: 12px; color: var(--muted); margin-bottom: 6px; }
  .jadwal-chips { display: flex; gap: 6px; flex-wrap: wrap; }

  .chip { font-size: 11px; padding: 3px 10px; border-radius: 20px; font-weight: 500; }
  .chip-crimson { background: var(--rose-pale); color: var(--crimson); }
  .chip-green { background: #e6f4ec; color: var(--green); }
  .chip-amber { background: #fef3e2; color: var(--amber); }
  .chip-red { background: #fdecea; color: var(--danger); }
  .chip-gray { background: var(--sand); color: var(--muted); }

  /* RIWAYAT */
  .riwayat-item {
    display: flex;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
    align-items: center;
  }

  .riwayat-item:last-child { border-bottom: none; }
  .riwayat-item:first-child { padding-top: 0; }

  .riwayat-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
  }

  .ri-crimson { background: var(--rose-pale); }
  .ri-amber { background: #fef3e2; }
  .ri-green { background: #e6f4ec; }

  .riwayat-detail { flex: 1; }
  .riwayat-title { font-size: 13px; font-weight: 600; color: var(--charcoal); margin-bottom: 2px; }
  .riwayat-sub { font-size: 11.5px; color: var(--muted); }
  .riwayat-date { font-size: 11px; color: var(--muted); text-align: right; white-space: nowrap; }

  /* REKAM MEDIS */
  .rekam-item { padding: 13px 0; border-bottom: 1px solid var(--border); }
  .rekam-item:last-child { border-bottom: none; }
  .rekam-item:first-child { padding-top: 0; }

  .rekam-row { display: flex; justify-content: space-between; align-items: flex-start; }
  .rekam-diagnosa { font-size: 13px; font-weight: 600; color: var(--charcoal); margin-bottom: 3px; }

  .rekam-icd {
    font-size: 10px;
    background: var(--sand);
    color: var(--muted);
    padding: 2px 8px;
    border-radius: 6px;
    font-weight: 600;
    letter-spacing: 0.5px;
  }

  .rekam-detail { font-size: 11.5px; color: var(--muted); margin-top: 4px; line-height: 1.5; }

  /* RESEP */
  .resep-card {
    background: var(--rose-pale);
    border-radius: 12px;
    padding: 14px 16px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .resep-card:last-child { margin-bottom: 0; }
  .resep-icon { font-size: 22px; flex-shrink: 0; }
  .resep-name { font-size: 13.5px; font-weight: 600; color: var(--charcoal); margin-bottom: 2px; }
  .resep-info { font-size: 12px; color: var(--muted); }
  .resep-qty { margin-left: auto; text-align: right; flex-shrink: 0; }

  .resep-count {
    font-family: 'DM Serif Display', serif;
    font-size: 22px;
    color: var(--crimson);
    line-height: 1;
  }

  .resep-unit { font-size: 10px; color: var(--muted); }

  /* NOTIFIKASI */
  .notif-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
    position: relative;
  }

  .notif-item:last-child { border-bottom: none; }
  .notif-item:first-child { padding-top: 0; }

  .notif-dot-indicator {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--crimson-lite);
    margin-top: 5px;
    flex-shrink: 0;
  }

  .notif-item.read .notif-dot-indicator { background: var(--border); }

  .notif-content { flex: 1; }
  .notif-title { font-size: 13px; font-weight: 600; color: var(--charcoal); margin-bottom: 2px; }
  .notif-item.read .notif-title { font-weight: 400; color: var(--muted); }
  .notif-msg { font-size: 12px; color: var(--muted); line-height: 1.5; }
  .notif-time { font-size: 10.5px; color: var(--muted); white-space: nowrap; margin-top: 2px; }

  /* SECTION LABEL */
  .section-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 14px;
    margin-top: 8px;
  }

  /* ANIMATIONS */
  .fade-in {
    opacity: 0;
    transform: translateY(12px);
    animation: fadeIn 0.5s ease forwards;
  }

  .fade-in:nth-child(1) { animation-delay: 0.05s; }
  .fade-in:nth-child(2) { animation-delay: 0.1s; }
  .fade-in:nth-child(3) { animation-delay: 0.15s; }
  .fade-in:nth-child(4) { animation-delay: 0.2s; }
  .fade-in:nth-child(5) { animation-delay: 0.25s; }
  .fade-in:nth-child(6) { animation-delay: 0.3s; }

  @keyframes fadeIn {
    to { opacity: 1; transform: translateY(0); }
  }

  ::-webkit-scrollbar { width: 5px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

  @media (max-width: 1100px) { .grid-3 { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 860px) {
    .grid-2, .grid-3 { grid-template-columns: 1fr; }
    .profile-stats { display: none; }
    .sidebar { width: 220px; }
    .main { margin-left: 220px; }
    .content { padding: 20px; }
  }
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-tag">RSUD Simpang Lima Gumul</div>
    <div class="logo-name">SIPAS</div>
    <div class="logo-sub">Sistem Informasi Pasien</div>
  </div>

  <nav class="nav">
    <div class="nav-section-label">Menu Utama</div>
    <a href="#" class="nav-item active">
      <span class="nav-icon">🏠</span> Dashboard
    </a>
    <a href="#" class="nav-item">
      <span class="nav-icon">👤</span> Profil Saya
    </a>
    <a href="#" class="nav-item">
      <span class="nav-icon">📅</span> Jadwal Konsultasi
    </a>

    <div class="nav-section-label">Rekam Medis</div>
    <a href="#" class="nav-item">
      <span class="nav-icon">🏥</span> Riwayat Kunjungan
    </a>
    <a href="#" class="nav-item">
      <span class="nav-icon">📋</span> Rekam Medis
    </a>
    <a href="#" class="nav-item">
      <span class="nav-icon">💊</span> Resep Obat
    </a>

    <div class="nav-section-label">Layanan</div>
    <a href="#" class="nav-item">
      <span class="nav-icon">🎫</span> Antrian Hari Ini
    </a>
    <a href="#" class="nav-item">
      <span class="nav-icon">🔔</span> Notifikasi
      <span class="nav-badge">3</span>
    </a>
    <a href="#" class="nav-item">
      <span class="nav-icon">💬</span> Hubungi RS
    </a>
  </nav>

  <div class="sidebar-bottom">
    <div class="patient-mini">
      <div class="avatar">AS</div>
      <div>
        <div class="patient-mini-name">Andi Saputra</div>
        <div class="patient-mini-id">RM-2024-00142</div>
      </div>
    </div>
  </div>
</aside>

<!-- MAIN -->
<main class="main">
  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-left">
      <h1>Selamat Pagi, Andi</h1>
      <p>Semoga sehat selalu 🌿</p>
    </div>
    <div class="topbar-right">
      <div class="date-chip">📅 Rabu, 4 Juni 2025</div>
      <button class="notif-btn">
        🔔
        <span class="notif-dot"></span>
      </button>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- PROFIL PASIEN -->
    <div class="profile-card fade-in">
      <div class="wave-deco"></div>
      <div class="profile-avatar">AS</div>
      <div class="profile-info">
        <div class="profile-name">Andi Saputra</div>
        <div class="profile-meta">
          <div class="meta-item"><strong>No. RM</strong>RM-2024-00142</div>
          <div class="meta-item"><strong>Tgl. Lahir</strong>14 Maret 1985 (40 th)</div>
          <div class="meta-item"><strong>Gol. Darah</strong>O+</div>
          <div class="meta-item"><strong>Asuransi</strong>BPJS · 0001234567890</div>
          <div class="meta-item"><strong>Penyakit Kronis</strong>Hipertensi</div>
        </div>
      </div>
      <div class="profile-stats">
        <div class="stat-item">
          <div class="stat-num">12</div>
          <div class="stat-label">Total Kunjungan</div>
        </div>
        <div class="stat-item">
          <div class="stat-num">3</div>
          <div class="stat-label">Resep Aktif</div>
        </div>
        <div class="stat-item">
          <div class="stat-num">1</div>
          <div class="stat-label">Jadwal Mendatang</div>
        </div>
      </div>
    </div>

    <!-- ANTRIAN HARI INI -->
    <div class="section-label fade-in">🎫 Antrian Hari Ini</div>
    <div class="antrian-hero fade-in">
      <div class="antrian-number">A-47</div>
      <div class="antrian-info">
        <h3>Poli Penyakit Dalam</h3>
        <p>dr. Budi Santoso, Sp.PD · Lantai 2, Ruang 204</p>
        <div class="antrian-status">
          <div class="pulse-dot"></div>
          Sedang berlangsung · Estimasi 20 mnt lagi
        </div>
        <div class="antrian-progress">
          <div class="antrian-progress-bar"></div>
        </div>
      </div>
      <div class="antrian-meta">
        <div class="antrian-current">A-40</div>
        <p>Nomor antrian saat ini</p>
        <p style="margin-top:4px;">Menunggu: <strong>7 orang</strong></p>
      </div>
    </div>

    <!-- GRID: JADWAL + NOTIFIKASI -->
    <div class="grid-2 fade-in">

      <!-- JADWAL KONSULTASI -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="card-icon">📅</div>
            Jadwal Konsultasi
          </div>
          <a href="#" class="card-action">Buat jadwal →</a>
        </div>
        <div class="card-body">

          <div class="jadwal-item">
            <div class="jadwal-date">
              <div class="jadwal-day">4</div>
              <div class="jadwal-mon">Jun</div>
            </div>
            <div class="jadwal-detail">
              <div class="jadwal-dokter">dr. Budi Santoso, Sp.PD</div>
              <div class="jadwal-poli">Poli Penyakit Dalam</div>
              <div class="jadwal-chips">
                <span class="chip chip-amber">⏰ 10:00 WIB</span>
                <span class="chip chip-green">✅ Terkonfirmasi</span>
                <span class="chip chip-gray">BPJS</span>
              </div>
            </div>
          </div>

          <div class="jadwal-item">
            <div class="jadwal-date">
              <div class="jadwal-day">18</div>
              <div class="jadwal-mon">Jun</div>
            </div>
            <div class="jadwal-detail">
              <div class="jadwal-dokter">dr. Rina Kusuma, Sp.JP</div>
              <div class="jadwal-poli">Poli Jantung & Pembuluh Darah</div>
              <div class="jadwal-chips">
                <span class="chip chip-crimson">⏰ 13:30 WIB</span>
                <span class="chip chip-amber">🕐 Menunggu Konfirmasi</span>
              </div>
            </div>
          </div>

          <div class="jadwal-item">
            <div class="jadwal-date">
              <div class="jadwal-day">2</div>
              <div class="jadwal-mon">Jul</div>
            </div>
            <div class="jadwal-detail">
              <div class="jadwal-dokter">dr. Hendra Wijaya, Sp.PD</div>
              <div class="jadwal-poli">Poli Penyakit Dalam · Kontrol Rutin</div>
              <div class="jadwal-chips">
                <span class="chip chip-crimson">⏰ 09:00 WIB</span>
                <span class="chip chip-gray">BPJS</span>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- NOTIFIKASI -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="card-icon">🔔</div>
            Notifikasi RS
            <span class="chip chip-red">3 baru</span>
          </div>
          <a href="#" class="card-action">Lihat semua</a>
        </div>
        <div class="card-body" style="padding-left: 30px;">

          <div class="notif-item unread">
            <div class="notif-dot-indicator"></div>
            <div class="notif-content">
              <div class="notif-title">⚕️ Hasil Lab Tersedia</div>
              <div class="notif-msg">Hasil pemeriksaan darah lengkap Anda sudah dapat diunduh di menu Rekam Medis.</div>
              <div class="notif-time">5 menit lalu</div>
            </div>
          </div>

          <div class="notif-item unread">
            <div class="notif-dot-indicator"></div>
            <div class="notif-content">
              <div class="notif-title">💊 Pengingat Minum Obat</div>
              <div class="notif-msg">Jadwal minum Amlodipine 5mg pukul 08:00 WIB. Jangan lupa ya!</div>
              <div class="notif-time">2 jam lalu</div>
            </div>
          </div>

          <div class="notif-item unread">
            <div class="notif-dot-indicator"></div>
            <div class="notif-content">
              <div class="notif-title">📅 Konfirmasi Jadwal</div>
              <div class="notif-msg">Jadwal konsultasi dengan dr. Budi hari ini pukul 10:00 sudah dikonfirmasi.</div>
              <div class="notif-time">Kemarin, 16:30</div>
            </div>
          </div>

          <div class="notif-item read">
            <div class="notif-dot-indicator"></div>
            <div class="notif-content">
              <div class="notif-title">🏥 Info Layanan RS</div>
              <div class="notif-msg">Poli Gigi tutup pada 5-6 Juni 2025 untuk renovasi ruangan.</div>
              <div class="notif-time">2 hari lalu</div>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- GRID: RIWAYAT + REKAM MEDIS + RESEP -->
    <div class="grid-3 fade-in">

      <!-- RIWAYAT KUNJUNGAN -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="card-icon">🏥</div>
            Riwayat Kunjungan
          </div>
          <a href="#" class="card-action">Semua →</a>
        </div>
        <div class="card-body">

          <div class="riwayat-item">
            <div class="riwayat-icon ri-crimson">🩺</div>
            <div class="riwayat-detail">
              <div class="riwayat-title">Kontrol Hipertensi</div>
              <div class="riwayat-sub">dr. Budi Santoso · Poli PD</div>
            </div>
            <div class="riwayat-date">
              10 Mei<br><span class="chip chip-green" style="font-size:10px;padding:2px 7px;">Selesai</span>
            </div>
          </div>

          <div class="riwayat-item">
            <div class="riwayat-icon ri-amber">🔬</div>
            <div class="riwayat-detail">
              <div class="riwayat-title">Cek Laboratorium</div>
              <div class="riwayat-sub">Lab. Klinik · Darah Lengkap</div>
            </div>
            <div class="riwayat-date">
              22 Apr<br><span class="chip chip-green" style="font-size:10px;padding:2px 7px;">Selesai</span>
            </div>
          </div>

          <div class="riwayat-item">
            <div class="riwayat-icon ri-crimson">💊</div>
            <div class="riwayat-detail">
              <div class="riwayat-title">Kontrol Rutin</div>
              <div class="riwayat-sub">dr. Hendra Wijaya · Poli PD</div>
            </div>
            <div class="riwayat-date">
              5 Apr<br><span class="chip chip-green" style="font-size:10px;padding:2px 7px;">Selesai</span>
            </div>
          </div>

          <div class="riwayat-item">
            <div class="riwayat-icon ri-green">🏥</div>
            <div class="riwayat-detail">
              <div class="riwayat-title">IGD — Hipertensi Krisis</div>
              <div class="riwayat-sub">IGD · Rawat Inap 2 hari</div>
            </div>
            <div class="riwayat-date">
              12 Feb<br><span class="chip chip-gray" style="font-size:10px;padding:2px 7px;">RI</span>
            </div>
          </div>

        </div>
      </div>

      <!-- REKAM MEDIS -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="card-icon">📋</div>
            Rekam Medis
          </div>
          <a href="#" class="card-action">Unduh →</a>
        </div>
        <div class="card-body">

          <div class="rekam-item">
            <div class="rekam-row">
              <div class="rekam-diagnosa">Hipertensi Primer</div>
              <span class="rekam-icd">I10</span>
            </div>
            <div class="rekam-detail">TD: 150/95 mmHg · Terapi: Amlodipine 5mg, Candesartan 8mg. Kontrol rutin 1 bulan.</div>
          </div>

          <div class="rekam-item">
            <div class="rekam-row">
              <div class="rekam-diagnosa">Dislipidemia</div>
              <span class="rekam-icd">E78.5</span>
            </div>
            <div class="rekam-detail">Kolesterol total 240 mg/dL. Ditambahkan Atorvastatin 20mg malam hari.</div>
          </div>

          <div class="rekam-item">
            <div class="rekam-row">
              <div class="rekam-diagnosa">ISPA Ringan</div>
              <span class="rekam-icd">J06.9</span>
            </div>
            <div class="rekam-detail">Batuk pilek 3 hari. Terapi simptomatik. Sembuh tanpa komplikasi.</div>
          </div>

        </div>
      </div>

      <!-- RESEP OBAT -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="card-icon">💊</div>
            Resep Aktif
          </div>
          <a href="#" class="card-action">Detail →</a>
        </div>
        <div class="card-body">

          <div class="resep-card">
            <div class="resep-icon">🟥</div>
            <div>
              <div class="resep-name">Amlodipine</div>
              <div class="resep-info">5mg · 1×1 pagi hari</div>
            </div>
            <div class="resep-qty">
              <div class="resep-count">30</div>
              <div class="resep-unit">tablet</div>
            </div>
          </div>

          <div class="resep-card">
            <div class="resep-icon">🟩</div>
            <div>
              <div class="resep-name">Candesartan</div>
              <div class="resep-info">8mg · 1×1 pagi hari</div>
            </div>
            <div class="resep-qty">
              <div class="resep-count">30</div>
              <div class="resep-unit">tablet</div>
            </div>
          </div>

          <div class="resep-card">
            <div class="resep-icon">🟧</div>
            <div>
              <div class="resep-name">Atorvastatin</div>
              <div class="resep-info">20mg · 1×1 malam hari</div>
            </div>
            <div class="resep-qty">
              <div class="resep-count">30</div>
              <div class="resep-unit">tablet</div>
            </div>
          </div>

          <div style="margin-top:12px; padding:10px 14px; background: var(--rose-pale); border: 1px solid #f0c0c0; border-radius:10px; font-size:12px; color: var(--crimson); font-weight:500;">
            ⏰ Resep habis dalam <strong>12 hari</strong> · Segera perpanjang
          </div>

        </div>
      </div>

    </div>

  </div>
</main>

</body>
</html>