<?php
// ✅ Put ALL PHP logic at the very top — before <!DOCTYPE html>
include '../configuration/database_connection.php';


$users_result = mysqli_query($conn, "SELECT * FROM user_authentication");
$products_result=mysqli_query($conn,"SELECT * FROM product_detail");
$users_data   = [];
$products_data = [];

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
/* ════════════════════════════════════
   CSS VARIABLES & RESET
════════════════════════════════════ */
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

/* ════════════════════════════════════
   LAYOUT
════════════════════════════════════ */
.admin-layout {
  display: grid;
  grid-template-columns: 240px 1fr;
  min-height: 100vh;
}

/* ════════════════════════════════════
   SIDEBAR
════════════════════════════════════ */
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

.sidebar-logo {
  padding: 1.5rem;
  border-bottom: 1px solid var(--border);
}
.sidebar-logo .brand {
  font-size: 1.3rem;
  color: var(--gold);
  letter-spacing: 0.15em;
  font-weight: 700;
  text-transform: uppercase;
}
.sidebar-logo .sub {
  font-size: 0.72rem;
  color: var(--gray);
  letter-spacing: 0.1em;
  text-transform: uppercase;
  margin-top: 0.2rem;
}

.sidebar-nav { padding: 1rem 0; flex: 1 }

.nav-item {
  display: flex;
  align-items: center;
  gap: 0.85rem;
  padding: 0.9rem 1.5rem;
  font-size: 0.85rem;
  color: var(--gray);
  cursor: pointer;
  transition: var(--trans);
  border-left: 3px solid transparent;
  user-select: none;
}
.nav-item:hover  { color: var(--white); background: rgba(255,255,255,0.04) }
.nav-item.active { color: var(--gold);  background: rgba(201,168,76,0.08); border-left-color: var(--gold) }
.nav-icon { font-size: 1.1rem; width: 22px; text-align: center; flex-shrink: 0 }

.sidebar-footer {
  padding: 1.5rem;
  border-top: 1px solid var(--border);
}
.admin-user {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
.admin-avatar {
  width: 36px; height: 36px;
  background: var(--gold);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; color: var(--black); font-weight: 700;
}
.admin-user-info .name  { font-size: 0.85rem; font-weight: 600 }
.admin-user-info .role  { font-size: 0.72rem; color: var(--gold) }

/* ════════════════════════════════════
   MAIN CONTENT
════════════════════════════════════ */
.main-content {
  background: var(--dark);
  padding: 2rem 2.5rem;
  overflow: auto;
}

/* Top bar */
.topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 2rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 1rem;
}
.topbar h1 { font-size: 1.4rem }
.topbar-right { display: flex; align-items: center; gap: 1rem }
.topbar-search {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 0.5rem 1rem;
}
.topbar-search input {
  background: none; border: none;
  color: var(--white); font-size: 0.85rem; width: 180px;
}
.topbar-search input::placeholder { color: var(--gray) }
.back-btn {
  display: inline-flex; align-items: center; gap: 0.5rem;
  background: var(--card); border: 1px solid var(--border);
  color: var(--light); padding: 0.5rem 1rem;
  border-radius: 8px; font-size: 0.82rem;
  text-transform: uppercase; letter-spacing: 0.08em;
  transition: var(--trans);
}
.back-btn:hover { border-color: var(--gold); color: var(--gold) }

/* Tabs */
.tab { display: none }
.tab.active { display: block }

/* ════════════════════════════════════
   STATS CARDS
════════════════════════════════════ */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.5rem;
  margin-bottom: 2rem;
}
.stat-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 1.5rem;
  transition: var(--trans);
  position: relative;
  overflow: hidden;
}
.stat-card::after {
  content: '';
  position: absolute;
  top: -20px; right: -20px;
  width: 80px; height: 80px;
  background: rgba(201,168,76,0.05);
  border-radius: 50%;
}
.stat-card:hover { border-color: var(--gold); transform: translateY(-2px) }
.stat-icon { font-size: 1.8rem; margin-bottom: 0.75rem }
.stat-value { font-size: 2rem; font-weight: 700; color: var(--gold) }
.stat-label { color: var(--gray); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 0.25rem }
.stat-change { font-size: 0.78rem; color: var(--green); margin-top: 0.5rem }
.stat-change.down { color: var(--red) }

/* ════════════════════════════════════
   SECTION BOXES
════════════════════════════════════ */
.section-box {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
  margin-bottom: 1.5rem;
}
.section-head {
  padding: 1.1rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 0.75rem;
}
.section-head h3 { font-size: 0.95rem }

/* ════════════════════════════════════
   DATA TABLE
════════════════════════════════════ */
.table-wrap { overflow-x: auto }
.data-table { width: 100%; border-collapse: collapse }
.data-table th {
  padding: 0.85rem 1.25rem;
  text-align: left;
  font-size: 0.72rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--gray);
  background: var(--dark2);
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
}
.data-table td {
  padding: 1rem 1.25rem;
  font-size: 0.88rem;
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
}
.data-table tr:last-child td { border-bottom: none }
.data-table tr:hover td { background: rgba(255,255,255,0.025) }
.text-gold { color: var(--gold) }
.text-gray { color: var(--gray) }

/* Status badges */
.badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  border-radius: 50px;
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}
.badge-pending    { background: rgba(255,165,0,0.15); color: orange }
.badge-processing { background: rgba(100,181,246,0.15); color: var(--blue) }
.badge-shipped    { background: rgba(76,175,77,0.15);  color: var(--green) }
.badge-delivered  { background: rgba(201,168,76,0.15); color: var(--gold) }
.badge-cancelled  { background: rgba(224,82,82,0.15);  color: var(--red) }
.badge-active     { background: rgba(76,175,77,0.15);  color: var(--green) }
.badge-inactive   { background: rgba(224,82,82,0.15);  color: var(--red) }

/* Action buttons */
.action-btns { display: flex; gap: 0.5rem }
.action-btn {
  padding: 0.35rem 0.75rem;
  border-radius: 5px;
  font-size: 0.73rem;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  transition: var(--trans);
  border: none; cursor: pointer;
}
.btn-view { background: rgba(100,181,246,0.15); color: var(--blue) }
.btn-view:hover { background: rgba(100,181,246,0.3) }
.btn-edit { background: rgba(201,168,76,0.15); color: var(--gold) }
.btn-edit:hover { background: rgba(201,168,76,0.3) }
.btn-del  { background: rgba(224,82,82,0.15);  color: var(--red) }
.btn-del:hover  { background: rgba(224,82,82,0.3) }

/* ════════════════════════════════════
   BUTTONS
════════════════════════════════════ */
.btn {
  display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem;
  padding: 0.65rem 1.4rem;
  border-radius: 7px;
  font-size: 0.8rem;
  letter-spacing: 0.09em;
  text-transform: uppercase;
  font-weight: 600;
  transition: var(--trans);
  font-family: inherit;
  cursor: pointer;
}
.btn-gold    { background: var(--gold); color: var(--black) }
.btn-gold:hover { background: var(--gold2); transform: translateY(-1px) }
.btn-outline { background: transparent; color: var(--white); border: 1px solid var(--border) }
.btn-outline:hover { border-color: var(--gold); color: var(--gold) }
.btn-dark    { background: var(--dark2); color: var(--white); border: 1px solid var(--border) }
.btn-sm { padding: 0.45rem 1rem; font-size: 0.75rem }

/* ════════════════════════════════════
   FORM ELEMENTS
════════════════════════════════════ */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem }
.form-grid.cols-1 { grid-template-columns: 1fr }
.form-grid.cols-3 { grid-template-columns: 1fr 1fr 1fr }
.full { grid-column: 1 / -1 }

.form-group { display: flex; flex-direction: column; gap: 0.4rem }
.form-group label {
  font-size: 0.78rem;
  letter-spacing: 0.09em;
  text-transform: uppercase;
  color: var(--gray);
}
.form-group input,
.form-group select,
.form-group textarea {
  background: var(--dark2);
  border: 1px solid var(--border);
  color: var(--white);
  padding: 0.7rem 1rem;
  border-radius: 8px;
  font-size: 0.88rem;
  transition: var(--trans);
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus { border-color: var(--gold) }
.form-group select option { background: var(--dark2) }
.form-group textarea { resize: vertical; min-height: 80px }
.form-group .err { color: var(--red); font-size: 0.76rem; display: none }
.form-group.invalid input,
.form-group.invalid select { border-color: var(--red) }
.form-group.invalid .err { display: block }

/* ════════════════════════════════════
   CHART BARS (pure CSS)
════════════════════════════════════ */
.chart-section { padding: 1.5rem }
.chart-bars {
  display: flex;
  align-items: flex-end;
  gap: 0.75rem;
  height: 160px;
  margin-bottom: 0.5rem;
}
.bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 0.4rem }
.bar {
  width: 100%;
  background: linear-gradient(to top, var(--gold), var(--gold2));
  border-radius: 4px 4px 0 0;
  transition: var(--trans);
  min-height: 4px;
  position: relative;
}
.bar:hover { opacity: 0.8; transform: scaleY(1.02); transform-origin: bottom }
.bar-val { font-size: 0.7rem; color: var(--gold); font-weight: 600 }
.bar-label { font-size: 0.68rem; color: var(--gray); text-align: center }
.chart-alt {
  display: flex; flex-direction: column; gap: 0.75rem; padding: 1.5rem;
}
.chart-row { display: flex; align-items: center; gap: 1rem }
.chart-row-label { width: 90px; font-size: 0.8rem; color: var(--gray); flex-shrink: 0 }
.chart-row-bar-wrap { flex: 1; background: var(--dark2); border-radius: 4px; height: 10px; overflow: hidden }
.chart-row-bar { height: 100%; background: var(--gold); border-radius: 4px; transition: width 0.8s ease }
.chart-row-val { width: 60px; text-align: right; font-size: 0.8rem; color: var(--gold); font-weight: 600 }

/* ════════════════════════════════════
   MODAL
════════════════════════════════════ */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,0.8);
  z-index: 2000;
  display: flex; align-items: center; justify-content: center;
  padding: 2rem;
  opacity: 0; pointer-events: none;
  transition: var(--trans);
}
.modal-overlay.open { opacity: 1; pointer-events: all }
.modal {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 2rem;
  width: 100%; max-width: 520px;
  box-shadow: var(--shadow);
  transform: scale(0.9);
  transition: var(--trans);
  max-height: 90vh;
  overflow-y: auto;
}
.modal-overlay.open .modal { transform: scale(1) }
.modal-head {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid var(--border);
}
.modal-head h3 { font-size: 1rem }
.modal-close {
  background: none; color: var(--gray); font-size: 1.3rem;
  transition: var(--trans); width: 30px; height: 30px;
  border-radius: 6px;
}
.modal-close:hover { color: var(--white); background: var(--border) }

/* ════════════════════════════════════
   TOAST
════════════════════════════════════ */
.toast-wrap {
  position: fixed; bottom: 2rem; right: 2rem;
  z-index: 9999;
  display: flex; flex-direction: column; gap: 0.75rem;
}
.toast {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 0.9rem 1.4rem;
  display: flex; align-items: center; gap: 0.75rem;
  min-width: 270px;
  box-shadow: var(--shadow);
  animation: slideIn 0.3s ease;
}
.toast.success { border-left: 3px solid var(--green) }
.toast.error   { border-left: 3px solid var(--red) }
.toast.info    { border-left: 3px solid var(--gold) }
@keyframes slideIn {
  from { transform: translateX(120%); opacity: 0 }
  to   { transform: translateX(0);   opacity: 1 }
}

/* ════════════════════════════════════
   MISC
════════════════════════════════════ */
.divider { height: 1px; background: var(--border); margin: 1.5rem 0 }
.product-thumb {
  width: 44px; height: 44px;
  background: var(--dark2);
  border: 1px solid var(--border);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem;
}
.empty-state {
  text-align: center; padding: 3rem;
  color: var(--gray); font-size: 0.9rem;
}
.empty-state .icon { font-size: 2.5rem; margin-bottom: 0.75rem }

/* ════════════════════════════════════
   RESPONSIVE
════════════════════════════════════ */
@media (max-width: 1024px) {
  .stats-grid { grid-template-columns: 1fr 1fr }
}
@media (max-width: 768px) {
  .admin-layout { grid-template-columns: 1fr }
  .sidebar { display: none }
  .sidebar.mobile-open { display: flex; position: fixed; z-index: 999; width: 240px }
  .stats-grid { grid-template-columns: 1fr }
  .form-grid { grid-template-columns: 1fr }
  .main-content { padding: 1.5rem }
}
</style>
</head>
<body>

<div class="admin-layout">

  <!-- ══════════════════════════════
       SIDEBAR
  ══════════════════════════════ -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <div class="brand">LUXE</div>
      <div class="sub">Admin Panel</div>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-item active" data-tab="dashboard">
        <span class="nav-icon">📊</span> Dashboard
      </div>
      <div class="nav-item" data-tab="products">
        <span class="nav-icon">📦</span> Products
      </div>
      <div class="nav-item" data-tab="orders">
        <span class="nav-icon">🛒</span> Orders
      </div>
      <div class="nav-item" data-tab="users">
        <span class="nav-icon">👥</span> Users
      </div>
      <div class="nav-item" data-tab="analytics">
        <span class="nav-icon">📈</span> Analytics
      </div>
      <div class="nav-item" data-tab="settings">
        <span class="nav-icon">⚙️</span> Settings
      </div>
    </nav>

    <div class="sidebar-footer">
      <div class="admin-user">
        <div class="admin-avatar">A</div>
        <div class="admin-user-info">
          <div class="name">Admin User</div>
          <div class="role">Super Admin</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- ══════════════════════════════
       MAIN
  ══════════════════════════════ -->
  <main class="main-content">

    <!-- Top Bar -->
    <div class="topbar">
      <h1 id="page-title">Dashboard Overview</h1>
      <div class="topbar-right">
        <div class="topbar-search">
          <span>🔍</span>
          <input type="text" placeholder="Search..." id="global-search"/>
        </div>
        <a href="ecommerce.html" class="back-btn">🏠 Back to Store</a>
      </div>
    </div>

    <!-- ══════════════════ DASHBOARD TAB ══════════════════ -->
    <div class="tab active" id="tab-dashboard">

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">📦</div>
          <div class="stat-value" id="stat-products">12</div>
          <div class="stat-label">Total Products</div>
          <div class="stat-change">↑ 8% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🛒</div>
          <div class="stat-value">48</div>
          <div class="stat-label">Total Orders</div>
          <div class="stat-change">↑ 15% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">👥</div>
          <div class="stat-value">1,284</div>
          <div class="stat-label">Total Users</div>
          <div class="stat-change">↑ 22% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">💰</div>
          <div class="stat-value">$84K</div>
          <div class="stat-label">Revenue</div>
          <div class="stat-change">↑ 31% this month</div>
        </div>
      </div>

      <!-- Charts Row -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem">

        <!-- Monthly Revenue Bar Chart -->
        <div class="section-box">
          <div class="section-head"><h3>Monthly Revenue</h3><span class="text-gray" style="font-size:0.8rem">2025</span></div>
          <div class="chart-section">
            <div class="chart-bars" id="revenue-chart"></div>
          </div>
        </div>

        <!-- Sales by Category -->
        <div class="section-box">
          <div class="section-head"><h3>Sales by Category</h3></div>
          <div class="chart-alt" id="category-chart"></div>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="section-box">
        <div class="section-head">
          <h3>Recent Orders</h3>
          <button class="btn btn-outline btn-sm" onclick="switchTab('orders')">View All →</button>
        </div>
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr>
                <th>Order ID</th><th>Customer</th><th>Amount</th>
                <th>Status</th><th>Date</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>#ORD-001</td><td>John Doe</td><td class="text-gold">$299.00</td><td><span class="badge badge-delivered">Delivered</span></td><td>Mar 05</td><td><button class="action-btn btn-view">View</button></td></tr>
              <tr><td>#ORD-002</td><td>Jane Smith</td><td class="text-gold">$799.00</td><td><span class="badge badge-shipped">Shipped</span></td><td>Mar 04</td><td><button class="action-btn btn-view">View</button></td></tr>
              <tr><td>#ORD-003</td><td>Mike Johnson</td><td class="text-gold">$149.00</td><td><span class="badge badge-processing">Processing</span></td><td>Mar 04</td><td><button class="action-btn btn-view">View</button></td></tr>
              <tr><td>#ORD-004</td><td>Sara Lee</td><td class="text-gold">$1,299.00</td><td><span class="badge badge-pending">Pending</span></td><td>Mar 03</td><td><button class="action-btn btn-view">View</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- end dashboard tab -->

    <!-- ══════════════════ PRODUCTS TAB ══════════════════ -->
    <div class="tab" id="tab-products">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
          <h2 style="font-size:1rem;margin-bottom:0.25rem">Product Management</h2>
          <p class="text-gray" style="font-size:0.85rem" id="product-count-label">Loading...</p>
        </div>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap">
          <select id="product-filter-cat" class="form-group" style="background:var(--card);border:1px solid var(--border);color:var(--white);padding:0.55rem 1rem;border-radius:8px;font-size:0.85rem">
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
              <tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Old Price</th><th>Created At</th><th>description</th><th>Actions</th></tr>
            </thead>
           <tbody id="products-tbody">
                <?php if (!empty($products_data)): ?>
                    <?php foreach ($products_data as $row): ?>
                    <tr>
                        <td><div class="product-thumb">📦</div></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><span style='color:var(--gold);font-size:0.8rem'><?php echo $row['category']; ?></span></td>
                        <td class='text-gold'>$<?php echo $row['price']; ?></td>
                        <td class='text-gray'>$<?php echo $row['old_price']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <div class='action-btns'>
                                <button class='action-btn btn-edit'>Edit</button>
                                <button class='action-btn btn-del'>Delete</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan='8' style='text-align:center;color:gray;padding:2rem'>No products found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══════════════════ ORDERS TAB ══════════════════ -->
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
              <tr><th>Order ID</th><th>Customer</th><th>Email</th><th>Items</th><th>Amount</th><th>Status</th><th>Date</th><th>Actions</th></tr>
            </thead>
            <tbody id="orders-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══════════════════ USERS TAB ══════════════════ -->
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
            <thead>
              <tr><th>Name</th><th>Email</th><th>Role</th><th>Orders</th><th>Total Spent</th><th>Joined</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
              <?php if (!empty($users_data)): ?>
                  <?php foreach ($users_data as $row): ?>
                  <tr>
                      <td><?php echo $row['fullname']; ?></td>
                      <td class='text-gray'><?php echo $row['email']; ?></td>
                      <td><span style='font-size:0.78rem;color:var(--blue)'>Customer</span></td>
                      <td>0</td>
                      <td class='text-gold'>$0</td>
                      <td class='text-gray'>2025</td>
                      <td><span class='badge badge-active'>Active</span></td>
                      <td>
                          <div class='action-btns'>
                              <button class='action-btn btn-edit'>Edit</button>
                              <button class='action-btn btn-del'>Delete</button>
                          </div>
                      </td>
                  </tr>
                  <?php endforeach; ?>
              <?php else: ?>
                  <tr>
                      <td colspan='8' style='text-align:center;color:gray;padding:2rem'>
                          No users found
                      </td>
                  </tr>
              <?php endif; ?>
          </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══════════════════ ANALYTICS TAB ══════════════════ -->
    <div class="tab" id="tab-analytics">
      <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1rem;margin-bottom:0.25rem">Analytics & Reports</h2>
        <p class="text-gray" style="font-size:0.85rem">Sales performance overview</p>
      </div>

      <div class="stats-grid" style="margin-bottom:1.5rem">
        <div class="stat-card">
          <div class="stat-icon">📊</div>
          <div class="stat-value">$84K</div>
          <div class="stat-label">Total Revenue</div>
          <div class="stat-change">↑ 31% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🛍️</div>
          <div class="stat-value">$312</div>
          <div class="stat-label">Avg. Order Value</div>
          <div class="stat-change">↑ 5% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🔄</div>
          <div class="stat-value">68%</div>
          <div class="stat-label">Return Customer Rate</div>
          <div class="stat-change">↑ 12% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🚚</div>
          <div class="stat-value">2.4d</div>
          <div class="stat-label">Avg. Delivery Time</div>
          <div class="stat-change down">↓ Improved by 0.3d</div>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
        <div class="section-box">
          <div class="section-head"><h3>Weekly Sales</h3></div>
          <div class="chart-section">
            <div class="chart-bars" id="weekly-chart"></div>
          </div>
        </div>
        <div class="section-box">
          <div class="section-head"><h3>Top Products</h3></div>
          <div class="chart-alt" id="top-products-chart"></div>
        </div>
      </div>
    </div>

    <!-- ══════════════════ SETTINGS TAB ══════════════════ -->
    <div class="tab" id="tab-settings">
      <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1rem;margin-bottom:0.25rem">Store Settings</h2>
        <p class="text-gray" style="font-size:0.85rem">Manage your store configuration</p>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
        <!-- General Settings -->
        <div class="section-box">
          <div class="section-head"><h3>General Settings</h3></div>
          <div style="padding:1.5rem">
            <div class="form-grid cols-1" style="gap:1.2rem">
              <div class="form-group">
                <label>Store Name</label>
                <input type="text" value="LUXE Premium Store"/>
              </div>
              <div class="form-group">
                <label>Store Email</label>
                <input type="email" value="support@luxe.com"/>
              </div>
              <div class="form-group">
                <label>Store Phone</label>
                <input type="tel" value="+1 (800) LUXE-123"/>
              </div>
              <div class="form-group">
                <label>Currency</label>
                <select><option>USD — US Dollar</option><option>EUR — Euro</option><option>GBP — British Pound</option></select>
              </div>
              <button class="btn btn-gold" onclick="showToast('Settings saved!','success')">Save Changes</button>
            </div>
          </div>
        </div>

        <!-- Admin Account -->
        <div class="section-box">
          <div class="section-head"><h3>Admin Account</h3></div>
          <div style="padding:1.5rem">
            <div class="form-grid cols-1" style="gap:1.2rem">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="Admin User"/>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" value="admin@luxe.com"/>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" placeholder="Leave blank to keep current"/>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm new password"/>
              </div>
              <button class="btn btn-gold" onclick="showToast('Account updated!','success')">Update Account</button>
            </div>
          </div>
        </div>

        <!-- Shipping -->
        <div class="section-box">
          <div class="section-head"><h3>Shipping Settings</h3></div>
          <div style="padding:1.5rem">
            <div class="form-grid cols-1" style="gap:1.2rem">
              <div class="form-group">
                <label>Free Shipping Threshold ($)</label>
                <input type="number" value="100"/>
              </div>
              <div class="form-group">
                <label>Standard Shipping Rate ($)</label>
                <input type="number" value="15"/>
              </div>
              <div class="form-group">
                <label>Express Shipping Rate ($)</label>
                <input type="number" value="35"/>
              </div>
              <button class="btn btn-gold" onclick="showToast('Shipping settings saved!','success')">Save Settings</button>
            </div>
          </div>
        </div>

        <!-- Tax Settings -->
        <div class="section-box">
          <div class="section-head"><h3>Tax Settings</h3></div>
          <div style="padding:1.5rem">
            <div class="form-grid cols-1" style="gap:1.2rem">
              <div class="form-group">
                <label>Tax Rate (%)</label>
                <input type="number" value="8" step="0.1"/>
              </div>
              <div class="form-group">
                <label>Tax Label</label>
                <input type="text" value="Sales Tax"/>
              </div>
              <div class="form-group">
                <label>Tax Included in Price?</label>
                <select><option>No — Add at checkout</option><option>Yes — Already included</option></select>
              </div>
              <button class="btn btn-gold" onclick="showToast('Tax settings saved!','success')">Save Settings</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ══════════════════════════════
     MODAL: ADD PRODUCT
══════════════════════════════ -->
<div class="modal-overlay" id="modal-add-product">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New Product</h3>
      <button class="modal-close" onclick="closeModal('modal-add-product')">✕</button>
    </div>
    <form action="../backend/add_product.php" method="POST">
      <div class="form-grid" style="gap:1rem">
        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ap-name" placeholder="e.g. Premium Gold Watch" name="product_name"/>
          <span class="err">Name is required</span>
        </div>
        <div class="form-group">
          <label>Price ($) *</label>
          <input type="number" id="ap-price" placeholder="299.00" step="0.01" name="price"/>
          <span class="err">Valid price required</span>
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
          <span class="err">Category required</span>
        </div>
        <div class="form-group">
          <label>Icon / Emoji</label>
          <input type="text" id="ap-icon" placeholder="⌚" maxlength="4"/>
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

<!-- ══════════════════════════════
     MODAL: EDIT PRODUCT
══════════════════════════════ -->
<div class="modal-overlay" id="modal-edit-product">
  <div class="modal">
    <div class="modal-head">
      <h3>Edit Product</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-product')">✕</button>
    </div>
    <form onsubmit="handleEditProduct(event)">
      <input type="hidden" id="ep-id"/>
      <div class="form-grid" style="gap:1rem">
        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ep-name"/>
        </div>
        <div class="form-group">
          <label>Price ($) *</label>
          <input type="number" id="ep-price" step="0.01"/>
        </div>
        <div class="form-group">
          <label>Old Price ($)</label>
          <input type="number" id="ep-old" step="0.01"/>
        </div>
        <div class="form-group">
          <label>Category</label>
          <select id="ep-cat">
            <option>Electronics</option><option>Fashion</option>
            <option>Watches</option><option>Jewelry</option>
            <option>Home</option><option>Beauty</option>
          </select>
        </div>
        <div class="form-group">
          <label>Icon / Emoji</label>
          <input type="text" id="ep-icon" maxlength="4"/>
        </div>
        <div class="form-group full">
          <label>Description</label>
          <textarea id="ep-desc"></textarea>
        </div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:0.75rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-product')">Cancel</button>
        <button type="submit" class="btn btn-gold">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════
     MODAL: ADD USER
══════════════════════════════ -->
<div class="modal-overlay" id="modal-add-user">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New User</h3>
      <button class="modal-close" onclick="closeModal('modal-add-user')">✕</button>
    </div>
    <form onsubmit="handleAddUser(event)">
      <div class="form-grid" style="gap:1rem">
        <div class="form-group">
          <label>First Name *</label>
          <input type="text" id="au-fname" placeholder="John"/>
        </div>
        <div class="form-group">
          <label>Last Name *</label>
          <input type="text" id="au-lname" placeholder="Doe"/>
        </div>
        <div class="form-group full">
          <label>Email *</label>
          <input type="email" id="au-email" placeholder="john@email.com"/>
        </div>
        <div class="form-group">
          <label>Role</label>
          <select id="au-role">
            <option>Customer</option>
            <option>Editor</option>
            <option>Admin</option>
          </select>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select id="au-status">
            <option>Active</option>
            <option>Inactive</option>
          </select>
        </div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:0.75rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-add-user')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add User</button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════
     MODAL: VIEW ORDER
══════════════════════════════ -->
<div class="modal-overlay" id="modal-view-order">
  <div class="modal">
    <div class="modal-head">
      <h3>Order Details</h3>
      <button class="modal-close" onclick="closeModal('modal-view-order')">✕</button>
    </div>
    <div id="order-detail-content"></div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-wrap" id="toast-wrap"></div>

<script>
/* ═══════════════════════════════════════
   DATA
═══════════════════════════════════════ */
var products = [
  {id:1,  name:'Luminara Gold Watch',    cat:'Watches',     price:1299, old:1799, rating:4.9, reviews:284, icon:'⌚'},
  {id:2,  name:'AirPods Pro Max',        cat:'Electronics', price:549,  old:649,  rating:4.8, reviews:1203,icon:'🎧'},
  {id:3,  name:'Diamond Solitaire Ring', cat:'Jewelry',     price:2499, old:null, rating:5.0, reviews:89,  icon:'💍'},
  {id:4,  name:'Silk Evening Dress',     cat:'Fashion',     price:349,  old:499,  rating:4.7, reviews:156, icon:'👗'},
  {id:5,  name:'Smart Home Hub Pro',     cat:'Electronics', price:299,  old:399,  rating:4.6, reviews:412, icon:'🏠'},
  {id:6,  name:'Rose Gold Necklace',     cat:'Jewelry',     price:799,  old:null, rating:4.8, reviews:203, icon:'📿'},
  {id:7,  name:'Leather Tote Bag',       cat:'Fashion',     price:459,  old:599,  rating:4.5, reviews:318, icon:'👜'},
  {id:8,  name:'Espresso Machine',       cat:'Home',        price:699,  old:899,  rating:4.7, reviews:521, icon:'☕'},
  {id:9,  name:'Vitamin C Serum',        cat:'Beauty',      price:89,   old:119,  rating:4.8, reviews:944, icon:'✨'},
  {id:10, name:'Carbon Fiber Sunglasses',cat:'Fashion',     price:289,  old:null, rating:4.6, reviews:167, icon:'🕶️'},
  {id:11, name:'Smart Fitness Ring',     cat:'Electronics', price:349,  old:449,  rating:4.4, reviews:289, icon:'💪'},
  {id:12, name:'Cashmere Scarf',         cat:'Fashion',     price:199,  old:279,  rating:4.9, reviews:412, icon:'🧣'},
];

var orders = [
  {id:'#ORD-001', customer:'John Doe',      email:'john@email.com',  items:3, amount:299,  status:'Delivered', date:'Mar 05, 2025'},
  {id:'#ORD-002', customer:'Jane Smith',    email:'jane@email.com',  items:1, amount:799,  status:'Shipped',   date:'Mar 04, 2025'},
  {id:'#ORD-003', customer:'Mike Johnson',  email:'mike@email.com',  items:2, amount:149,  status:'Processing',date:'Mar 04, 2025'},
  {id:'#ORD-004', customer:'Sara Lee',      email:'sara@email.com',  items:1, amount:1299, status:'Pending',   date:'Mar 03, 2025'},
  {id:'#ORD-005', customer:'Tom Brown',     email:'tom@email.com',   items:4, amount:450,  status:'Cancelled', date:'Mar 02, 2025'},
  {id:'#ORD-006', customer:'Alice Wang',    email:'alice@email.com', items:2, amount:888,  status:'Delivered', date:'Mar 01, 2025'},
  {id:'#ORD-007', customer:'Bob Martinez',  email:'bob@email.com',   items:1, amount:349,  status:'Shipped',   date:'Feb 28, 2025'},
];

var users = [
  {id:1, name:'John Doe',     email:'john@email.com',  role:'Customer', orders:12, spent:2450, joined:'Jan 2025', status:'Active'},
  {id:2, name:'Jane Smith',   email:'jane@email.com',  role:'Customer', orders:7,  spent:1299, joined:'Feb 2025', status:'Active'},
  {id:3, name:'Mike Johnson', email:'mike@email.com',  role:'Customer', orders:3,  spent:588,  joined:'Feb 2025', status:'Active'},
  {id:4, name:'Sara Lee',     email:'sara@email.com',  role:'Editor',   orders:1,  spent:1299, joined:'Mar 2025', status:'Active'},
  {id:5, name:'Tom Brown',    email:'tom@email.com',   role:'Customer', orders:5,  spent:890,  joined:'Jan 2025', status:'Inactive'},
];

/* ═══════════════════════════════════════
   TAB SWITCHING
═══════════════════════════════════════ */
var tabTitles = {
  dashboard:'Dashboard Overview',
  products: 'Product Management',
  orders:   'Order Management',
  users:    'User Management',
  analytics:'Analytics & Reports',
  settings: 'Store Settings'
};

function switchTab(name) {
  // Hide all tabs
  document.querySelectorAll('.tab').forEach(function(t){ t.classList.remove('active') });
  // Show target
  var tab = document.getElementById('tab-' + name);
  if (tab) tab.classList.add('active');

  // Update nav
  document.querySelectorAll('.nav-item').forEach(function(n){ n.classList.remove('active') });
  var navItem = document.querySelector('.nav-item[data-tab="' + name + '"]');
  if (navItem) navItem.classList.add('active');

  // Update title
  document.getElementById('page-title').textContent = tabTitles[name] || name;

  // Render
  if (name === 'products') renderProducts();
  if (name === 'orders')   renderOrders();
  if (name === 'users')    renderUsers();
  if (name === 'analytics') renderAnalyticsCharts();
}

/* ═══════════════════════════════════════
   RENDER PRODUCTS TABLE

═══════════════════════════════════════ */
function renderProducts() {
    // Products are rendered by PHP — nothing to do here
    var label = document.getElementById('product-count-label');
    if (label) label.textContent = '<?php echo count($products_data); ?> products';
}


/* ═══════════════════════════════════════
   RENDER ORDERS TABLE
═══════════════════════════════════════ */
function renderOrders() {
  var filterStatus = document.getElementById('order-status-filter') ? document.getElementById('order-status-filter').value : '';
  var filtered = filterStatus ? orders.filter(function(o){ return o.status === filterStatus }) : orders;

  document.getElementById('orders-tbody').innerHTML = filtered.map(function(o){
    var cls = 'badge-' + o.status.toLowerCase();
    return '<tr>' +
      '<td style="color:var(--gold);font-weight:600">' + o.id + '</td>' +
      '<td>' + o.customer + '</td>' +
      '<td class="text-gray">' + o.email + '</td>' +
      '<td>' + o.items + ' item' + (o.items > 1 ? 's' : '') + '</td>' +
      '<td class="text-gold">$' + o.amount.toLocaleString() + '</td>' +
      '<td><span class="badge ' + cls + '">' + o.status + '</span></td>' +
      '<td class="text-gray">' + o.date + '</td>' +
      '<td><div class="action-btns">' +
        '<button class="action-btn btn-view" onclick="viewOrder(\'' + o.id + '\')">View</button>' +
        '<button class="action-btn btn-del"  onclick="deleteOrder(\'' + o.id + '\')">Delete</button>' +
      '</div></td>' +
    '</tr>';
  }).join('');
}


/* ═══════════════════════════════════════
   CHARTS
═══════════════════════════════════════ */
function renderDashboardCharts() {
  // Monthly revenue bar chart
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'];
  var vals   = [42,58,71,63,89,74,95,84];
  var max    = Math.max.apply(null, vals);
  document.getElementById('revenue-chart').innerHTML = months.map(function(m,i){
    var h = Math.round((vals[i] / max) * 140);
    return '<div class="bar-col">' +
      '<div class="bar-val">$' + vals[i] + 'K</div>' +
      '<div class="bar" style="height:' + h + 'px"></div>' +
      '<div class="bar-label">' + m + '</div>' +
    '</div>';
  }).join('');

  // Category sales
  var cats = [
    {name:'Electronics', val:35},
    {name:'Jewelry',     val:25},
    {name:'Fashion',     val:20},
    {name:'Watches',     val:12},
    {name:'Home',        val:5},
    {name:'Beauty',      val:3},
  ];
  document.getElementById('category-chart').innerHTML = cats.map(function(c){
    return '<div class="chart-row">' +
      '<div class="chart-row-label">' + c.name + '</div>' +
      '<div class="chart-row-bar-wrap"><div class="chart-row-bar" style="width:' + c.val + '%"></div></div>' +
      '<div class="chart-row-val">' + c.val + '%</div>' +
    '</div>';
  }).join('');
}

function renderAnalyticsCharts() {
  var days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  var vals = [18,24,15,32,28,41,35];
  var max  = Math.max.apply(null, vals);
  var el   = document.getElementById('weekly-chart');
  if (el) {
    el.innerHTML = days.map(function(d,i){
      var h = Math.round((vals[i] / max) * 130);
      return '<div class="bar-col">' +
        '<div class="bar-val">$' + vals[i] + 'K</div>' +
        '<div class="bar" style="height:' + h + 'px"></div>' +
        '<div class="bar-label">' + d + '</div>' +
      '</div>';
    }).join('');
  }

  var top = [
    {name:'Gold Watch',  pct:28},
    {name:'AirPods Max', pct:22},
    {name:'Diamond Ring',pct:18},
    {name:'Tote Bag',    pct:14},
    {name:'Espresso',    pct:10},
  ];
  var tp = document.getElementById('top-products-chart');
  if (tp) {
    tp.innerHTML = top.map(function(p){
      return '<div class="chart-row">' +
        '<div class="chart-row-label">' + p.name + '</div>' +
        '<div class="chart-row-bar-wrap"><div class="chart-row-bar" style="width:' + p.pct + '%"></div></div>' +
        '<div class="chart-row-val">' + p.pct + '%</div>' +
      '</div>';
    }).join('');
  }
}

/* ═══════════════════════════════════════
   PRODUCT CRUD
═══════════════════════════════════════ */
function handleAddProduct(e) {
  e.preventDefault();
  var name  = document.getElementById('ap-name').value.trim();
  var price = parseFloat(document.getElementById('ap-price').value);
  var cat   = document.getElementById('ap-cat').value;
  var old   = parseFloat(document.getElementById('ap-old').value) || null;
  var icon  = document.getElementById('ap-icon').value || '📦';
  var desc  = document.getElementById('ap-desc').value;

  if (!name || !price || !cat) {
    showToast('Please fill in required fields', 'error');
    return;
  }

  products.push({
    id: Date.now(), name: name, cat: cat,
    price: price, old: old,
    rating: 0, reviews: 0, icon: icon, desc: desc
  });

  closeModal('modal-add-product');
  renderProducts();
  showToast(name + ' added successfully!', 'success');

  // Clear form
  ['ap-name','ap-price','ap-old','ap-icon','ap-desc'].forEach(function(id){
    document.getElementById(id).value = '';
  });
  document.getElementById('ap-cat').value = '';
}

function openEditProduct(id) {
  var p = products.find(function(p){ return p.id === id });
  if (!p) return;
  document.getElementById('ep-id').value    = p.id;
  document.getElementById('ep-name').value  = p.name;
  document.getElementById('ep-price').value = p.price;
  document.getElementById('ep-old').value   = p.old || '';
  document.getElementById('ep-cat').value   = p.cat;
  document.getElementById('ep-icon').value  = p.icon;
  document.getElementById('ep-desc').value  = p.desc || '';
  openModal('modal-edit-product');
}

function handleEditProduct(e) {
  e.preventDefault();
  var id = parseInt(document.getElementById('ep-id').value);
  var p  = products.find(function(p){ return p.id === id });
  if (!p) return;

  p.name  = document.getElementById('ep-name').value.trim();
  p.price = parseFloat(document.getElementById('ep-price').value);
  p.old   = parseFloat(document.getElementById('ep-old').value) || null;
  p.cat   = document.getElementById('ep-cat').value;
  p.icon  = document.getElementById('ep-icon').value || p.icon;
  p.desc  = document.getElementById('ep-desc').value;

  closeModal('modal-edit-product');
  renderProducts();
  showToast(p.name + ' updated!', 'success');
}

function deleteProduct(id) {
  var idx = products.findIndex(function(p){ return p.id === id });
  if (idx > -1) {
    var name = products[idx].name;
    products.splice(idx, 1);
    renderProducts();
    showToast(name + ' deleted', 'error');
  }
}

/* ═══════════════════════════════════════
   ORDER CRUD
═══════════════════════════════════════ */
function viewOrder(id) {
  var o = orders.find(function(o){ return o.id === id });
  if (!o) return;
  var cls = 'badge-' + o.status.toLowerCase();
  document.getElementById('order-detail-content').innerHTML =
    '<div style="display:grid;gap:1rem">' +
    '<div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Order ID</div><div style="font-weight:700;color:var(--gold)">' + o.id + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Status</div><div><span class="badge ' + cls + '">' + o.status + '</span></div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Customer</div><div>' + o.customer + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Email</div><div class="text-gray">' + o.email + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Items</div><div>' + o.items + ' item(s)</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Total</div><div class="text-gold" style="font-size:1.1rem;font-weight:700">$' + o.amount.toLocaleString() + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em">Date</div><div>' + o.date + '</div></div>' +
    '</div>' +
    '<div style="margin-top:1rem">' +
      '<div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Update Status</div>' +
      '<div style="display:flex;gap:0.5rem;flex-wrap:wrap">' +
        ['Pending','Processing','Shipped','Delivered','Cancelled'].map(function(s){
          return '<button class="action-btn ' + (o.status===s?'btn-edit':'btn-view') + '" onclick="updateOrderStatus(\'' + o.id + '\',\'' + s + '\')">' + s + '</button>';
        }).join('') +
      '</div>' +
    '</div>' +
    '</div>';
  openModal('modal-view-order');
}

function updateOrderStatus(id, status) {
  var o = orders.find(function(o){ return o.id === id });
  if (o) {
    o.status = status;
    closeModal('modal-view-order');
    renderOrders();
    showToast('Order ' + id + ' → ' + status, 'success');
  }
}

function deleteOrder(id) {
  var idx = orders.findIndex(function(o){ return o.id === id });
  if (idx > -1) {
    orders.splice(idx, 1);
    renderOrders();
    showToast('Order ' + id + ' deleted', 'error');
  }
}

/* ═══════════════════════════════════════
   USER CRUD
═══════════════════════════════════════ */
function handleAddUser(e) {
  e.preventDefault();
  var fname  = document.getElementById('au-fname').value.trim();
  var lname  = document.getElementById('au-lname').value.trim();
  var email  = document.getElementById('au-email').value.trim();
  var role   = document.getElementById('au-role').value;
  var status = document.getElementById('au-status').value;

  if (!fname || !lname || !email) {
    showToast('Please fill in all required fields', 'error');
    return;
  }

  users.push({
    id: Date.now(), name: fname + ' ' + lname,
    email: email, role: role,
    orders: 0, spent: 0,
    joined: 'Mar 2025', status: status
  });

  closeModal('modal-add-user');
  renderUsers();
  showToast(fname + ' ' + lname + ' added!', 'success');

  ['au-fname','au-lname','au-email'].forEach(function(id){
    document.getElementById(id).value = '';
  });
}

function deleteUser(id) {
  var idx = users.findIndex(function(u){ return u.id === id });
  if (idx > -1) {
    var name = users[idx].name;
    users.splice(idx, 1);
    renderUsers();
    showToast(name + ' deleted', 'error');
  }
}

/* ═══════════════════════════════════════
   MODAL HELPERS
═══════════════════════════════════════ */
function openModal(id) {
  document.getElementById(id).classList.add('open');
}
function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}
document.querySelectorAll('.modal-overlay').forEach(function(el){
  el.addEventListener('click', function(e){
    if (e.target === this) this.classList.remove('open');
  });
});

/* ═══════════════════════════════════════
   TOAST
═══════════════════════════════════════ */
function showToast(msg, type) {
  type = type || 'info';
  var icons = {success:'✅', error:'❌', info:'ℹ️'};
  var wrap  = document.getElementById('toast-wrap');
  var el    = document.createElement('div');
  el.className = 'toast ' + type;
  el.innerHTML = '<span>' + icons[type] + '</span><span style="font-size:0.86rem">' + msg + '</span>';
  wrap.appendChild(el);
  setTimeout(function(){
    el.style.animation = 'slideIn 0.3s ease reverse';
    setTimeout(function(){ el.remove() }, 280);
  }, 3000);
}

/* ═══════════════════════════════════════
   FILTER LISTENERS
═══════════════════════════════════════ */
document.getElementById('product-filter-cat').addEventListener('change', renderProducts);
document.getElementById('order-status-filter').addEventListener('change', renderOrders);

/* ═══════════════════════════════════════
   INIT
═══════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {
  // Wire sidebar nav
  document.querySelectorAll('.nav-item[data-tab]').forEach(function(el){
    el.addEventListener('click', function(){
      switchTab(this.getAttribute('data-tab'));
    });
  });

  // Render default charts
  renderDashboardCharts();
  // Small delay so bars animate in
  setTimeout(renderDashboardCharts, 100);
});
</script>
</body>
</html>