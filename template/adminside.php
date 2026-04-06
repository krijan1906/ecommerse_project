<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../template/authentication/login.php");
    exit();
}
?>
<?php
include '../configuration/database_connection.php';
$orders_data = [];

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");

if ($result && $result->num_rows > 0) {
    $orders_data = $result->fetch_all(MYSQLI_ASSOC);
}

$users_result    = mysqli_query($conn, "SELECT * FROM user_authentication");
$products_result = mysqli_query($conn, "SELECT * FROM product_detail");
$users_data      = [];
$products_data   = [];

if ($users_result && mysqli_num_rows($users_result) > 0) {
    while ($row = mysqli_fetch_assoc($users_result)) {
        $users_data[] = $row;
    }
}

if ($products_result && mysqli_num_rows($products_result) > 0) {
    while ($row = mysqli_fetch_assoc($products_result)) {
        $products_data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>LUXE — Admin Panel</title>
<style>
:root {
  --black:  #0a0a0a;
  --dark:   #111318;
  --dark2:  #1a1d24;
  --card:   #1e2128;
  --border: #2a2d36;
  --gold:   #c9a84c;
  --gold2:  #e8c96a;
  --white:  #f5f3ee;
  --gray:   #8a8d96;
  --light:  #d0cec9;
  --red:    #e05252;
  --green:  #4caf7d;
  --blue:   #64b5f6;
  --radius: 12px;
  --shadow: 0 8px 32px rgba(0,0,0,0.4);
  --trans:  all 0.3s cubic-bezier(0.4,0,0.2,1);
}
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
html { scroll-behavior:smooth }
body { font-family:'Georgia',serif; background:var(--dark); color:var(--white); line-height:1.6; overflow-x:hidden }
a { text-decoration:none; color:inherit }
button { cursor:pointer; border:none; outline:none; font-family:inherit }
input,select,textarea { font-family:inherit; outline:none }
ul { list-style:none }

::-webkit-scrollbar { width:6px }
::-webkit-scrollbar-track { background:var(--dark) }
::-webkit-scrollbar-thumb { background:var(--gold); border-radius:3px }

.admin-layout {
  display: grid;
  grid-template-columns: 240px 1fr;
  min-height: 100vh;
}

/* ── SIDEBAR ── */
.sidebar {
  background: var(--black);
  border-right: 1px solid var(--border);
  position: sticky;
  top: 0;
  height: 100vh;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
}
.sidebar-logo { padding: 1.5rem; border-bottom: 1px solid var(--border) }
.sidebar-logo .brand { font-size: 1.3rem; color: var(--gold); letter-spacing: 0.15em; font-weight: 700; text-transform: uppercase }
.sidebar-logo .sub   { font-size: 0.72rem; color: var(--gray); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.2rem }
.sidebar-nav { padding: 1rem 0; flex: 1 }
.nav-item {
  display: flex; align-items: center; gap: 0.85rem;
  padding: 0.9rem 1.5rem; font-size: 0.85rem; color: var(--gray);
  cursor: pointer; transition: var(--trans);
  border-left: 3px solid transparent; user-select: none;
}
.nav-item:hover  { color: var(--white); background: rgba(255,255,255,0.04) }
.nav-item.active { color: var(--gold); background: rgba(201,168,76,0.08); border-left-color: var(--gold) }
.nav-icon { width: 22px; height: 22px; flex-shrink: 0; display: flex; align-items: center; justify-content: center }
.nav-icon img { width: 20px; height: 20px; object-fit: contain; opacity: 0.6; filter: brightness(0) invert(1); transition: var(--trans) }
.nav-item.active .nav-icon img,
.nav-item:hover  .nav-icon img { opacity: 1; filter: brightness(0) saturate(100%) invert(73%) sepia(46%) saturate(450%) hue-rotate(5deg) brightness(95%) }
.sidebar-footer { padding: 1.5rem; border-top: 1px solid var(--border) }
.admin-user { display: flex; align-items: center; gap: 0.75rem }
.admin-avatar { width: 36px; height: 36px; background: var(--gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: var(--black); font-weight: 700; overflow: hidden }
.admin-avatar img { width: 100%; height: 100%; object-fit: cover }
.admin-user-info .name { font-size: 0.85rem; font-weight: 600 }
.admin-user-info .role { font-size: 0.72rem; color: var(--gold) }

/* ── MAIN ── */
.main-content { background: var(--dark); padding: 2rem 2.5rem; overflow: auto }
.topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border); flex-wrap: wrap; gap: 1rem }
.topbar h1 { font-size: 1.4rem }
.topbar-right { display: flex; align-items: center; gap: 1rem }
.topbar-search { display: flex; align-items: center; gap: 0.5rem; background: var(--card); border: 1px solid var(--border); border-radius: 8px; padding: 0.5rem 1rem }
.topbar-search .search-icon { width: 16px; height: 16px; opacity: 0.5; filter: brightness(0) invert(1) }
.topbar-search input { background: none; border: none; color: var(--white); font-size: 0.85rem; width: 180px }
.topbar-search input::placeholder { color: var(--gray) }
.back-btn { display: inline-flex; align-items: center; gap: 0.5rem; background: var(--card); border: 1px solid var(--border); color: var(--light); padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.08em; transition: var(--trans) }
.back-btn:hover { border-color: var(--gold); color: var(--gold) }
.back-btn img { width: 16px; height: 16px; filter: brightness(0) invert(1); opacity: 0.7 }

.tab { display: none }
.tab.active { display: block }

/* ── STATS ── */
.stats-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 1.5rem; margin-bottom: 2rem }
.stat-card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; transition: var(--trans); position: relative; overflow: hidden }
.stat-card::after { content: ''; position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(201,168,76,0.05); border-radius: 50% }
.stat-card:hover { border-color: var(--gold); transform: translateY(-2px) }
.stat-icon { width: 44px; height: 44px; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: center; background: rgba(201,168,76,0.1); border-radius: 10px }
.stat-icon img { width: 24px; height: 24px; object-fit: contain; filter: brightness(0) saturate(100%) invert(73%) sepia(46%) saturate(450%) hue-rotate(5deg) brightness(95%) }
.stat-value  { font-size: 2rem; font-weight: 700; color: var(--gold) }
.stat-label  { color: var(--gray); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 0.25rem }
.stat-change { font-size: 0.78rem; color: var(--green); margin-top: 0.5rem }
.stat-change.down { color: var(--red) }

/* ── SECTION BOX ── */
.section-box { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 1.5rem }
.section-head { padding: 1.1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); flex-wrap: wrap; gap: 0.75rem }
.section-head h3 { font-size: 0.95rem }

/* ── TABLE ── */
.table-wrap { overflow-x: auto }
.data-table { width: 100%; border-collapse: collapse }
.data-table th { padding: 0.85rem 1.25rem; text-align: left; font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gray); background: var(--dark2); border-bottom: 1px solid var(--border); white-space: nowrap }
.data-table td { padding: 1rem 1.25rem; font-size: 0.88rem; border-bottom: 1px solid var(--border); white-space: nowrap }
.data-table tr:last-child td { border-bottom: none }
.data-table tr:hover td { background: rgba(255,255,255,0.025) }
.text-gold { color: var(--gold) }
.text-gray { color: var(--gray) }

/* ── BADGES ── */
.badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.72rem; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase }
.badge-pending    { background: rgba(255,165,0,0.15); color: orange }
.badge-processing { background: rgba(100,181,246,0.15); color: var(--blue) }
.badge-shipped    { background: rgba(76,175,77,0.15); color: var(--green) }
.badge-delivered  { background: rgba(201,168,76,0.15); color: var(--gold) }
.badge-cancelled  { background: rgba(224,82,82,0.15); color: var(--red) }
.badge-active     { background: rgba(76,175,77,0.15); color: var(--green) }
.badge-inactive   { background: rgba(224,82,82,0.15); color: var(--red) }

/* ── ACTION BTNS ── */
.action-btns { display: flex; gap: 0.5rem; align-items: center }
.action-btn { padding: 0.35rem 0.75rem; border-radius: 5px; font-size: 0.73rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; transition: var(--trans); border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem }
.btn-view { background: rgba(100,181,246,0.15); color: var(--blue) }
.btn-view:hover { background: rgba(100,181,246,0.3) }
.btn-edit { background: rgba(201,168,76,0.15); color: var(--gold) }
.btn-edit:hover { background: rgba(201,168,76,0.3) }
.btn-del  { background: rgba(224,82,82,0.15); color: var(--red) }
.btn-del:hover  { background: rgba(224,82,82,0.3) }
.action-btn img { width: 13px; height: 13px; object-fit: contain }
.btn-view img { filter: brightness(0) saturate(100%) invert(67%) sepia(70%) saturate(400%) hue-rotate(185deg) brightness(105%) }
.btn-edit img { filter: brightness(0) saturate(100%) invert(73%) sepia(46%) saturate(450%) hue-rotate(5deg) brightness(95%) }
.btn-del  img { filter: brightness(0) saturate(100%) invert(45%) sepia(80%) saturate(600%) hue-rotate(330deg) brightness(105%) }

/* ── BUTTONS ── */
.btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.65rem 1.4rem; border-radius: 7px; font-size: 0.8rem; letter-spacing: 0.09em; text-transform: uppercase; font-weight: 600; transition: var(--trans); font-family: inherit; cursor: pointer }
.btn-gold { background: var(--gold); color: var(--black) }
.btn-gold:hover { background: var(--gold2); transform: translateY(-1px) }
.btn-outline { background: transparent; color: var(--white); border: 1px solid var(--border) }
.btn-outline:hover { border-color: var(--gold); color: var(--gold) }
.btn-dark { background: var(--dark2); color: var(--white); border: 1px solid var(--border) }
.btn-sm { padding: 0.45rem 1rem; font-size: 0.75rem }

/* ── FORMS ── */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem }
.form-grid.cols-1 { grid-template-columns: 1fr }
.full { grid-column: 1 / -1 }
.form-group { display: flex; flex-direction: column; gap: 0.4rem }
.form-group label { font-size: 0.78rem; letter-spacing: 0.09em; text-transform: uppercase; color: var(--gray) }
.form-group input,
.form-group select,
.form-group textarea { background: var(--dark2); border: 1px solid var(--border); color: var(--white); padding: 0.7rem 1rem; border-radius: 8px; font-size: 0.88rem; transition: var(--trans) }
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus { border-color: var(--gold) }
.form-group select option { background: var(--dark2) }
.form-group textarea { resize: vertical; min-height: 80px }
.form-group .err { color: var(--red); font-size: 0.76rem; display: none }
.form-group.invalid input,
.form-group.invalid select { border-color: var(--red) }
.form-group.invalid .err { display: block }

/* ── CHARTS ── */
.chart-section { padding: 1.5rem }
.chart-bars { display: flex; align-items: flex-end; gap: 0.75rem; height: 160px; margin-bottom: 0.5rem }
.bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 0.4rem }
.bar { width: 100%; background: linear-gradient(to top, var(--gold), var(--gold2)); border-radius: 4px 4px 0 0; transition: var(--trans); min-height: 4px; position: relative }
.bar:hover { opacity: 0.8; transform: scaleY(1.02); transform-origin: bottom }
.bar-val   { font-size: 0.7rem; color: var(--gold); font-weight: 600 }
.bar-label { font-size: 0.68rem; color: var(--gray); text-align: center }
.chart-alt { display: flex; flex-direction: column; gap: 0.75rem; padding: 1.5rem }
.chart-row { display: flex; align-items: center; gap: 1rem }
.chart-row-label    { width: 90px; font-size: 0.8rem; color: var(--gray); flex-shrink: 0 }
.chart-row-bar-wrap { flex: 1; background: var(--dark2); border-radius: 4px; height: 10px; overflow: hidden }
.chart-row-bar      { height: 100%; background: var(--gold); border-radius: 4px; transition: width 0.8s ease }
.chart-row-val      { width: 60px; text-align: right; font-size: 0.8rem; color: var(--gold); font-weight: 600 }

/* ── PRODUCT THUMB ── */
.product-thumb { width: 44px; height: 44px; background: var(--dark2); border: 1px solid var(--border); border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden }
.product-thumb img { width: 100%; height: 100%; object-fit: cover; border-radius: 7px }

/* ── IMAGE UPLOAD WIDGET ── */
.img-upload-wrap {
  position: relative; width: 100%; height: 160px;
  background: var(--dark2); border: 2px dashed var(--border);
  border-radius: 10px; display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  cursor: pointer; transition: var(--trans); overflow: hidden;
}
.img-upload-wrap:hover { border-color: var(--gold); background: rgba(201,168,76,0.04) }
.img-upload-wrap.has-image { border-style: solid; border-color: var(--gold) }
.img-upload-wrap .img-placeholder { display: flex; flex-direction: column; align-items: center; pointer-events: none }

/* ── CURRENT IMAGE PREVIEW (edit modal) ── */
.current-img-block {
  display: none;
  margin-bottom: 0.85rem;
  padding: 0.9rem 1rem;
  background: var(--dark2);
  border: 1px solid var(--border);
  border-radius: 8px;
}
.current-img-block .cib-label { font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gray); margin-bottom: 0.5rem }
.current-img-block .cib-row   { display: flex; align-items: center; gap: 0.9rem }
.current-img-block .cib-thumb { width: 60px; height: 60px; border-radius: 8px; overflow: hidden; border: 1px solid var(--border); flex-shrink: 0 }
.current-img-block .cib-thumb img { width: 100%; height: 100%; object-fit: cover }
.current-img-block .cib-hint  { font-size: 0.8rem; color: var(--gray); line-height: 1.5 }

/* ── MODAL ── */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; display: flex; align-items: center; justify-content: center; padding: 2rem; opacity: 0; pointer-events: none; transition: var(--trans) }
.modal-overlay.open { opacity: 1; pointer-events: all }
.modal { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 2rem; width: 100%; max-width: 520px; box-shadow: var(--shadow); transform: scale(0.9); transition: var(--trans); max-height: 90vh; overflow-y: auto }
.modal-overlay.open .modal { transform: scale(1) }
.modal-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border) }
.modal-head h3 { font-size: 1rem }
.modal-close { background: none; color: var(--gray); font-size: 1.3rem; transition: var(--trans); width: 30px; height: 30px; border-radius: 6px }
.modal-close:hover { color: var(--white); background: var(--border) }

/* ── TOAST ── */
.toast-wrap { position: fixed; bottom: 2rem; right: 2rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.75rem }
.toast { background: var(--card); border: 1px solid var(--border); border-radius: 10px; padding: 0.9rem 1.4rem; display: flex; align-items: center; gap: 0.75rem; min-width: 270px; box-shadow: var(--shadow); animation: slideIn 0.3s ease }
.toast.success { border-left: 3px solid var(--green) }
.toast.error   { border-left: 3px solid var(--red) }
.toast.info    { border-left: 3px solid var(--gold) }
.toast img { width: 20px; height: 20px; object-fit: contain }
@keyframes slideIn { from { transform: translateX(120%); opacity: 0 } to { transform: translateX(0); opacity: 1 } }

/* ── MISC ── */
.divider { height: 1px; background: var(--border); margin: 1.5rem 0 }
.empty-state { text-align: center; padding: 3rem; color: var(--gray); font-size: 0.9rem }
.empty-state img { width: 48px; height: 48px; opacity: 0.4; margin-bottom: 0.75rem; filter: brightness(0) invert(1) }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) { .stats-grid { grid-template-columns: 1fr 1fr } }
@media (max-width: 768px)  {
  .admin-layout { grid-template-columns: 1fr }
  .sidebar { display: none }
  .sidebar.mobile-open { display: flex; position: fixed; z-index: 999; width: 240px }
  .stats-grid { grid-template-columns: 1fr }
  .form-grid  { grid-template-columns: 1fr }
  .main-content { padding: 1.5rem }
}
</style>
</head>
<body>

<div class="admin-layout">

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <div class="brand">LUXE</div>
      <div class="sub">Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-item active" data-tab="dashboard">
        <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/layout-dashboard.svg" alt=""/></span> Dashboard
      </div>
      <div class="nav-item" data-tab="products">
        <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/package.svg" alt=""/></span> Products
      </div>
      <div class="nav-item" data-tab="orders">
        <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/shopping-cart.svg" alt=""/></span> Orders
      </div>
      <div class="nav-item" data-tab="users">
        <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/users.svg" alt=""/></span> Users
      </div>
      <div class="nav-item" data-tab="analytics">
        <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/trending-up.svg" alt=""/></span> Analytics
      </div>
      <div class="nav-item" data-tab="settings">
        <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/settings.svg" alt=""/></span> Settings
      </div>
      <a href="../backend/logout.php" style="text-decoration:none;color:inherit">
        <div class="nav-item">
          <span class="nav-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/log-out.svg" alt=""/></span> Logout
        </div>
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="admin-user">
        <div class="admin-avatar">
          <img src="https://ui-avatars.com/api/?name=Admin+User&background=c9a84c&color=0a0a0a&size=36&bold=true" alt="Admin"/>
        </div>
        <div class="admin-user-info">
          <div class="name">Admin User</div>
          <div class="role">Super Admin</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">

    <!-- Top Bar -->
    <div class="topbar">
      <h1 id="page-title">Dashboard Overview</h1>
      <div class="topbar-right">
        <div class="topbar-search">
          <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/search.svg" alt="Search" class="search-icon"/>
          <input type="text" placeholder="Search..." id="global-search"/>
        </div>
        <a href="ecommerce.php" class="back-btn">
          <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/home.svg" alt="Home"/>
          Back to Store
        </a>
      </div>
    </div>

    <!-- ══ DASHBOARD TAB ══ -->
    <div class="tab active" id="tab-dashboard">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/package.svg" alt=""/></div>
          <div class="stat-value"><?php echo count($products_data); ?></div>
          <div class="stat-label">Total Products</div>
          <div class="stat-change">↑ 8% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/shopping-cart.svg" alt=""/></div>
          <div class="stat-value"><?php echo count($orders_data); ?></div>
          <div class="stat-label">Total Orders</div>
          <div class="stat-change">↑ 15% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/users.svg" alt=""/></div>
          <div class="stat-value"><?php echo count($users_data); ?></div>
          <div class="stat-label">Total Users</div>
          <div class="stat-change">↑ 22% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/dollar-sign.svg" alt=""/></div>
          <div class="stat-value">$84K</div>
          <div class="stat-label">Revenue</div>
          <div class="stat-change">↑ 31% this month</div>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem">
        <div class="section-box">
          <div class="section-head"><h3>Monthly Revenue</h3><span class="text-gray" style="font-size:0.8rem">2025</span></div>
          <div class="chart-section"><div class="chart-bars" id="revenue-chart"></div></div>
        </div>
        <div class="section-box">
          <div class="section-head"><h3>Sales by Category</h3></div>
          <div class="chart-alt" id="category-chart"></div>
        </div>
      </div>

      
    </div><!-- end dashboard -->

    <!-- ══ PRODUCTS TAB ══ -->
    <div class="tab" id="tab-products">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
          <h2 style="font-size:1rem;margin-bottom:0.25rem">Product Management</h2>
          <p class="text-gray" style="font-size:0.85rem" id="product-count-label">Loading...</p>
        </div>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap">
          <select id="product-filter-cat" style="background:var(--card);border:1px solid var(--border);color:var(--white);padding:0.55rem 1rem;border-radius:8px;font-size:0.85rem">
            <option value="">All Categories</option>
            <option>Electronics</option><option>Fashion</option>
            <option>Watches</option><option>Jewelry</option>
            <option>Home</option><option>Beauty</option>
          </select>
          <button class="btn btn-gold" onclick="openModal('modal-add-product')">+ Add Product</button>
        </div>
      </div>
      <div class="section-box">
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Old Price</th><th>Created At</th><th>Description</th><th>Actions</th></tr>
            </thead>
            <tbody id="products-tbody">
              <?php if (!empty($products_data)): ?>
                <?php foreach ($products_data as $row): ?>
                <tr
                  data-id="<?php echo htmlspecialchars($row['id']); ?>"
                  data-name="<?php echo htmlspecialchars($row['product_name']); ?>"
                  data-cat="<?php echo htmlspecialchars($row['category']); ?>"
                  data-price="<?php echo htmlspecialchars($row['price']); ?>"
                  data-oldprice="<?php echo htmlspecialchars($row['old_price']); ?>"
                  data-desc="<?php echo htmlspecialchars($row['description']); ?>"
                  data-img="<?php echo htmlspecialchars(!empty($row['image']) ? '../backend/' . $row['image'] : ''); ?>"
                >
                  <td>
                    <div class="product-thumb">
                      <img src="<?php echo !empty($row['image'])
                        ? '../backend/' . $row['image']
                        : 'https://placehold.co/44x44/1a1d24/c9a84c?text=' . urlencode(mb_substr($row['product_name'], 0, 2)); ?>"
                        alt="<?php echo htmlspecialchars($row['product_name']); ?>"/>
                    </div>
                  </td>
                  <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                  <td><span style="color:var(--gold);font-size:0.8rem"><?php echo htmlspecialchars($row['category']); ?></span></td>
                  <td class="text-gold">$<?php echo htmlspecialchars($row['price']); ?></td>
                  <td class="text-gray">$<?php echo htmlspecialchars($row['old_price']); ?></td>
                  <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                  <td style="max-width:180px;overflow:hidden;text-overflow:ellipsis"><?php echo htmlspecialchars($row['description']); ?></td>
                  <td>
                    <div class="action-btns">
                      <button type="button"
  class="action-btn btn-edit"
  onclick="openEditProductFromRow(this)"
  data-id="<?php echo $row['id']; ?>">
  <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/pencil.svg" alt=""/>Edit
</button>
                      
                      <a href="../backend/add_product.php?delete=<?php echo $row['id']; ?>"
                         class="action-btn btn-del"
                         onclick="return confirm('Are you sure you want to delete this product?')">
                        <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/trash-2.svg" alt=""/>Delete
                      </a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="8" style="text-align:center;color:gray;padding:2rem">No products found</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ ORDERS TAB ══ -->
    <div class="tab" id="tab-orders">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
          <h2 style="font-size:1rem;margin-bottom:0.25rem">Order Management</h2>
          <p class="text-gray" style="font-size:0.85rem">Manage all customer orders</p>
        </div>
        <select id="order-status-filter" style="background:var(--card);border:1px solid var(--border);color:var(--white);padding:0.55rem 1rem;border-radius:8px;font-size:0.85rem">
          <option value="">All Statuses</option>
          <option>Pending</option><option>Processing</option>
          <option>Shipped</option><option>Delivered</option><option>Cancelled</option>
        </select>
      </div>
      <div class="section-box">
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr><th>Order Name</th><th>Customer</th><th>Email</th><th>Amount</th><th>Status</th><th>Date</th><th>Actions</th></tr>
            </thead>
            <tbody id="orders-tbody">
              <?php if (!empty($orders_data)): ?>
                <?php foreach ($orders_data as $row): ?>
                  <?php
                    $customer    = $row['first_name'] . ' ' . $row['last_name'];
                    $statusClass = ($row['status'] === 'PENDING') ? 'badge-pending' : 'badge-shipped';
                  ?>
                  <tr data-id="<?php echo htmlspecialchars($row['id']); ?>" data-email="<?php echo htmlspecialchars($row['email']); ?>" data-status="<?php echo htmlspecialchars($row['status']); ?>">
                    <td style="color:var(--gold);font-weight:600"><?php echo htmlspecialchars($row['order_name']); ?></td>
                    <td>
                      <div style="display:flex;align-items:center;gap:0.65rem">
                        <div style="width:30px;height:30px;border-radius:50%;overflow:hidden;flex-shrink:0">
                          <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($customer); ?>&background=1a1d24&color=c9a84c&size=30&bold=true"/>
                        </div>
                        <?php echo htmlspecialchars($customer); ?>
                      </div>
                    </td>
                    <td class="text-gray"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td class="text-gold">$<?php echo number_format($row['amount'], 2); ?></td>
                    <td><span class="badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                    <td class="text-gray"><?php echo htmlspecialchars($row['order_date']); ?></td>
                    <td>
                      <div class="action-btns">
                        <a href="../backend/order_detail.php?delete=<?php echo $row['id']; ?>"
                           class="action-btn btn-del"
                           onclick="return confirm('Delete this order?')">Delete</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="7" style="text-align:center;color:gray;padding:2rem">No orders found</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ USERS TAB ══ -->
    <div class="tab" id="tab-users">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
          <h2 style="font-size:1rem;margin-bottom:0.25rem">User Management</h2>
          <p class="text-gray" style="font-size:0.85rem" id="user-count-label">Loading...</p>
        </div>
        <button class="btn btn-gold" onclick="openModal('modal-add-user')">+ Add User</button>
      </div>
      <div class="section-box">
        <div class="table-wrap">
          <table class="data-table">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
              <?php if (!empty($users_data)): ?>
                <?php foreach ($users_data as $row): ?>
                <tr data-id="<?php echo htmlspecialchars($row['id']); ?>" data-fullname="<?php echo htmlspecialchars($row['fullname']); ?>" data-email="<?php echo htmlspecialchars($row['email']); ?>">
                  <td>
                    <div style="display:flex;align-items:center;gap:0.65rem">
                      <div style="width:32px;height:32px;border-radius:50%;overflow:hidden;flex-shrink:0">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($row['fullname']); ?>&background=1a1d24&color=c9a84c&size=32&bold=true" style="width:100%;height:100%;object-fit:cover"/>
                      </div>
                      <?php echo htmlspecialchars($row['fullname']); ?>
                    </div>
                  </td>
                  <td class="text-gray"><?php echo htmlspecialchars($row['email']); ?></td>
                  <td><span style="font-size:0.78rem;color:var(--blue)">Customer</span></td>
                  <td class="text-gray">2025</td>
                  <td><span class="badge badge-active">Active</span></td>
                  <td>
                    <div class="action-btns">
                      <a href="../backend/add_user.php?delete=<?php echo $row['id']; ?>"
                         class="action-btn btn-del"
                         onclick="return confirm('Are you sure you want to delete this user?')">
                        <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/trash-2.svg" alt=""/>Delete
                      </a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6" style="text-align:center;color:gray;padding:2rem">No users found</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ ANALYTICS TAB ══ -->
    <div class="tab" id="tab-analytics">
      <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1rem;margin-bottom:0.25rem">Analytics &amp; Reports</h2>
        <p class="text-gray" style="font-size:0.85rem">Sales performance overview</p>
      </div>
      <div class="stats-grid" style="margin-bottom:1.5rem">
        <div class="stat-card"><div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/bar-chart-2.svg" alt=""/></div><div class="stat-value">$84K</div><div class="stat-label">Total Revenue</div><div class="stat-change">↑ 31% vs last month</div></div>
        <div class="stat-card"><div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/shopping-bag.svg" alt=""/></div><div class="stat-value">$312</div><div class="stat-label">Avg. Order Value</div><div class="stat-change">↑ 5% vs last month</div></div>
        <div class="stat-card"><div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/repeat.svg" alt=""/></div><div class="stat-value">68%</div><div class="stat-label">Return Customer Rate</div><div class="stat-change">↑ 12% vs last month</div></div>
        <div class="stat-card"><div class="stat-icon"><img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/truck.svg" alt=""/></div><div class="stat-value">2.4d</div><div class="stat-label">Avg. Delivery Time</div><div class="stat-change down">↓ Improved by 0.3d</div></div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
        <div class="section-box"><div class="section-head"><h3>Weekly Sales</h3></div><div class="chart-section"><div class="chart-bars" id="weekly-chart"></div></div></div>
        <div class="section-box"><div class="section-head"><h3>Top Products</h3></div><div class="chart-alt" id="top-products-chart"></div></div>
      </div>
    </div>

    <!-- ══ SETTINGS TAB ══ -->
    <div class="tab" id="tab-settings">
      <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1rem;margin-bottom:0.25rem">Store Settings</h2>
        <p class="text-gray" style="font-size:0.85rem">Manage your store configuration</p>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
        <div class="section-box">
          <div class="section-head"><h3>General Settings</h3></div>
          <div style="padding:1.5rem"><div class="form-grid cols-1" style="gap:1.2rem">
            <div class="form-group"><label>Store Name</label><input type="text" value="LUXE Premium Store"/></div>
            <div class="form-group"><label>Store Email</label><input type="email" value="support@luxe.com"/></div>
            <div class="form-group"><label>Store Phone</label><input type="tel" value="+1 (800) LUXE-123"/></div>
            <div class="form-group"><label>Currency</label><select><option>USD — US Dollar</option><option>EUR — Euro</option><option>GBP — British Pound</option></select></div>
            <button class="btn btn-gold" onclick="showToast('Settings saved!','success')">Save Changes</button>
          </div></div>
        </div>
        <div class="section-box">
          <div class="section-head"><h3>Admin Account</h3></div>
          <div style="padding:1.5rem"><div class="form-grid cols-1" style="gap:1.2rem">
            <div class="form-group"><label>Full Name</label><input type="text" value="Admin User"/></div>
            <div class="form-group"><label>Email</label><input type="email" value="admin@luxe.com"/></div>
            <div class="form-group"><label>New Password</label><input type="password" placeholder="Leave blank to keep current"/></div>
            <div class="form-group"><label>Confirm Password</label><input type="password" placeholder="Confirm new password"/></div>
            <button class="btn btn-gold" onclick="showToast('Account updated!','success')">Update Account</button>
          </div></div>
        </div>
        <div class="section-box">
          <div class="section-head"><h3>Shipping Settings</h3></div>
          <div style="padding:1.5rem"><div class="form-grid cols-1" style="gap:1.2rem">
            <div class="form-group"><label>Free Shipping Threshold ($)</label><input type="number" value="100"/></div>
            <div class="form-group"><label>Standard Shipping Rate ($)</label><input type="number" value="15"/></div>
            <div class="form-group"><label>Express Shipping Rate ($)</label><input type="number" value="35"/></div>
            <button class="btn btn-gold" onclick="showToast('Shipping settings saved!','success')">Save Settings</button>
          </div></div>
        </div>
        <div class="section-box">
          <div class="section-head"><h3>Tax Settings</h3></div>
          <div style="padding:1.5rem"><div class="form-grid cols-1" style="gap:1.2rem">
            <div class="form-group"><label>Tax Rate (%)</label><input type="number" value="8" step="0.1"/></div>
            <div class="form-group"><label>Tax Label</label><input type="text" value="Sales Tax"/></div>
            <div class="form-group"><label>Tax Included in Price?</label><select><option>No — Add at checkout</option><option>Yes — Already included</option></select></div>
            <button class="btn btn-gold" onclick="showToast('Tax settings saved!','success')">Save Settings</button>
          </div></div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ══ MODAL: ADD PRODUCT ══ -->
<div class="modal-overlay" id="modal-add-product">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New Product</h3>
      <button class="modal-close" onclick="closeModal('modal-add-product')">✕</button>
    </div>
    <form action="../backend/add_product.php" method="POST" enctype="multipart/form-data">
      <div class="form-grid" style="gap:1rem">
        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ap-name" placeholder="e.g. Premium Gold Watch" name="product_name"/>
        </div>
        <div class="form-group">
          <label>Price ($) *</label>
          <input type="number" id="ap-price" placeholder="299.00" step="0.01" name="price"/>
        </div>
        <div class="form-group">
          <label>Old Price ($)</label>
          <input type="number" id="ap-old" placeholder="399.00" step="0.01" name="old_price"/>
        </div>
        <div class="form-group">
          <label>Category *</label>
          <select id="ap-cat" name="category">
            <option value="">Select...</option>
            <option>Electronics</option><option>Fashion</option>
            <option>Watches</option><option>Jewelry</option>
            <option>Home</option><option>Beauty</option>
          </select>
        </div>
        <div class="form-group full">
          <label>Product Image</label>
          <div class="img-upload-wrap" id="ap-img-wrap" onclick="document.getElementById('ap-image').click()">
            <img id="ap-img-preview" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;border-radius:10px;position:absolute;inset:0"/>
            <div class="img-placeholder" id="ap-img-placeholder">
              <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/image-plus.svg" alt="" style="width:32px;height:32px;opacity:0.4;filter:brightness(0) invert(1);margin-bottom:0.5rem"/>
              <div style="font-size:0.82rem;color:var(--gray)">Click to upload image</div>
              <div style="font-size:0.74rem;color:var(--gray);margin-top:0.2rem">PNG, JPG, WEBP — max 5MB</div>
            </div>
          </div>
          <input type="file" id="ap-image" name="image" accept="image/*" style="display:none"
            onchange="previewProductImage(this,'ap-img-preview','ap-img-placeholder','ap-img-wrap')"/>
        </div>
        <div class="form-group full">
          <label>Description</label>
          <textarea id="ap-desc" placeholder="Describe this product..." name="description"></textarea>
        </div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:0.75rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-add-product')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add Product</button>
      </div>
    </form>
  </div>
</div>

<!-- ══ MODAL: EDIT PRODUCT (with image upload) ══ -->
<div class="modal-overlay" id="modal-edit-product">
  <div class="modal">
    <div class="modal-head">
      <h3>Edit Product</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-product')">✕</button>
    </div>
    <form action="../backend/edit_product.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="ep-id" name="id"/>
      <div class="form-grid" style="gap:1rem">

        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ep-name" name="product_name" placeholder="Product name"/>
        </div>
        <div class="form-group">
          <label>Price ($) *</label>
          <input type="number" id="ep-price" name="price" step="0.01" placeholder="0.00"/>
        </div>
        <div class="form-group">
          <label>Old Price ($)</label>
          <input type="number" id="ep-oldprice" name="old_price" step="0.01" placeholder="0.00"/>
        </div>
        <div class="form-group full">
          <label>Category *</label>
          <select id="ep-cat" name="category">
            <option value="">Select...</option>
            <option>Electronics</option>
            <option>Fashion</option>
            <option>Watches</option>
            <option>Jewelry</option>
            <option>Home</option>
            <option>Beauty</option>
          </select>
        </div>

        <!-- ─── IMAGE SECTION ─── -->
        <div class="form-group full">
          <label>
            Product Image
            <span style="color:var(--gray);font-size:0.72rem;text-transform:none;letter-spacing:0;margin-left:0.4rem">(upload a new one to replace the current)</span>
          </label>

          <!-- Current image preview — shown when product has an image -->
          <div class="current-img-block" id="ep-current-img-wrap">
            <div class="cib-label">Current Image</div>
            <div class="cib-row">
              <div class="cib-thumb">
                <img id="ep-current-img" src="" alt="Current product image"/>
              </div>
              <div class="cib-hint">This is the image currently saved for this product. Upload a new file below to replace it, or leave empty to keep this one.</div>
            </div>
          </div>

          <!-- New image upload zone -->
          <div class="img-upload-wrap" id="ep-img-wrap" onclick="document.getElementById('ep-image').click()" style="margin-top:0.5rem">
            <img id="ep-img-preview" src="" alt=""
                 style="display:none;width:100%;height:100%;object-fit:cover;border-radius:10px;position:absolute;inset:0"/>
            <div class="img-placeholder" id="ep-img-placeholder">
              <img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/image-plus.svg" alt=""
                   style="width:28px;height:28px;opacity:0.4;filter:brightness(0) invert(1);margin-bottom:0.4rem"/>
              <div style="font-size:0.8rem;color:var(--gray)">Click to upload new image</div>
              <div style="font-size:0.72rem;color:var(--gray);margin-top:0.15rem;opacity:0.7">PNG, JPG, WEBP — max 5MB</div>
            </div>
          </div>
          <input type="file" id="ep-image" name="image" accept="image/*" style="display:none"
                 onchange="previewProductImage(this,'ep-img-preview','ep-img-placeholder','ep-img-wrap')"/>
        </div>
        <!-- ─── END IMAGE SECTION ─── -->

        <div class="form-group full">
          <label>Description</label>
          <textarea id="ep-desc" name="description" placeholder="Product description..."></textarea>
        </div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:0.75rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-product')">Cancel</button>
        <button type="submit" class="btn btn-gold">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ══ MODAL: ADD USER ══ -->
<div class="modal-overlay" id="modal-add-user">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New User</h3>
      <button class="modal-close" onclick="closeModal('modal-add-user')">✕</button>
    </div>
    <form onsubmit="handleAddUser(event)">
      <div class="form-grid" style="gap:1rem">
        <div class="form-group"><label>First Name *</label><input type="text" id="au-fname" placeholder="John"/></div>
        <div class="form-group"><label>Last Name *</label><input type="text" id="au-lname" placeholder="Doe"/></div>
        <div class="form-group full"><label>Email *</label><input type="email" id="au-email" placeholder="john@email.com"/></div>
        <div class="form-group"><label>Role</label><select id="au-role"><option>Customer</option><option>Editor</option><option>Admin</option></select></div>
        <div class="form-group"><label>Status</label><select id="au-status"><option>Active</option><option>Inactive</option></select></div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:0.75rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-add-user')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add User</button>
      </div>
    </form>
  </div>
</div>

<!-- ══ MODAL: EDIT USER ══ -->
<div class="modal-overlay" id="modal-edit-user">
  <div class="modal">
    <div class="modal-head">
      <h3>Edit User</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-user')">✕</button>
    </div>
    <form action="../backend/edit_user.php" method="POST">
      <input type="hidden" id="eu-id" name="id"/>
      <div class="form-grid" style="gap:1rem">
        <div class="form-group full"><label>Full Name *</label><input type="text" id="eu-fullname" name="fullname" placeholder="Full name"/></div>
        <div class="form-group full"><label>Email Address *</label><input type="email" id="eu-email" name="email" placeholder="email@example.com"/></div>
        <div class="form-group full">
          <label>New Password <span style="color:var(--gray);font-size:0.75rem;text-transform:none;letter-spacing:0">(leave blank to keep current)</span></label>
          <input type="password" id="eu-password" name="password" placeholder="Enter new password to change"/>
        </div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:0.75rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-user')">Cancel</button>
        <button type="submit" class="btn btn-gold">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ══ MODAL: VIEW ORDER ══ -->
<div class="modal-overlay" id="modal-view-order">
  <div class="modal">
    <div class="modal-head">
      <h3>Order Details</h3>
      <button class="modal-close" onclick="closeModal('modal-view-order')">✕</button>
    </div>
    <div id="order-detail-content"></div>
  </div>
</div>

<div class="toast-wrap" id="toast-wrap"></div>

<script>
/* ─── EDIT PRODUCT — reads data-* from row, shows current image ─── */
function openEditProductFromRow(btn) {
  var row = btn.closest('tr');

  // fill basic fields
  document.getElementById('ep-id').value       = row.getAttribute('data-id')       || '';
  document.getElementById('ep-name').value     = row.getAttribute('data-name')     || '';
  document.getElementById('ep-price').value    = row.getAttribute('data-price')    || '';
  document.getElementById('ep-oldprice').value = row.getAttribute('data-oldprice') || '';
  document.getElementById('ep-desc').value     = row.getAttribute('data-desc')     || '';

  // select matching category
  var cat = row.getAttribute('data-cat') || '';
  var sel = document.getElementById('ep-cat');
  for (var i = 0; i < sel.options.length; i++) {
    if (sel.options[i].value === cat) { sel.selectedIndex = i; break; }
  }

  // show current image if it exists
  var imgSrc  = row.getAttribute('data-img') || '';
  var imgWrap = document.getElementById('ep-current-img-wrap');
  var imgEl   = document.getElementById('ep-current-img');

  if (imgSrc && imgSrc.trim() !== '') {
    imgEl.src             = imgSrc;
    imgWrap.style.display = 'block';
  } else {
    imgWrap.style.display = 'none';
    imgEl.src             = '';
  }

  // reset the upload zone so it doesn't show a stale preview from last open
  var preview     = document.getElementById('ep-img-preview');
  var placeholder = document.getElementById('ep-img-placeholder');
  var uploadWrap  = document.getElementById('ep-img-wrap');
  preview.style.display     = 'none';
  preview.src               = '';
  placeholder.style.display = 'flex';
  uploadWrap.classList.remove('has-image');
  document.getElementById('ep-image').value = '';

  openModal('modal-edit-product');
}

/* ─── EDIT USER ─── */
function openEditUserFromRow(btn) {
  var row = btn.closest('tr');
  document.getElementById('eu-id').value       = row.getAttribute('data-id')       || '';
  document.getElementById('eu-fullname').value = row.getAttribute('data-fullname') || '';
  document.getElementById('eu-email').value    = row.getAttribute('data-email')    || '';
  document.getElementById('eu-password').value = '';
  openModal('modal-edit-user');
}

/* ─── TAB SWITCHING ─── */
var tabTitles = {
  dashboard: 'Dashboard Overview',
  products:  'Product Management',
  orders:    'Order Management',
  users:     'User Management',
  analytics: 'Analytics & Reports',
  settings:  'Store Settings'
};

function switchTab(name) {
  document.querySelectorAll('.tab').forEach(function(t){ t.classList.remove('active') });
  var tab = document.getElementById('tab-' + name);
  if (tab) tab.classList.add('active');

  document.querySelectorAll('.nav-item[data-tab]').forEach(function(n){ n.classList.remove('active') });
  var navItem = document.querySelector('.nav-item[data-tab="' + name + '"]');
  if (navItem) navItem.classList.add('active');

  document.getElementById('page-title').textContent = tabTitles[name] || name;

  if (name === 'analytics') renderAnalyticsCharts();
  if (name === 'products') {
    var lbl = document.getElementById('product-count-label');
    if (lbl) lbl.textContent = '<?php echo count($products_data); ?> products';
  }
  if (name === 'users') {
    var lbl = document.getElementById('user-count-label');
    if (lbl) lbl.textContent = '<?php echo count($users_data); ?> users';
  }
}

/* ─── CHARTS ─── */
function renderDashboardCharts() {
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'];
  var vals   = [42,58,71,63,89,74,95,84];
  var max    = Math.max.apply(null, vals);
  var rc = document.getElementById('revenue-chart');
  if (rc) rc.innerHTML = months.map(function(m,i){
    var h = Math.round((vals[i]/max)*140);
    return '<div class="bar-col"><div class="bar-val">$'+vals[i]+'K</div><div class="bar" style="height:'+h+'px"></div><div class="bar-label">'+m+'</div></div>';
  }).join('');

  var cats = [{name:'Electronics',val:35},{name:'Jewelry',val:25},{name:'Fashion',val:20},{name:'Watches',val:12},{name:'Home',val:5},{name:'Beauty',val:3}];
  var cc = document.getElementById('category-chart');
  if (cc) cc.innerHTML = cats.map(function(c){
    return '<div class="chart-row"><div class="chart-row-label">'+c.name+'</div><div class="chart-row-bar-wrap"><div class="chart-row-bar" style="width:'+c.val+'%"></div></div><div class="chart-row-val">'+c.val+'%</div></div>';
  }).join('');
}

function renderAnalyticsCharts() {
  var days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  var vals = [18,24,15,32,28,41,35];
  var max  = Math.max.apply(null, vals);
  var wc = document.getElementById('weekly-chart');
  if (wc) wc.innerHTML = days.map(function(d,i){
    var h = Math.round((vals[i]/max)*130);
    return '<div class="bar-col"><div class="bar-val">$'+vals[i]+'K</div><div class="bar" style="height:'+h+'px"></div><div class="bar-label">'+d+'</div></div>';
  }).join('');

  var top = [{name:'Gold Watch',pct:28},{name:'AirPods Max',pct:22},{name:'Diamond Ring',pct:18},{name:'Tote Bag',pct:14},{name:'Espresso',pct:10}];
  var tp = document.getElementById('top-products-chart');
  if (tp) tp.innerHTML = top.map(function(p){
    return '<div class="chart-row"><div class="chart-row-label">'+p.name+'</div><div class="chart-row-bar-wrap"><div class="chart-row-bar" style="width:'+p.pct+'%"></div></div><div class="chart-row-val">'+p.pct+'%</div></div>';
  }).join('');
}

/* ─── ADD USER ─── */
function handleAddUser(e) {
  e.preventDefault();
  var fname = document.getElementById('au-fname').value.trim();
  var lname = document.getElementById('au-lname').value.trim();
  var email = document.getElementById('au-email').value.trim();
  if (!fname || !lname || !email) { showToast('Please fill in all required fields','error'); return; }
  closeModal('modal-add-user');
  showToast(fname + ' ' + lname + ' added!', 'success');
  ['au-fname','au-lname','au-email'].forEach(function(id){ document.getElementById(id).value = '' });
}

/* ─── MODAL HELPERS ─── */
function openModal(id)  { document.getElementById(id).classList.add('open') }
function closeModal(id) { document.getElementById(id).classList.remove('open') }
document.querySelectorAll('.modal-overlay').forEach(function(el){
  el.addEventListener('click', function(e){ if (e.target === this) this.classList.remove('open') });
});

/* ─── TOAST ─── */
function showToast(msg, type) {
  type = type || 'info';
  var icons = {
    success: '<img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/check-circle.svg" alt="" style="filter:brightness(0) saturate(100%) invert(65%) sepia(40%) saturate(500%) hue-rotate(100deg) brightness(95%)"/>',
    error:   '<img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/x-circle.svg" alt="" style="filter:brightness(0) saturate(100%) invert(45%) sepia(80%) saturate(600%) hue-rotate(330deg) brightness(105%)"/>',
    info:    '<img src="https://cdn.jsdelivr.net/npm/lucide-static@0.344.0/icons/info.svg" alt="" style="filter:brightness(0) saturate(100%) invert(73%) sepia(46%) saturate(450%) hue-rotate(5deg) brightness(95%)"/>'
  };
  var wrap = document.getElementById('toast-wrap');
  var el   = document.createElement('div');
  el.className = 'toast ' + type;
  el.innerHTML = icons[type] + '<span style="font-size:0.86rem">' + msg + '</span>';
  wrap.appendChild(el);
  setTimeout(function(){
    el.style.animation = 'slideIn 0.3s ease reverse';
    setTimeout(function(){ el.remove() }, 280);
  }, 3000);
}

/* ─── IMAGE UPLOAD PREVIEW ─── */
function previewProductImage(input, previewId, placeholderId, wrapId) {
  var file = input.files[0];
  if (!file) return;
  if (file.size > 5 * 1024 * 1024) { showToast('Image too large (max 5MB)', 'error'); input.value = ''; return; }
  var reader = new FileReader();
  reader.onload = function(e) {
    var preview     = document.getElementById(previewId);
    var placeholder = document.getElementById(placeholderId);
    var wrap        = document.getElementById(wrapId);
    preview.src               = e.target.result;
    preview.style.display     = 'block';
    placeholder.style.display = 'none';
    wrap.classList.add('has-image');
  };
  reader.readAsDataURL(file);
}

/* ─── ORDER STATUS FILTER ─── */
document.getElementById('order-status-filter').addEventListener('change', function() {
  /* filtering handled server-side or can be wired up here */
});

/* ─── INIT ─── */
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.nav-item[data-tab]').forEach(function(el){
    el.addEventListener('click', function(){ switchTab(this.getAttribute('data-tab')) });
  });
  renderDashboardCharts();
  setTimeout(renderDashboardCharts, 100);
});
</script>
</body>
</html>